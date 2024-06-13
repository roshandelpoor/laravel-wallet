<?php

use Roshandelpoor\LaravelWallet\Models\Wallet;
use Roshandelpoor\LaravelWallet\Models\WalletLogs;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Tests\SetUp\Models\Product;
use Tests\SetUp\Models\User;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;
use function PHPUnit\Framework\assertInstanceOf;

/*
 * Use `RefreshDatabase` for delete migration data for each test.
 */
uses(RefreshDatabase::class);

test('can store new amount in wallet for a user', function () {
    $user = User::query()->create(['name' => 'Mohammad', 'email' => 'mohammad.roshandelpoor@gmail.com']);
    $amount = +10;

    $wallet = Wallet::query()->find(['user_id' => $user->id]);
    $wallet = Wallet::query()->firstOrCreate([
        'user_id' => $user->id,
        'balance' => ($wallet->balance ?? 0) + $amount 
    ]);
    $walletLogs = new WalletLogs([
        'ownable_id'    => $wallet->id,
        'ownable_type'  => $wallet::class,
        'amount'        => $amount,
    ]);

    $wallet->walletLogs()->save($walletLogs);

    // Assertions
    assertInstanceOf($wallet::class, $walletLogs->ownable()->first());

    // DB Assertions
    assertDatabaseCount('wallets', 1);
    assertDatabaseCount('wallet_logs', 1);
    assertDatabaseHas('wallet_logs', [
        'ownable_id'    => $wallet->id,
        'ownable_type'  => $wallet::class,
        'amount'        => $amount,
    ]);
});

test('can store product in wallet with custom table name from config', function () {
    config()->set([
        'laravel-wallet.wallets.table' => 'custom_wallets',
        'laravel-wallet.wallet_logs.table' => 'custom_wallet_logs',
    ]);

    Artisan::call('migrate:refresh');

    $user = User::query()->create(['name' => 'Mohammad', 'email' => 'mohammad.roshandelpoor@gmail.com']);
    $amount = +10;

    $wallet = Wallet::query()->find(['user_id' => $user->id]);
    $wallet = Wallet::query()->firstOrCreate([
        'user_id' => $user->id,
        'balance' => ($wallet->balance ?? 0) + $amount 
    ]);
    $walletLogs = new WalletLogs([
        'ownable_id'    => $wallet->id,
        'ownable_type'  => $wallet::class,
        'amount'        => $amount,
    ]);

    $wallet->walletLogs()->save($walletLogs);

    // Assertions
    assertInstanceOf($wallet::class, $walletLogs->ownable()->first());

    // DB Assertions
    assertDatabaseCount('wallets', 1);
    assertDatabaseCount('wallet_logs', 1);
    assertDatabaseHas('wallet_logs', [
        'ownable_id'    => $wallet->id,
        'ownable_type'  => $wallet::class,
        'amount'        => $amount,
    ]);
});

test('can increse user wallet with increase method', function () {
    $user = User::query()->create(['name' => 'Mohammad', 'email' => 'mohammad.roshandelpoor@gmail.com']);
    $amount = +10;

    $wallet = Wallet::query()->increse($user->id, $amount);

    // Assertions
    assertInstanceOf($wallet::class, $walletLogs->ownable()->first());

    // DB Assertions
    assertDatabaseCount('wallets', 1);
    assertDatabaseCount('wallet_logs', 1);
    assertDatabaseHas('wallet_logs', [
        'ownable_id'    => $wallet->id,
        'ownable_type'  => $wallet::class,
        'amount'        => $amount,
    ]);
});

test('can decrease user wallet with increase method', function () {
    $user = User::query()->create(['name' => 'Mohammad', 'email' => 'mohammad.roshandelpoor@gmail.com']);
    $amount = -10;

    $wallet = Wallet::query()->decrease($user->id, $amount);

    // Assertions
    assertInstanceOf($wallet::class, $walletLogs->ownable()->first());

    // DB Assertions
    assertDatabaseCount('wallets', 1);
    assertDatabaseCount('wallet_logs', 1);
    assertDatabaseHas('wallet_logs', [
        'ownable_id'    => $wallet->id,
        'ownable_type'  => $wallet::class,
        'amount'        => $amount,
    ]);
});

test('can store new amount in wallet for a user when user sign-in', function () {
    $user = User::query()->create(['name' => 'Mohammad', 'email' => 'mohammad.roshandelpoor@gmail.com']);
    $amount = +10;

    auth()->login($user);

    $wallet = Wallet::query()->find(['user_id' => $user->id]);
    $wallet = Wallet::query()->firstOrCreate([
        'user_id' => $user->id,
        'balance' => ($wallet->balance ?? 0) + $amount 
    ]);
    $walletLogs = new WalletLogs([
        'ownable_id'    => $wallet->id,
        'ownable_type'  => $wallet::class,
        'amount'        => $amount,
    ]);

    $wallet->walletLogs()->save($walletLogs);

    // Assertions
    assertInstanceOf($wallet::class, $walletLogs->ownable()->first());

    // DB Assertions
    assertDatabaseCount('wallets', 1);
    assertDatabaseCount('wallet_logs', 1);
    assertDatabaseHas('wallet_logs', [
        'ownable_id'    => $wallet->id,
        'ownable_type'  => $wallet::class,
        'amount'        => $amount,
    ]);
});
