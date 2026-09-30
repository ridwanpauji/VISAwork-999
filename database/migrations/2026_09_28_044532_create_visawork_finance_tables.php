<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('goals', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->string('name');
            $table->decimal('percentage', 5, 2);
            $table->integer('nominal');
            $table->integer('monthly_saving');
            $table->date('deadline');
            $table->integer('beginning_balance');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->index('user_id');
        });

        Schema::create('net_worths', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->integer('net_worth_goal');
            $table->integer('current_net_worth');
            $table->integer('amount_left');
            $table->smallInteger('transaction_per_month');
            $table->smallInteger('year');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->index(['user_id', 'year']);
        });

        Schema::create('assets', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->uuid('net_worth_id');
            $table->string('detail');
            $table->string('goal');
            $table->string('type');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('net_worth_id')->references('id')->on('net_worths')->cascadeOnDelete();
            $table->index('user_id');
            $table->index('net_worth_id');
        });

        Schema::create('liabilities', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->uuid('net_worth_id');
            $table->string('detail');
            $table->string('goal');
            $table->string('type');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('net_worth_id')->references('id')->on('net_worths')->cascadeOnDelete();
            $table->index('user_id');
            $table->index('net_worth_id');
        });

        Schema::create('net_worth_assets', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('asset_id');
            $table->date('transaction_date');
            $table->integer('nominal');
            $table->timestamps();

            $table->foreign('asset_id')->references('id')->on('assets')->cascadeOnDelete();
            $table->index(['asset_id', 'transaction_date']);
        });

        Schema::create('net_worth_liabilities', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('liability_id');
            $table->date('transaction_date');
            $table->integer('nominal');
            $table->timestamps();

            $table->foreign('liability_id')->references('id')->on('liabilities')->cascadeOnDelete();
            $table->index(['liability_id', 'transaction_date']);
        });

        Schema::create('balances', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->uuid('goal_id');
            $table->integer('amount');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('goal_id')->references('id')->on('goals')->cascadeOnDelete();
            $table->index(['user_id', 'goal_id']);
        });

        Schema::create('budgets', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->string('detail');
            $table->integer('nominal');
            $table->string('month');
            $table->smallInteger('year');
            $table->string('type');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->index(['user_id', 'year', 'month']);
        });

        Schema::create('payments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->string('name');
            $table->string('type');
            $table->string('account_number')->nullable();
            $table->string('account_owner')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->index('user_id');
        });

        Schema::create('incomes', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->uuid('source_id');
            $table->date('date');
            $table->integer('nominal');
            $table->string('notes')->nullable();
            $table->string('month');
            $table->smallInteger('year');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->index(['user_id', 'year', 'month']);
            $table->index('source_id');
        });

        Schema::create('expenses', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->date('date');
            $table->string('description');
            $table->integer('nominal');
            $table->string('type');
            $table->uuid('type_detail_id');
            $table->uuid('payment_id');
            $table->string('notes');
            $table->string('month');
            $table->smallInteger('year');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('payment_id')->references('id')->on('payments')->cascadeOnDelete();
            $table->index(['user_id', 'year', 'month']);
            $table->index('type_detail_id');
            $table->index('payment_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('expenses');
        Schema::dropIfExists('incomes');
        Schema::dropIfExists('payments');
        Schema::dropIfExists('budgets');
        Schema::dropIfExists('balances');
        Schema::dropIfExists('net_worth_liabilities');
        Schema::dropIfExists('net_worth_assets');
        Schema::dropIfExists('liabilities');
        Schema::dropIfExists('assets');
        Schema::dropIfExists('net_worths');
        Schema::dropIfExists('goals');
    }
};
