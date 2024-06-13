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
        $table = config('laravel-wallet.wallet_logs.table', 'wallet_logs');

        $walletTableName = config('laravel-wallet.wallets.table', 'wallets');
        $walletForeignName = config('laravel-wallet.wallets.foreign_id', 'wallet_id');

        Schema::create($table, function (Blueprint $table) use ($walletForeignName, $walletTableName) {
            $table->id();

            $table->foreignId($walletForeignName)->constrained($walletTableName)->cascadeOnDelete();

            $table->morphs('ownable');

            $table->unsignedInteger('amount');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $table = config('laravel-wallet.wallet_logs.table', 'wallet_logs');

        Schema::dropIfExists($table);
    }
};
