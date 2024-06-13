<?php

namespace Roshandelpoor\LaravelWallet\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'balance'
    ];

    /**
     * The relations to eager load on every query.
     *
     * @var string[]
     */
    protected $with = ['walletLogs'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->table = config('laravel-wallet.wallets.table', 'wallets');
    }

    /**
     * Relation, WalletLogs model.
     */
    public function walletLogs(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(WalletLogs::class);
    }
}
