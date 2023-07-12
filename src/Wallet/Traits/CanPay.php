<?php

namespace Aqayepardakht\Handy\Wallet\Traits;

use Aqayepardakht\Handy\Wallet\Models\Transaction;
use Aqayepardakht\Handy\Wallet\Models\Wallet;
use Aqayepardakht\Handy\Wallet\Models\Invoice;
use Aqayepardakht\PhpSdk\Invoice as PayableInvoice;

trait CanPay {
    public function invoices()
    {
        return $this->hasMany(Invoice::class, 'payable_id');
    }

    public function purchase($invoice)
    {

        $invoice->mobile = !$invoice->mobile && $this->mobile ? $this->mobile : null;
        $invoice->email  = !$invoice->email && $this->email ? $this->email : null;

        $invoice = $this->invoices()->save($invoice);

        return app(WalletService::class)->purchase($invoice);
    }

    public function verifyPayment($invoiceTraceCode)
    {
        $invoice = $this->invoices()->where('trace_code', $invoiceTraceCode)->first();

        if (!$invoice) {
            throw new InvoiceNotFoundException;
        }

        return app(WalletService::class)->verifyPayment($invoice->tracking_number, $invoiceTraceCode);
    }
}
