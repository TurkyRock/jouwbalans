<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('balance_events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('title', 120);
            $table->string('category', 24);
            $table->date('starts_on');
            $table->time('starts_at');
            $table->time('ends_at')->nullable();
            $table->string('recurrence', 16)->default('once');
            $table->date('repeat_until')->nullable();
            $table->text('notes')->nullable();
            $table->string('small_version', 240)->nullable();
            $table->timestamps();
            $table->index(['user_id', 'starts_on']);
        });
        Schema::create('balance_event_skips', function (Blueprint $table) {
            $table->id();
            $table->foreignId('balance_event_id')->constrained()->cascadeOnDelete();
            $table->date('occurs_on');
            $table->unique(['balance_event_id', 'occurs_on']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('balance_event_skips');
        Schema::dropIfExists('balance_events');
    }
};
