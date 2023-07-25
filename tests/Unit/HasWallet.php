<?php 

namespace Aqayepardakht\Handy\Tests\Unit;

use Aqayepardakht\Handy\Tests\TestCase;
use Aqayepardakht\Handy\Wallet\Models\Wallet;
use stdClass;
use Aqayepardakht\Handy\Wallet\Traits\HasWallet;

class HasWalletTest extends TestCase
{
    use HasWallet;

    public function testCreateWallet()
    {
        $holder = new stdClass();
        $walletCount = Wallet::count();
        $holder->id = 1;

        $walletId = $this->createWallet($holder, 'My Wallet');
       
        $this->assertEquals($walletCount + 1, Wallet::count());

        $this->assertDatabaseHas('wallets', [
            'name' => 'My Wallet',
            'holder_id' => $holder->id,
            'holder_type' => get_class($this),
        ]);
    }
}