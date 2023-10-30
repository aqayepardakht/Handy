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

class Transaction extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'type',
        'amount',
        'wallet_id',
        'invoice_id'
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->table = config('handy.transaction.table', 'handy_transactions');
        // $this->fillable = array_keys(config('Handy.wallet.rules'));
    }

    public function profits() {
        return $this->hasMany(Profit::class, 'transaction_id');
    }

    public function invoice() {
        return $this->belongsTo(Invoice::class);
    }

    public function wallet() {
        return $this->belongsTo(Wallet::class , 'wallet_id');
    }

    /**
     * Create a new factory instance for the model.
    */
    protected static function newFactory(): Factory
    {
        return \Aqayepardakht\Handy\Database\Factories\TransactionFactory::new();
    }
}
