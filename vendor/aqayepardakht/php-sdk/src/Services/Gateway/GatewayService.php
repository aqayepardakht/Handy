<?php 

namespace Aqayepardakht\PhpSdk\Services\Gateway;

use Aqayepardakht\PhpSdk\Services\Pay\PaymentService;
use Aqayepardakht\PhpSdk\Services\Transaction\TransactionService;
use Aqayepardakht\PhpSdk\Invoice;

class GatewayService {
    private string $pin;

    public function __construct(string $pin) {
        $this->pin = $pin;
    }

    public function invoice(?Invoice $invoice = null): PaymentService {
        if (!$invoice) {
            $invoice = new Invoice();
        }

        return new PaymentService($this->pin, $invoice);
    }

    public function transactions(): TransactionService {
        return new TransactionService();
    }

    public function setPin(string $pin): void {
        $this->pin = $pin;
    }

    public function getPin(): string {
        return $this->pin;
    }
}