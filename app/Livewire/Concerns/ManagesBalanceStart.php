<?php

namespace App\Livewire\Concerns;

use App\Models\User;

trait ManagesBalanceStart
{
    public string $balanceStartDate = '';

    public bool $startDateSaved = false;

    protected function initializeBalanceStart(): void
    {
        $this->balanceStartDate = $this->balanceStartOwner()->balance_starts_on?->toDateString() ?? '';
    }

    private function balanceStartOwner(): User
    {
        $user = auth()->user();
        abort_unless($user instanceof User, 403);

        return $user;
    }

    public function saveBalanceStart(): void
    {
        $this->startDateSaved = false;
        $this->validate(['balanceStartDate' => ['nullable', 'date_format:Y-m-d', 'after_or_equal:1901-01-01', 'before_or_equal:2099-12-31']]);
        $user = $this->balanceStartOwner();
        $user->setAttribute('balance_starts_on', $this->balanceStartDate !== '' ? $this->balanceStartDate : null);
        $user->save();
        $this->startDateSaved = true;
    }

    public function clearBalanceStart(): void
    {
        $this->balanceStartDate = '';
        $this->saveBalanceStart();
    }
}
