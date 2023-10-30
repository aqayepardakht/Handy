<?php

namespace Aqayepardakht\Handy\Tests\Unit;

use Aqayepardakht\Handy\Models\User;
use Aqayepardakht\Handy\Gateway\Gateway;
use Aqayepardakht\Handy\Marketing\ReferralCodeService;

class ReferralCodeServiceTest extends TestCase {
    
    protected $referralCodeService;


    protected function setUp(): void {

        parent::setUp();
        $this->referralCodeService = new ReferralCodeService();
    }

    public function testCheckRefCodeWithValidGateway() {

        $referralOwner = User::factory()->create();
        $consumer = Gateway::factory()
            ->forReferralOwner($referralOwner)
            ->create();
    
        $response = $this->referralCodeService->checkRefCode($referralOwner, $consumer);
    
        $this->assertTrue($response);
    }
    
    public function testCheckRefCodeWithValidUser() {

        $referralOwner = User::factory()->create();
        $consumer  = User::factory()->create();

        $response = $this->referralCodeService->checkRefCode($referralOwner, $consumer);
      
        $this->assertTrue($response);
    }
    
    public function testCheckRefCodeWithInvalidModel() {

        $referralOwner = User::factory()->create();
    
        $response = $this->referralCodeService->checkRefCode($referralOwner, null);
       
        $this->expectException(\InvalidArgumentException::class);
    }
    
    public function testCheckRefCodeWithInvalidOwner() {
       
        $referralOwner = User::factory()->create();
        $consumer = Gateway::factory()
            ->forReferralOwner($referralOwner)
            ->create();
    
        $response = $this->referralCodeService->checkRefCode(null, $consumer);
        $this->expectException(\InvalidArgumentException::class);
    }
}