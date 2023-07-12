<?php

namespace Aqayepardakht\Handy\Wallet\Repositories;

use Aqayepardakht\Handy\Wallet\Models\{Wallet, Invoice};
use Aqayepardakht\Handy\Wallet\Requests\WalletRequest;

class WalletRepository
{
    private $model;

    public function __construct(Wallet $model)
    {
        $this->model = $model;
    }

    public function find(WalletRequest $request): ?Wallet
    {
        if ($request->has('wallet_id')) {
            return $this->model->where('id', $request->wallet_id)->first();
        }


        return $this->model->where('holder_id', $request->holder_id)
                    ->where('holder_type', $request->holder_type)
                    ->first();
    }

    public function findByUserId(int $userId): Collection
    {
        return $this->model->where('user_id', $userId)->get();
    }

    public function create(array $data): Wallet
    {
        return $this->model->create($data);
    }

    public function update(Wallet $wallet): void
    {
        $wallet->save();
    }

    public function delete(int $id): void
    {
        $this->model->destroy($id);
    }
}
