<?php

namespace Aqayepardakht\Handy\Marketing\Strategies;

use Aqayepardakht\Handy\Gateway\Gateway;
use Aqayepardakht\Handy\Marketing\Contracts\Referralable;
use Aqayepardakht\Handy\Marketing\Contracts\ReferralStrategyInterface;

class GatewayReferralStrategy implements ReferralStrategyInterface {
    
    public function getReferralConsumerId(Referralable $referralableModel) : int | null{

        if ($referralableModel instanceof Gateway) {
            return $referralableModel->getUserId();
        }

        return null;
    }

    public function getReferralConsumerType(): string {
        
        return Gateway::class;
    }
}
