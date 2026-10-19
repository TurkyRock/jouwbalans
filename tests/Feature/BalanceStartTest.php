<?php

use App\Livewire\BalanceCalendar;
use App\Livewire\BalanceDashboard;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

test('a start date is saved only on the signed in account and can be changed and cleared', function () {
    $owner = User::factory()->create();
    $other = User::factory()->create();
    Livewire::actingAs($owner)->test(BalanceDashboard::class)
        ->set('balanceStartDate', '2026-11-02')->call('saveBalanceStart')->assertHasNoErrors();
    expect($owner->fresh()->balance_starts_on?->toDateString())->toBe('2026-11-02');
    expect($other->fresh()->balance_starts_on)->toBeNull();
    Livewire::actingAs($owner)->test(BalanceDashboard::class)
        ->assertSet('balanceStartDate', '2026-11-02')->set('balanceStartDate', '2026-11-03')->call('saveBalanceStart')->assertHasNoErrors();
    expect($owner->fresh()->balance_starts_on?->toDateString())->toBe('2026-11-03');
    Livewire::actingAs($owner)->test(BalanceDashboard::class)->call('clearBalanceStart')->assertHasNoErrors();
    expect($owner->fresh()->balance_starts_on)->toBeNull();
});

test('invalid and out of range start dates cannot replace the saved date', function (string $date) {
    $owner = User::factory()->create();
    $owner->setAttribute('balance_starts_on', '2026-10-19')->save();
    Livewire::actingAs($owner)->test(BalanceDashboard::class)
        ->set('balanceStartDate', $date)->call('saveBalanceStart')->assertHasErrors('balanceStartDate');
    expect($owner->fresh()->balance_starts_on?->toDateString())->toBe('2026-10-19');
})->with(['2026-02-30', 'geen datum', '1900-12-31', '2100-01-01']);

test('the private start marker appears in month week and day views independently of event filters', function () {
    $owner = User::factory()->create();
    $owner->setAttribute('balance_starts_on', '2026-11-02')->save();
    foreach (['month', 'week', 'day'] as $view) {
        Livewire::actingAs($owner)->test(BalanceCalendar::class)
            ->set('anchor', '2026-11-02')->set('view', $view)->set('filter', 'sleep')
            ->assertSeeHtml('is-balance-start')->assertSee('Mijn eerste stap');
    }
    Livewire::actingAs(User::factory()->create())->test(BalanceCalendar::class)
        ->set('anchor', '2026-11-02')->assertDontSeeHtml('is-balance-start');
});

test('the calendar can open the chosen start month and ignores malformed links', function () {
    $this->actingAs(User::factory()->create());
    $this->get('/mijn-kalender?start=2027-03-08')->assertOk()->assertSee('maart 2027');
    $this->get('/mijn-kalender?start=invalid')->assertOk();
    $this->get('/mijn-kalender?start[]=invalid')->assertOk();
});
