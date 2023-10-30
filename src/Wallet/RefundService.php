<?php

namespace Aqayepardakht\Handy\Wallet;

use Aqayepardakht\Handy\Wallet\Models\Refund;
use Aqayepardakht\Handy\Wallet\Repositories\RefundRepository;
use Aqayepardakht\Handy\Wallet\Contract\RefundServiceInterface;

class RefundService implements RefundServiceInterface{

    public function __construct(public RefundRepository $refundRepository) {}

    public function save($tarnsaction_id , $amount , $trace_code) :Refund {

        $data = [
            'transaction_id' => $transaction_id,
            'amount' => $amount,
            'trace_code' => $trace_code,
        ];
    
        $refund = new Refund();
        $savedRefund = $this->refundRepository->save($refund, $data);
    
        return $savedRefund;
    }

    public function checkUser($tarnsaction_id) {}
}