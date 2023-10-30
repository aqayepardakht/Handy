<?php

namespace Aqayepardakht\Handy\Marketing\Contracts;

use Aqayepardakht\Handy\Marketing\Contracts\Referralable;

interface ReferralStrategyInterface {
    
    public function getReferralConsumerId(Referralable $referralableModel): int | null;
    public function getReferralConsumerType(): string;
}