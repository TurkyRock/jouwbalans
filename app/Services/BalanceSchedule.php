<?php

namespace App\Services;

use App\Models\BalanceEvent;
use Carbon\CarbonImmutable;
use Illuminate\Support\Collection;

class BalanceSchedule
{
    public function occursOn(BalanceEvent $event, CarbonImmutable $day): bool
    {
        $date = $day->toDateString();
        if ($date < $event->starts_on->toDateString()
            || ($event->repeat_until && $date > $event->repeat_until->toDateString())) {
            return false;
        }

        return match ($event->recurrence) {
            'daily' => true,
            'weekdays' => $day->isWeekday(),
            'weekly' => $day->dayOfWeek === $event->starts_on->dayOfWeek,
            default => $date === $event->starts_on->toDateString(),
        };
    }

    /** @return Collection<string, \Illuminate\Database\Eloquent\Collection<int, BalanceEvent>> */
    public function between(int $userId, CarbonImmutable $from, CarbonImmutable $to): Collection
    {
        $events = BalanceEvent::query()->where('user_id', $userId)
            ->whereDate('starts_on', '<=', $to->toDateString())
            ->where(function ($query) use ($from) {
                $query->whereDate('starts_on', '>=', $from->toDateString())
                    ->orWhere(function ($query) use ($from) {
                        $query->where('recurrence', '!=', 'once')
                            ->where(fn ($q) => $q->whereNull('repeat_until')
                                ->orWhereDate('repeat_until', '>=', $from->toDateString()));
                    });
            })->with('skips')->orderBy('starts_at')->orderBy('id')->get();
        $days = collect();
        for ($day = $from; $day->lte($to); $day = $day->addDay()) {
            $date = $day->toDateString();
            $days->put($date, $events->filter(fn ($event) => $this->occursOn($event, $day)
                && ! $event->skips->contains('occurs_on', $date))->values());
        }

        return $days;
    }
}
