<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BalanceEventSkip extends Model
{
    public $timestamps = false;

    protected $fillable = ['occurs_on'];
}
