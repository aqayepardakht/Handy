<?php

namespace Aqayepardakht\Handy\Wallet\Traits;

use Aqayepardakht\Handy\Wallet\Models\Transaction;
use Aqayepardakht\Handy\Wallet\Models\Wallet;

trait HasWallets {
    use HasWalletOperator;

    public function transactions() {
        return $this->hasMany(Transaction::class);
    }

    public function wallets() {
        return $this->morphMany(Wallet::class, 'holder');
    }

    public function createWallet($name = null) {
        $wallet          = new Wallet();
        $wallet->balance = 0;
        $wallet->name    = $name;

        $this->wallets()->save($wallet);

        return $wallet->id;
    }
}
