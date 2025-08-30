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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->enum('type', ['expense', 'income', 'transfer'])->default('income');
            $table->integer('amount');
            $table->string('description');
            $table->text('notes')->nullable();
            $table->timestamp('transaction_date');
            $table->foreignId('category_id')->constrained('categories')->nullOnDelete();
            $table->foreignId('wallet_id')->constrained('wallets')->cascadeOnDelete();
            $table->foreign('destination_id')->references('id')->on('wallets')->cascadeOnDelete();
            $table->integer('transfer_fee')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
