<?php

namespace Aqayepardakht\Handy\Wallet\Traits;

use Aqayepardakht\Handy\Wallet\Models\Transaction;
use Aqayepardakht\Handy\Wallet\Models\Wallet;

trait HasWallet {
    use HasWalletOperator {
        HasWalletOperator::deposit as _deposit;
    }

    public function transactions() {
        return $this->hasMany(Transaction::class, 'wallet_id');
    }

    public function wallet() {
        return $this->hasOne(Wallet::class, 'holder_id');
    }

    public function deposit($amount) {
        return $this->_deposit($amount, $this->wallet);
    }

    public function createWallet($name = null) {
        $wallet              = new Wallet();
        $wallet->balance     = 0;
        $wallet->name        = $name;
        $wallet->holder_type = get_class($this);

        $this->wallet()->save($wallet);

        return $wallet->id;
    }
}
