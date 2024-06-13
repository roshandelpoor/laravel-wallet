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
        $table = config('laravel-wallet.wallets.table', 'wallets');

        $userTableName = config('laravel-wallet.users.table', 'users');
        $userForeignName = config('laravel-wallet.users.foreign_id', 'user_id');

        Schema::create($table, function (Blueprint $table) use ($userTableName, $userForeignName) {
            $table->id();

            $table->foreignId($userForeignName)->constrained($userTableName)->cascadeOnDelete();

            $table->unsignedInteger('balance');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $table = config('laravel-wallet.wallets.table', 'wallets');

        Schema::dropIfExists($table);
    }
};
