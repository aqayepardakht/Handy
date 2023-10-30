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

class Refund extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'transaction_id',
        'amount',
        'trace_number'
    ];


    public function transaction() {
        return $this->belongsTo(Transaction::class);
    }

    protected static function newFactory(): Factory
    {
        return \Aqayepardakht\Handy\Database\Factories\InvoiceFactory::new();
    }
}
