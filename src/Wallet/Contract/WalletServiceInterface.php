<?php

namespace Aqayepardakht\Handy\Wallet\Contract;

interface WalletServiceInterface {

    public function deposit(float $amount, Wallet $wallet): Transaction;

    public function withdraw(float $amount, Wallet $wallet): Transaction;

    public function transfer(float $amount, Wallet $fromWallet, Wallet $toWallet): void;

    public function hasWallet(int $holder_id, string $holder_type , int $walletId): bool;

    public function getWallet(int $holder_id, string $holder_type , int $walletId): Wallet;
}