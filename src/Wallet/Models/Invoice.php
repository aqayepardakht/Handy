<?php

namespace Aqayepardakht\Handy\Wallet\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Factories\Factory;

class Invoice extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'payable_id',
        'payable_type',
        'trace_code',
        'tracking_number',
        'amount',
        'card_numbers',
        'product_id',
        'mobile',
        'email',
        'description',
        'status',
    ];

    protected $casts = [
        'meta' => 'array',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->table = config('handy.invoice.table', 'handy_invoices');
        // $this->fillable = array_keys(config('Handy.wallet.rules'));
    }

    public function transaction() {
        return $this->hasOne(Transaction::class);
    }

    protected static function newFactory(): Factory
    {
        return \Aqayepardakht\Handy\Database\Factories\InvoiceFactory::new();
    }
}
