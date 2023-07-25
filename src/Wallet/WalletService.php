<?php

namespace Aqayepardakht\Handy\Wallet;

use Aqayepardakht\PhpSdk\Api;
use Aqayepardakht\PhpSdk\Invoice as PayableInvoice;
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

use Aqayepardakht\Handy\Wallet\Exceptions\{
    InsufficientBalanceException,   
    InvoiceNotFoundException,
    InvalidInvoiceException,
    InvalidRequestException,
    UnsuccessfulPaymentException,
    WalletNotFoundException
};

use Aqayepardakht\Handy\Wallet\Requests\WalletRequest;

class WalletService
{
    private $invoiceRepository;
    private $walletRepository;
    private $transactionRepository;
    protected $profitAdapters = [];

    public function __construct(InvoiceRepository $invoiceRepository, WalletRepository $walletRepository, TransactionRepository $transactionRepository)
    {
        $this->invoiceRepository     = $invoiceRepository;
        $this->walletRepository      = $walletRepository;
        $this->transactionRepository = $transactionRepository;
    }

    public function purchase(Invoice $invoice): string
    {
        $api = new Api([
            'pin' => config('Handy.pay.pin', 'AQaqayepardakht'),
        ]);

        $payableInvoice = new PayableInvoice($invoice->toArray());

        $payableInvoice->setCallback(config('Handy.pay.callback_url', 'http://sandbox.test'));

        $pay = $api->gateway()->invoice($payableInvoice)->create();
        $invoice->trace_code = $pay->invoice->getTraceCode();
        $invoice->status     = 'created';
        $invoice->save();

        return $pay->start();
    }

    public function verifyPayment($trackingNumber, $transactionId): Invoice
    {
        $invoice = $this->invoiceRepository->findByTraceCode($transactionId);

        if (!$invoice) {
            throw new InvoiceNotFoundException;
        }

        if ($invoice->status !== 'created') {
            throw new InvalidInvoiceException;
        }

        $api = new Api([
            'pin' => config('Handy.pay.pin') ? config('Handy.pay.pin') : 'sandbox',
        ]);


        $result = $api->gateway()->invoice(
            new PayableInvoice([
                'amount'  => $invoice->amount,
                'transid' => $transactionId
            ])
        )->verify($transactionId);

        if ($result->invoice_id !== $invoice->product_id) {
            throw new InvalidRequestException;
        }

        $invoice = $this->invoiceRepository->update($invoice, [
            'card_numbers'    => $result->card_number ?? null,
            'status'          => $result->status !== "success" ? 'unpaid' : 'paid',
            'tracking_number' => $trackingNumber
        ]);

        if ($result->status !== "success") {
            throw new UnsuccessfulPaymentException;
        }

        VerifyPurchase::dispatch();

        return $invoice;
    }

    public function deposit(float $amount, Wallet $wallet): Transaction
    {
        $profits = $this->applyProfit($amount);

        if ($profits) {
            $amount -= $profits->sum('amount');
        }

        $transaction = $this->transactionRepository->create([
            'type'      => 'deposit',
            'amount'    => $amount,
            'wallet_id' => $wallet->id,
        ]);

        $wallet->balance += $amount;
        $wallet->save();

        $transaction->profits()->saveMany($profits);

        return $transaction;
    }

    public function withdraw(float $amount, Wallet $wallet): Transaction
    {
        if ($wallet->balance < $amount) {
            throw new InsufficientBalanceException;
        }

        $transaction = $this->transactionRepository->create([
            'type'      => 'withdrawal',
            'amount'    => $amount,
            'wallet_id' => $wallet->id,
        ]);

        $wallet->balance -= $amount;
        $wallet->save();

        return $transaction;
    }

    public function transfer(float $amount, Wallet $fromWallet, Wallet $toWallet): void
    {
        if ($fromWallet->balance < $amount) {
            throw new InsufficientBalanceException;
        }

        $this->transactionRepository->transfer($amount, $fromWallet, $toWallet);
    }

    public function hasWallet(WalletRequest $request): bool
    {
        $wallet = $this->getWallet($request);

        if ($request->has('wallet_id') && $wallet) return true; 

        return $wallet->holder_id === $request->holder_id && $wallet->holder_type === $request->holder_type;
    }

    public function getWallet(WalletRequest $request): Wallet
    {
        $wallet = $this->walletRepository->find($request);

        if (!$wallet) {
            throw new WalletNotFoundException;
        }

        return $wallet;
    }

    public function getTransactions(WalletRequest $request)
    {
        $wallet = Wallet::where('id', $request->wallet_id)
                    ->where('holder_id', $request->holder_id)
                    ->where('holder_type', $request->holder_type)
                    ->first();

        if (!$wallet) {
            throw new WalletNotFoundException;
        }

        return $wallet->transactions;
    }

    public function applyProfit($amount)
    {
        $profits = collect();

        foreach ($this->profitAdapters as $adapter) {
            $profits->push($adapter->generateProfit($amount, $this));
        }

        return $profits;
    }
}
