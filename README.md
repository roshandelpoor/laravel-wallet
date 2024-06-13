# Laravel Wallet

<a name="Introduction"></a>
## Introduction

Seamlessly integrate wallet processing functionality into your Laravel application. This package enables you to effortlessly increase and decrease the wallet balance for each user, as well as retrieve their current wallet balance, freeing you to concentrate on developing your application's core features.

<a name="Features"></a>
## Features:

- Allow users to have individual wallets associated with their accounts
- Provide methods to increase and decrease the wallet balance for each user
- Keep a record of wallet transactions for auditing and user reference
- Implement secure authorization mechanisms to ensure only authorized users can perform wallet operations

<a name="installation"></a>
## Installation

You can install the package with Composer:

```bash
composer require roshandelpoor/laravel-wallet
```

<a name="publish"></a>
## Publish

If you want to publish a config file, you can use this command:

```shell
php artisan vendor:publish --tag="laravel-wallet-config"
```

If you want to publish the migrations, you can use this command:

```shell
php artisan vendor:publish --tag="laravel-wallet-migrations"
```

For convenience, you can use this command to publish config, migration, and ... files:

```shell
php artisan vendor:publish --provider="Roshandelpoor\LaravelWallet\Providers\LaravelWalletServiceProvider"
```

After publishing, run the `php artisan migrate` command.

<a name="usage"></a>
## Usage

<a name="store-wallet"></a>
### Store Wallet

For storing a new wallet, you can use `Wallet` model:

```php
use \Roshandelpoor\LaravelWallet\Models\Wallet;
use Illuminate\Support\Facades\DB;

try {
    DB::beginTransaction();

    $wallet = Wallet::query()->firstOrCreate([
        'user_id'   => $user->id, 
        'balance'   => $amount
    ]);
    $WalletLogs = new WalletLog([
        'ownable_id'    => $ownable->id,
        'ownable_type'  => $ownable::class,
        'amount'        => $amount
    ]);

    DB::commit();
} catch (\Exception $e) {
    report($e);
    DB::rollBack();
}
```

<a name="access-wallet"></a>
### Access Wallet

If you want to access to user wallet, you can use like this:

```php
$wallet = Wallet::query()->find([
        'user_id'   => $user->id
    ])
    ->with('walletLogs');
```

<a name="license"></a>
## Contributing

If you find any bugs or have suggestions for new features, feel free to open an issue or submit a pull request on GitHub.

<a name="license"></a>
## License

Laravel Wallet is open-source software licensed under the MIT license.


