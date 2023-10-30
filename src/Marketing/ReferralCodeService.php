<?php

namespace Aqayepardakht\Handy\Marketing;

use Aqayepardakht\Handy\Models\User;
use Aqayepardakht\Handy\Models\MarketingPivot;
use Aqayepardakht\Handy\Marketing\Contracts\Referralable;
use Aqayepardakht\Handy\Marketing\Strategies\UserReferralStrategy;
use Aqayepardakht\Handy\Marketing\Exceptions\CodeNotFoundException;
use Aqayepardakht\Handy\Marketing\Strategies\GatewayReferralStrategy;

class ReferralCodeService {
    
    protected $ownerId;
    protected $marketableId;
    protected $marketableType;
    protected $strategies = [];

    public function __construct() {

        $this->strategies = [
            new GatewayReferralStrategy(),
            new UserReferralStrategy(),
        ];
    }

    public function checkRefCode(User $ownerModel, Referralable $referralableModel) {

        try {

            $this->ownerId = $ownerModel->id;
            foreach ($this->strategies as $strategy) {
                $this->marketableId = $strategy->getReferralConsumerId($referralableModel);
                if ($this->marketableId) {
                    $this->marketableType = $strategy->getReferralConsumerType();
                    break;
                }
            }

            if (is_null($this->marketableId) || is_null($this->marketableType)) {
                throw new \InvalidArgumentException('Invalid model provided. No suitable strategy found.');
            }

            $this->saveToPivot();
            return true;
        } catch (\Exception $exc) {
            throw $exc;
        }
    }

    protected function saveToPivot(): void {
   
        MarketingPivot::create([
            'owner_id'        => $this->ownerId,
            'marketable_id'   => $this->marketableId,
            'marketable_type' => $this->marketableType,
        ]);
    }

}