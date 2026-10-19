<?php

namespace App\Livewire;

use App\Livewire\Concerns\ManagesBalanceStart;
use App\Services\BalanceSchedule;
use Carbon\CarbonImmutable;
use Illuminate\View\View;
use Livewire\Component;

class BalanceDashboard extends Component
{
    use ManagesBalanceStart;

    public function mount(): void
    {
        $this->initializeBalanceStart();
    }

    public function render(): View
    {
        $today = CarbonImmutable::today('Europe/Amsterdam');
        $days = app(BalanceSchedule::class)->between((int) auth()->id(), $today, $today->addDays(6));
        $savedStartDate = auth()->user()?->fresh()?->balance_starts_on;
        $startDate = $savedStartDate?->toDateString();

        return view('livewire.balance-dashboard', compact('today', 'days', 'startDate', 'savedStartDate'))
            ->layout('components.layouts.balance', ['title' => 'Mijn balans']);
    }
}
