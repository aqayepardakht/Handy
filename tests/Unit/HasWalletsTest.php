<?php 

namespace Aqayepardakht\Handy\Tests\Unit;

use Aqayepardakht\Handy\Tests\TestCasee;
use Aqayepardakht\Handy\Wallet\Models\Wallet;
use stdClass;
use Aqayepardakht\Handy\Wallet\Traits\HasWallets;

class HasWalletsTest extends TestCasee
{
    use HasWallets;

    public function testCreateWallet()
    {
        $holder = new stdClass();

        $walletCount = Wallet::count();

        $holder->id = 1;
        $holder->type = 'App\Models\User';

        $walletId = $this->createWallet($holder, 'My Wallet');
       
        $this->assertEquals($walletCount + 1, Wallet::count());

        $this->assertDatabaseHas('wallets', [
            'name' => 'My Wallet',
            'holder_id' => $holder->id,
            'holder_type' => $holder->type,
        ]);
    }
}