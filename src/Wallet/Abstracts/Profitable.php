<?php

namespace Aqayepardakht\Handy\Wallet\Abstracts;

use Aqayepardakht\Handy\Wallet\Models\Transaction;
use Aqayepardakht\Handy\Wallet\Models\Wallet;
use Aqayepardakht\Handy\Wallet\Models\Profit;
use Illuminate\Database\Eloquent\Model;

abstract class Profitable {

    public function generateProfit(float $initialAmount, $model): Profit {
        $profitAmount = $this->calculate($initialAmount);

        $profit = new Profit([
            'amount' => $initialAmount - $profitAmount,
            'type'   => get_class($this),
            'meta'   => $this->prepareMetadata($model)
        ]);

        return $profit;
    }

    public abstract function calculate(float $initialAmount): float;
    public abstract function prepareMetadata(Model $model): array;
}
