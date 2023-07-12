<?php

namespace Aqayepardakht\Handy\Wallet\Traits;

use Aqayepardakht\Handy\Wallet\Models\Transaction;
use Aqayepardakht\Handy\Wallet\Models\Wallet;
use Aqayepardakht\Handy\Wallet\Models\Profit;
use Aqayepardakht\Handy\Wallet\Abstracts\Profitable;

trait HasProfit {

    public function profits() {
        return $this->hasMany(Profit::class, 'transaction_id');
    }

    public function addProfit(Profitable ...$adapters): self
    {
        $this->profitAdapters = $adapters;

        return $this;
    }

    public function applyProfit($amount)
    {
        $profit = collect();

        foreach ($this->profitAdapters as $adapter) {
            $profit->push($adapter->generateProfit($amount, $this));
        }

        return $profit;
    }
}
