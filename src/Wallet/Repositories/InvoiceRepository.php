<?php

namespace Aqayepardakht\Handy\Wallet\Repositories;

use Aqayepardakht\Handy\Wallet\Models\Invoice;

class InvoiceRepository
{
    public function findByTraceCode($traceCode)
    {
        return Invoice::where('trace_code', $traceCode)->first();
    }

    public function findById(int $id)
    {
        return Invoice::where('id', $id)->first();
    }

    public function update(Invoice $invoice, array $data): Invoice
    {
        $invoice->fill($data);
        $invoice->save();

        return $invoice;
    }
}
