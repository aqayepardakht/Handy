<?php

namespace Tests\Unit;

use Aqayepardakht\Handy\Models\User;
use Aqayepardakht\Handy\Tests\TestCase;
use Aqayepardakht\Handy\Wallet\Models\Wallet;
use Aqayepardakht\Handy\Wallet\Traits\HasWalletOperator;

class HasWalletOperatorTest extends TestCase
{

    use HasWalletOperator;

    public function testDeposit() {
    
        $wallet =  Wallet::factory()->create();
        $amount = 100;

        $transaction = $this->deposit($amount, $wallet);

        $this->assertInstanceOf(Transaction::class, $transaction);
        $this->assertEquals($amount, $wallet->balance);
    }

    public function testWithdraw() {

        $wallet = Wallet::factory()->create([
            'balance' => 100,
        ]); 
        $amount = 50;

        $transaction = $this->withdraw($amount, $wallet);

        $this->assertInstanceOf(Transaction::class, $transaction);
        $this->assertEquals($amount, $wallet->balance);
    }

    public function testTransfer() {
    
        $fromWallet = Wallet::factory()->create([
            'balance' => 100,
        ]);
        $toWallet =  Wallet::factory()->create();
        $amount = 50;

        $transaction = $this->transfer($amount, $fromWallet, $toWallet);


        $this->assertInstanceOf(Transaction::class, $transaction);
        $this->assertEquals(50, $fromWallet->balance); 
        $this->assertEquals(50, $toWallet->balance); 
    }

    public function testHasWallet() {

        $walletId = 1; 

        $result = $this->hasWallet($walletId);

        $this->assertTrue($result);
    }

    public function testGetWallet() {

        $walletId = 1;

        $wallet = $this->getWallet($walletId);

        $this->assertInstanceOf(Wallet::class, $wallet);
    }
}