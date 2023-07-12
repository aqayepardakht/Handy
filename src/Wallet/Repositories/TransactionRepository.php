<?php

namespace Aqayepardakht\Handy\Wallet\Repositories;

use Aqayepardakht\Handy\Wallet\Models\{Transaction, Invoice, Wallet};

class TransactionRepository
{
    private $model;

    public function __construct(Transaction $model)
    {
        $this->model = $model;
    }

    public function create(array $data): Transaction
    {
        return $this->model->create($data);
    }

    public function transfer(float $amount, Wallet $fromWallet, Wallet $toWallet): void
    {
        \DB::transaction(function () use ($amount, $fromWallet, $toWallet) {
            $this->create([
                'type' => 'transfer',
                'amount' => $amount,
                'wallet_id' => $fromWallet->id,
                'related_wallet_id' => $toWallet->id,
            ]);

            $this->create([
                'type' => 'transfer',
                'amount' => $amount,
                'wallet_id' => $toWallet->id,
                'related_wallet_id' => $fromWallet->id,
            ]);

            $fromWallet->balance -= $amount;
            $fromWallet->save();

            $toWallet->balance += $amount;
            $toWallet->save();
        });
    }
}
