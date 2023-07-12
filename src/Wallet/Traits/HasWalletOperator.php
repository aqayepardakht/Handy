<?php

namespace Aqayepardakht\Handy\Wallet\Traits;

use Aqayepardakht\Handy\Wallet\Models\Transaction;
use Aqayepardakht\Handy\Wallet\Models\Wallet;

trait HasWalletOperator {
    public function deposit(float $amount, Wallet $wallet): Transaction {
        $service = app(WalletServiceInterface::class);
        return $service->deposit($amount, $wallet);
    }

    public function withdraw(float $amount, $walletId) {
        $service = app(WalletServiceInterface::class);
        $wallet = $service->getWallet($this->id, $walletId);
        return $service->withdraw($amount, $wallet);
    }

    public function transfer($amount, $fromWalletId, $toWalletId) {
        $service = app(WalletServiceInterface::class);
        $fromWallet = $service->getWallet($this->id, $fromWalletId);
        $toWallet = $service->getWallet($this->id, $toWalletId);
        return $service->transfer($amount, $fromWallet, $toWallet);
    }

    public function hasWallet($walletId) {
        $service = app(WalletServiceInterface::class);
        return $service->hasWallet($this->id, $walletId);
    }

    public function getWallet($walletId) {
        $service = app(WalletServiceInterface::class);
        return $service->getWallet($this->id, $walletId);
    }
}
