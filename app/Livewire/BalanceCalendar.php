<?php

namespace App\Livewire;

use App\Livewire\Concerns\ManagesBalanceStart;
use App\Models\BalanceEvent;
use App\Services\BalanceSchedule;
use Carbon\CarbonImmutable;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Livewire\Attributes\Locked;
use Livewire\Component;

class BalanceCalendar extends Component
{
    use ManagesBalanceStart;

    public string $anchor = '';

    public string $view = 'month';

    public string $filter = '';

    public bool $showForm = false;

    #[Locked]
    public ?int $editingId = null;

    #[Locked]
    public ?int $lastSkippedId = null;

    #[Locked]
    public ?string $lastSkippedDate = null;

    public string $title = '';

    public string $category = 'rest';

    public string $starts_on = '';

    public string $starts_at = '16:00';

    public string $ends_at = '';

    public string $recurrence = 'once';

    public string $repeat_until = '';

    public string $notes = '';

    public string $small_version = '';

    public function mount(): void
    {
        $this->initializeBalanceStart();
        $this->anchor = CarbonImmutable::today('Europe/Amsterdam')->toDateString();
        $start = request()->query('start');
        if (is_string($start) && validator(['start' => $start], ['start' => 'date_format:Y-m-d|after_or_equal:1901-01-01|before_or_equal:2099-12-31'])->passes()) {
            $this->anchor = $start;
        }
    }

    public function navigate(int $direction): void
    {
        abort_unless(in_array($direction, [-1, 1], true), 422);
        $this->validate(['anchor' => 'required|date_format:Y-m-d', 'view' => Rule::in(['month', 'week', 'day'])]);
        $day = CarbonImmutable::parse($this->anchor);
        $this->anchor = match ($this->view) {
            'day' => $day->addDays($direction)->toDateString(),
            'week' => $day->addWeeks($direction)->toDateString(),
            default => $day->startOfMonth()->addMonths($direction)->toDateString(),
        };
    }

    public function today(): void
    {
        $this->anchor = CarbonImmutable::today('Europe/Amsterdam')->toDateString();
    }

    public function create(?string $date = null): void
    {
        $this->resetValidation();
        $this->reset('editingId', 'title', 'category', 'starts_at', 'ends_at', 'recurrence', 'repeat_until', 'notes', 'small_version');
        $this->starts_on = $date ?? CarbonImmutable::today('Europe/Amsterdam')->toDateString();
        $this->showForm = true;
    }

    private function owned(int $id): BalanceEvent
    {
        return BalanceEvent::where('user_id', auth()->id())->findOrFail($id);
    }

    public function edit(int $id): void
    {
        $event = $this->owned($id);
        $this->resetValidation();
        $this->editingId = $event->id;
        foreach (['title', 'category', 'recurrence', 'notes', 'small_version'] as $field) {
            $this->$field = $event->$field ?? '';
        }
        $this->starts_on = $event->starts_on->toDateString();
        $this->repeat_until = $event->repeat_until?->toDateString() ?? '';
        $this->starts_at = substr($event->starts_at, 0, 5);
        $this->ends_at = substr($event->ends_at ?? '', 0, 5);
        $this->showForm = true;
    }

    public function save(): void
    {
        $this->title = trim($this->title);
        if ($this->recurrence === 'once') {
            $this->repeat_until = '';
        }

        $data = $this->validate([
            'title' => 'required|string|max:120',
            'category' => ['required', Rule::in(array_keys(BalanceEvent::CATEGORIES))],
            'starts_on' => 'required|date_format:Y-m-d|after_or_equal:1900-01-01|before_or_equal:2100-12-31',
            'starts_at' => 'required|date_format:H:i',
            'ends_at' => 'nullable|date_format:H:i',
            'recurrence' => ['required', Rule::in(array_keys(BalanceEvent::RECURRENCES))],
            'repeat_until' => 'nullable|date_format:Y-m-d|after_or_equal:starts_on|before_or_equal:2100-12-31',
            'notes' => 'nullable|string|max:2000',
            'small_version' => 'nullable|string|max:240',
        ]);
        foreach (['ends_at', 'repeat_until', 'notes', 'small_version'] as $field) {
            $data[$field] = $data[$field] === '' ? null : $data[$field];
        }
        if ($data['recurrence'] === 'once') {
            $data['repeat_until'] = null;
        }
        if ($this->editingId) {
            $this->owned($this->editingId)->update($data);
        } else {
            $event = new BalanceEvent($data);
            $event->user_id = auth()->user()->id;
            $event->save();
        }
        $this->showForm = false;
        session()->flash('calendar-message', 'Je moment is bewaard. Maak er iets fijns van.');
    }

    public function delete(): void
    {
        if ($this->editingId) {
            $this->owned($this->editingId)->delete();
        }
        $this->showForm = false;
        session()->flash('calendar-message', 'Je afspraak is verwijderd. Er mag ruimte ontstaan.');
    }

    public function skip(int $id, string $date): void
    {
        $this->validate(['anchor' => 'required|date_format:Y-m-d']);
        validator(['date' => $date], ['date' => 'required|date_format:Y-m-d'])->validate();
        $event = $this->owned($id);
        abort_unless(app(BalanceSchedule::class)->occursOn($event, CarbonImmutable::parse($date)), 422);
        $event->skips()->firstOrCreate(['occurs_on' => $date]);
        $this->lastSkippedId = $event->id;
        $this->lastSkippedDate = $date;
        session()->flash('calendar-message', 'Dit moment is overgeslagen. Een andere dag is ook goed.');
    }

    public function undoSkip(): void
    {
        if ($this->lastSkippedId && $this->lastSkippedDate) {
            $this->owned($this->lastSkippedId)->skips()->where('occurs_on', $this->lastSkippedDate)->delete();
            $this->reset('lastSkippedId', 'lastSkippedDate');
            session()->flash('calendar-message', 'Je moment staat weer in je kalender.');
        }
    }

    public function render(): View
    {
        $this->validate([
            'anchor' => 'required|date_format:Y-m-d|after_or_equal:1901-01-01|before_or_equal:2099-12-31',
            'view' => ['required', Rule::in(['month', 'week', 'day'])],
            'filter' => ['nullable', Rule::in(array_merge([''], array_keys(BalanceEvent::CATEGORIES)))],
        ]);
        $anchor = CarbonImmutable::parse($this->anchor, 'Europe/Amsterdam');
        $from = match ($this->view) {
            'day' => $anchor,
            'week' => $anchor->startOfWeek(),
            default => $anchor->startOfMonth()->startOfWeek(),
        };
        $to = match ($this->view) {
            'day' => $from,
            'week' => $from->addDays(6),
            default => $anchor->endOfMonth()->endOfWeek(),
        };
        $days = app(BalanceSchedule::class)->between((int) auth()->id(), $from, $to);
        if ($this->filter !== '') {
            $days = $days->map(fn ($events) => $events->where('category', $this->filter));
        }

        $period = $anchor;
        $savedStartDate = auth()->user()?->fresh()?->balance_starts_on;
        $startDate = $savedStartDate?->toDateString();

        return view('livewire.balance-calendar', compact('days', 'period', 'startDate', 'savedStartDate'))
            ->layout('components.layouts.balance', ['title' => 'Mijn kalender']);
    }
}
