<?php

namespace App\Models;

use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property int $user_id
 * @property CarbonImmutable $starts_on
 * @property CarbonImmutable|null $repeat_until
 */
class BalanceEvent extends Model
{
    public const CATEGORIES = [
        'start' => 'Opstarten', 'break' => 'Pauzemoment',
        'unwind' => 'Afschakelen na werk', 'closing' => 'Dag afsluiten',
        'sleep' => 'Slaap', 'rest' => 'Rust & ontspanning',
        'move' => 'Sport & bewegen', 'food' => 'Eten & voorbereiden',
        'me' => 'Me-time', 'we' => 'We-time', 'kids' => 'Kids-time',
        'reflect' => 'Reflectie', 'other' => 'Eigen moment',
    ];

    public const RECURRENCES = [
        'once' => 'Eenmalig', 'daily' => 'Elke dag',
        'weekdays' => 'Elke werkdag (ma–vr)', 'weekly' => 'Elke week op deze dag',
    ];

    protected $fillable = ['title', 'category', 'starts_on', 'starts_at', 'ends_at',
        'recurrence', 'repeat_until', 'notes', 'small_version'];

    protected function casts(): array
    {
        return ['starts_on' => 'immutable_date', 'repeat_until' => 'immutable_date'];
    }

    /** @return HasMany<BalanceEventSkip, $this> */
    public function skips(): HasMany
    {
        return $this->hasMany(BalanceEventSkip::class);
    }
}
