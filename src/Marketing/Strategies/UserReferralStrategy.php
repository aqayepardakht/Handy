<?php

namespace Aqayepardakht\Handy\Marketing\Strategies;

use Aqayepardakht\Handy\Models\User;
use Aqayepardakht\Handy\Marketing\Contracts\Referralable;
use Aqayepardakht\Handy\Marketing\Contracts\ReferralStrategyInterface;

class UserReferralStrategy implements ReferralStrategyInterface {
    
    public function getReferralConsumerId(Referralable $referralableModel): int | null{

        if ($referralableModel instanceof User) {
            return $referralableModel->getUserId();
        }

        return null;
    }

    public function getReferralConsumerType(): string {
        
        return User::class;
    }
}