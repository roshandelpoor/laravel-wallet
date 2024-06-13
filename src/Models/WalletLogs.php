<?php

namespace Roshandelpoor\LaravelWallet\Models;

use Illuminate\Database\Eloquent\Model;

class WalletLogs extends Model
{
    /**
     *
     * @var string[]
     */
    protected $fillable = [
        'wallet_id', 
        'ownable_id', 
        'ownable_type', 
        'amount'
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->table = config('laravel-wallet.wallet_logs.table', 'wallet_logs');
    }

    /**
     * Relation, inverse one-to-one or many relationship.
     */
    public function ownable(): \Illuminate\Database\Eloquent\Relations\MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Relation, Wallet model.
     */
    public function wallet(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Wallet::class, 'wallet_id');
    }
}
