<?php

namespace Aqayepardakht\Handy\Wallet\Repositories;

use Aqayepardakht\Handy\Wallet\Models\Refund;

class RefundRepository
{
    public function findByTraceCode($traceCode)
    {
        return Refund::where('trace_code', $traceCode)->first();
    }

    public function findById(int $id)
    {
        return Refund::where('id', $id)->first();
    }

    public function save(Refund $refund, array $data): Refund
    {
        $refund->fill($data);
        $refund->save();

        return $refund;
    }
}
