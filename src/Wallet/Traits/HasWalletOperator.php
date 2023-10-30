<?php

namespace Aqayepardakht\Handy\Wallet\Traits;

use Aqayepardakht\Handy\Wallet\Models\Wallet;
use Aqayepardakht\Handy\Wallet\Models\Transaction;
use Aqayepardakht\Handy\Wallet\Requests\WalletRequest;

trait HasWalletOperator {
    public function deposit(float $amount, Wallet $wallet): Transaction {
        $service = app(WalletServiceInterface::class);
        return $service->deposit($amount, $wallet);
    }

    public function withdraw(float $amount, $walletId) {
        $service = app(WalletServiceInterface::class);
        $wallet = $service->getWallet($this->setWalletRequest($walletId));
        return $service->withdraw($amount, $wallet);
    }

    public function transfer($amount, $fromWalletId, $toWalletId) {
        $service = app(WalletServiceInterface::class);
        $fromWallet = $service->getWallet($this->setWalletRequest($fromWalletId));
        $toWallet = $service->getWallet($this->setWalletRequest($toWalletId));
        return $service->transfer($amount, $fromWallet, $toWallet);
    }

    public function hasWallet($walletId) {
        $service = app(WalletServiceInterface::class);
        return $service->hasWallet($this->setWalletRequest($walletId));
    }

    public function getWallet($walletId) {
        $service = app(WalletServiceInterface::class);
        return $service->getWallet($this->setWalletRequest($walletId));
    }

    public function setWalletRequest($walletId) {

        $request = new WalletRequest();
        $request->holder_id = $this->id;
        $request->holder_type = get_class($this);
        $request->wallet_id = $walletId;
        
        return $request;
    } 
}
