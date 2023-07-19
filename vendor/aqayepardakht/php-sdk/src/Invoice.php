<?php

namespace Aqayepardakht\PhpSdk;

use Aqayepardakht\Http\Response;
use Aqayepardakht\Http\Client;
use Aqayepardakht\PhpSdk\Helper;

class Invoice {
    private $amount;
    private $card;
    private $invoiceId;
    private $phone;
    private $email;
    private $description;

    public function __construct(array $data) {
        $this->amount      = floatval(Helper::faToEnNumbers($data['amount']));
        $this->card        = $data['card'] ?? null;
        $this->invoiceId   = $data['invoiceId'] ?? null;
        $this->phone       = $data['phone'] ?? null;
        $this->email       = $data['email'] ?? null;
        $this->description = $data['description'] ?? null;
    }

    public function getItems() {
        return [
            "amount"      => $this->getAmount(),
            "card_number" => $this->getCard(),
            "invoice_id"  => $this->getInvoiceId(),
            "mobile"      => $this->getPhone(),
            "email"       => $this->getEmail(),
            'description' => $this->getDescription(),
            'callback'    => $this->getCallback()
        ];
    }

    public function getAmount() {
        return $this->amount;
    }

    public function setAmount($amount) {
        $amount = floatval(Helper::faToEnNumbers($amount));

        if ($amount == 0 || $amount < 1000 || $amount >= 100000000) {
            throw new \Exception('مبلغ باید به صورت عددی و بیشتر از 1000 تومان و کمتر از  1000,000,000 باشد');
        }

        $this->amount = $amount;

        return $this;
    }

    public function getCard() {
        return $this->card;
    }

    public function setCard($card) {
        Helper::validateCardsNumber($card);

        $this->card = $card;

        return $this;
    }

    public function getInvoiceId() {
        return $this->invoiceId;
    }

    public function setInvoiceId($invoiceId) {
        $this->invoiceId = $invoiceId;

        return $this;
    }

    public function getPhone() {
        return $this->phone;
    }

    public function setPhone($phone) {
        Helper::validateMobileNumber($phone);

        $this->phone = $phone;

        return $this;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        Helper::validateEmail($email);

        $this->email = $email;

        return $this;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;

        return $this;
    }

    public function getCallback(): ?string {
        return $this->callbackUrl; 
    }

    public function setCallback(string $callbackUrl): void {
        $this->callbackUrl = $callbackUrl;
    }

    public function getTraceCode(): string {
        return $this->traceCode;
    }

    public function setTraceCode(string $code): void {
        $this->traceCode = $code;
    }
}