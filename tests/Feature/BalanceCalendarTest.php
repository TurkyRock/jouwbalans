<?php

use App\Livewire\BalanceCalendar;
use App\Models\BalanceEvent;
use App\Models\User;
use App\Services\BalanceSchedule;
use Carbon\CarbonImmutable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

function plannedMoment(User $user, array $overrides = []): BalanceEvent
{
    $event = new BalanceEvent(array_merge([
        'title' => 'Even wandelen', 'category' => 'move', 'starts_on' => '2026-10-19',
        'starts_at' => '16:00', 'recurrence' => 'weekly',
    ], $overrides));
    $event->user_id = $user->id;
    $event->save();

    return $event;
}

test('calendar requires login and verified email', function () {
    $this->get('/mijn-kalender')->assertRedirect('/login');
    $this->actingAs(User::factory()->unverified()->create())
        ->get('/mijn-kalender')->assertRedirect(route('verification.notice'));
});

test('calendar and dashboard render for a verified user', function () {
    $this->actingAs(User::factory()->create());
    $this->get('/mijn-kalender')->assertOk()->assertSee('Mijn kalender');
    $this->get('/dashboard')->assertOk()->assertSee('Ruimte voor vandaag');
});

test('a moment is saved for the current user including overnight sleep', function () {
    $user = User::factory()->create();
    Livewire::actingAs($user)->test(BalanceCalendar::class)
        ->call('create', '2026-10-19')->set('title', 'Slapen')->set('category', 'sleep')
        ->set('starts_at', '23:00')->set('ends_at', '07:00')->set('recurrence', 'daily')
        ->set('small_version', 'Telefoon op tijd wegleggen')->call('save')
        ->assertHasNoErrors()->assertSet('showForm', false);
    $this->assertDatabaseHas('balance_events', ['user_id' => $user->id, 'title' => 'Slapen', 'ends_at' => '07:00']);
});

test('invalid dates categories and repeat limits cannot be saved', function () {
    Livewire::actingAs(User::factory()->create())->test(BalanceCalendar::class)
        ->call('create', '2026-10-19')->set('title', 'Rust')->set('category', 'invalid')->set('recurrence', 'weekly')
        ->set('repeat_until', '2026-10-18')->call('save')
        ->assertHasErrors(['category', 'repeat_until']);
    expect(BalanceEvent::count())->toBe(0);
});

test('a recurring moment can be edited and deleted', function () {
    $user = User::factory()->create();
    $event = plannedMoment($user);
    Livewire::actingAs($user)->test(BalanceCalendar::class)
        ->call('edit', $event->id)->set('title', 'Samen wandelen')->call('save')
        ->assertHasNoErrors();
    expect($event->fresh()->title)->toBe('Samen wandelen');
    Livewire::actingAs($user)->test(BalanceCalendar::class)
        ->call('edit', $event->id)->call('delete');
    $this->assertDatabaseMissing('balance_events', ['id' => $event->id]);
});

test('other users cannot edit or skip someone elses moments', function () {
    $event = plannedMoment(User::factory()->create());
    $user = User::factory()->create();
    Livewire::actingAs($user)->test(BalanceCalendar::class)->call('edit', $event->id)->assertNotFound();
    Livewire::actingAs($user)->test(BalanceCalendar::class)
        ->call('skip', $event->id, '2026-10-19')->assertNotFound();
    $this->assertDatabaseHas('balance_events', ['id' => $event->id]);
    expect($event->skips()->count())->toBe(0);
});

test('one occurrence can be skipped without changing the rest of the series', function () {
    $user = User::factory()->create();
    $event = plannedMoment($user);
    Livewire::actingAs($user)->test(BalanceCalendar::class)->call('skip', $event->id, '2026-10-19');
    $days = app(BalanceSchedule::class)->between($user->id, CarbonImmutable::parse('2026-10-19'), CarbonImmutable::parse('2026-10-26'));
    expect($days['2026-10-19'])->toHaveCount(0);
    expect($days['2026-10-26']->pluck('id')->all())->toBe([$event->id]);
});

test('the schedule excludes other accounts and respects weekly inclusive end dates', function () {
    $user = User::factory()->create();
    $event = plannedMoment($user, ['repeat_until' => '2026-10-26']);
    plannedMoment(User::factory()->create(), ['title' => 'Private other account']);
    $days = app(BalanceSchedule::class)->between($user->id, CarbonImmutable::parse('2026-10-18'), CarbonImmutable::parse('2026-11-02'));
    expect($days['2026-10-18'])->toHaveCount(0);
    expect($days['2026-10-19']->pluck('id')->all())->toBe([$event->id]);
    expect($days['2026-10-26'])->toHaveCount(1);
    expect($days['2026-11-02'])->toHaveCount(0);
});

test('weekday recurrence omits weekends and daily recurrence crosses the year boundary', function () {
    $user = User::factory()->create();
    plannedMoment($user, ['recurrence' => 'weekdays', 'starts_on' => '2026-12-31']);
    $daily = plannedMoment($user, ['recurrence' => 'daily', 'starts_on' => '2026-12-31']);
    $days = app(BalanceSchedule::class)->between($user->id, CarbonImmutable::parse('2026-12-31'), CarbonImmutable::parse('2027-01-04'));
    expect($days['2026-12-31'])->toHaveCount(2);
    expect($days['2027-01-02']->pluck('id')->all())->toBe([$daily->id]);
    expect($days['2027-01-04'])->toHaveCount(2);
});

test('one off moments only appear on their date and leap day is supported', function () {
    $user = User::factory()->create();
    plannedMoment($user, ['recurrence' => 'once', 'starts_on' => '2028-02-29']);
    $days = app(BalanceSchedule::class)->between($user->id, CarbonImmutable::parse('2028-02-28'), CarbonImmutable::parse('2028-03-01'));
    expect($days['2028-02-28'])->toHaveCount(0);
    expect($days['2028-02-29'])->toHaveCount(1);
    expect($days['2028-03-01'])->toHaveCount(0);
});

test('month navigation works at the end of a month and filtering is scoped', function () {
    $user = User::factory()->create();
    plannedMoment($user);
    Livewire::actingAs($user)->test(BalanceCalendar::class)
        ->set('anchor', '2026-01-31')->call('navigate', 1)->assertSet('anchor', '2026-02-01')
        ->set('anchor', '2026-10-19')->set('filter', 'rest')->assertDontSee('Even wandelen')
        ->set('filter', 'move')->assertSee('Even wandelen');
});

test('a skipped occurrence can be restored', function () {
    $user = User::factory()->create();
    $event = plannedMoment($user);
    Livewire::actingAs($user)->test(BalanceCalendar::class)
        ->call('skip', $event->id, '2026-10-19')
        ->assertSet('lastSkippedId', $event->id)
        ->call('undoSkip')->assertSet('lastSkippedId', null);
    expect($event->skips()->count())->toBe(0);
});

test('switching to a one off moment clears the hidden recurrence end date', function () {
    $user = User::factory()->create();
    $event = plannedMoment($user, ['repeat_until' => '2026-10-26']);
    Livewire::actingAs($user)->test(BalanceCalendar::class)
        ->call('edit', $event->id)->set('starts_on', '2026-11-01')
        ->set('recurrence', 'once')->call('save')->assertHasNoErrors();
    expect($event->fresh()->repeat_until)->toBeNull();
});
