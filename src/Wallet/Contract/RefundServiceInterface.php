<?php

namespace Aqayepardakht\Handy\Wallet\Contract;

class RefundServiceInterface {

    public function save(int $tarnsaction_id , float $amount , string $trace_code) :Refund{}
    public function checkUser() {}
}