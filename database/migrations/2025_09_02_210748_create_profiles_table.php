<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('avatar')->nullable();
            $table->enum('theme', ['system', 'light', 'dark'])->default('system');
            $table->enum('weekly_summary_day', ['Sat', 'Sun', 'Mon', 'Tue', 'Thu', 'Fri'])->default('Fri');
            $table->boolean('notify_budget_alerts')->default(false);
            $table->boolean('notify_cheque_reminders')->default(false);
            $table->integer('last_used_account')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
