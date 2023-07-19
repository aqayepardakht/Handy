<?php

namespace Aqayepardakht\Handy\Tests\Unit;

use Aqayepardakht\Handy\Wallet\Models\{
    Wallet, 
    Invoice,
    Transaction
};
use Aqayepardakht\Handy\Wallet\Repositories\{ 
    TransactionRepository, 
    InvoiceRepository, 
    WalletRepository
};
use Aqayepardakht\Handy\Wallet\WalletService;
use Aqayepardakht\Handy\Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Aqayepardakht\Handy\Wallet\Requests\WalletRequest;
use Aqayepardakht\PhpSdk\Api;
use Aqayepardakht\PhpSdk\Invoice as PayableInvoice;

class WalletServiceTest extends TestCase
{
    private $invoiceRepository;
    private $walletRepository;
    private $transactionRepository;
    private $walletService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->invoiceRepository = new InvoiceRepository(new Invoice());
        $this->walletRepository = new WalletRepository(new Wallet());
        $this->transactionRepository = new TransactionRepository(new Transaction());
        $this->walletService = new WalletService($this->invoiceRepository, $this->walletRepository, $this->transactionRepository);
    }

    public function testPurchase()
    {
        // create a wallet
        $wallet = Wallet::factory()->create();

        // create an invoice
        $invoice = Invoice::factory()->create([
            'product_id' => $wallet->id,
            'amount' => 1000,
            'status' => 'created',
        ]);

        // make a request to the purchase method
        $result = $this->walletService->purchase($invoice);

        // assert that the result is a string
        $this->assertIsString($result);
    }

    public function testVerifyPayment()
    {
        // create a wallet
        $wallet = Wallet::factory()->create();
        // create an invoice
        $invoice = Invoice::factory()->create([
            'product_id' => $wallet->id,
            'amount' => 100,
            'status' => 'created',
        ]);

        // make a fake payment
        $api = new Api([
            'pin' => 'fake_pin',
        ]);
        $payableInvoice = new PayableInvoice($invoice->toArray());

        $payableInvoice->setCallback('http://example.com/callback');

        $pay = $api->gateway()->invoice($payableInvoice)->create();
        
        $result = $api->gateway()->invoice(
            new PayableInvoice([
                'amount'  => $invoice->amount,
                'transid' => $pay->invoice->getTraceCode(),
            ])
        )->verify($pay->invoice->getTraceCode());

        // make a request to the verifyPayment method
        $result = $this->walletService->verifyPayment('123456', $pay->invoice->getTraceCode());

        // assert that the result is an instance of Invoice
        $this->assertInstanceOf(Invoice::class, $result);

        // assert that the invoice status is either 'paid' or 'unpaid'
        $this->assertTrue(in_array($result->status, ['paid', 'unpaid']));
    }

    public function testDeposit()
    {
        // create a wallet
        $wallet = Wallet::factory()->create();

        // make a request to the deposit method
        $result = $this->walletService->deposit(100, $wallet);

        // assert that the result is an instance of Transaction
        $this->assertInstanceOf(Transaction::class, $result);

        // assert that the wallet balance has been updated
        $this->assertEquals(100, $wallet->balance);
    }

    public function testWithdraw()
    {
        // create a wallet
        $wallet = Wallet::factory()->create([
            'balance' => 100,
        ]);

        // make a request to the withdraw method
        $result = $this->walletService->withdraw(50, $wallet);

        // assert that the result is an instance of Transaction
        $this->assertInstanceOf(Transaction::class, $result);

        // assert that the wallet balance has been updated
        $this->assertEquals(50, $wallet->balance);
    }

    public function testTransfer()
    {
        // create two wallets
        $fromWallet = Wallet::factory()->create([
            'balance' => 100,
        ]);
        $toWallet = Wallet::factory()->create();

        // makea request to the transfer method
        $this->walletService->transfer(50, $fromWallet, $toWallet);

        // assert that the fromWallet balance has been updated
        $this->assertEquals(50, $fromWallet->balance);

        // assert that the toWallet balance has been updated
        $this->assertEquals(50, $toWallet->balance);
    }

    public function testHasWallet()
    {
        // create a user and a wallet
        $holder_id = 1;
        $holder_type = 'App\\Models\\User';

        $wallet = Wallet::factory()->create([
            'holder_id'   => $holder_id,
            'holder_type' => $holder_type,
        ]);

        // make a request to the hasWallet method
        $result = $this->walletService->hasWallet(new WalletRequest([
            'wallet_id' => $wallet->id
        ]));

        // assert that the result is true
        $this->assertTrue($result);

        $result = $this->walletService->hasWallet(new WalletRequest([
            'holder_id'   => $holder_id, 
            'holder_type' => $holder_type
        ]));

        $this->assertTrue($result);
    }

    public function testGetWallet()
    {
        // create a user and a wallet
        $holder_id = 1;
        $holder_type = 'App\\Models\\User';

        $wallet = Wallet::factory()->create([
            'holder_id' => $holder_id,
            'holder_type' => $holder_type
        ]);

        // make a request to the getWallet method
        $result = $this->walletService->getWallet(new WalletRequest([
            'holder_id'   => $holder_id, 
            'holder_type' => $holder_type
        ]));

        // assert that the result is an instance of Wallet
        $this->assertInstanceOf(Wallet::class, $result);
    }
}
