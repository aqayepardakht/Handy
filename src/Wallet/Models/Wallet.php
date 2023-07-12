<?php

namespace Aqayepardakht\Handy\Wallet\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Factories\Factory;

class Wallet extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->table = config('Handy.wallet.table', 'Handy_wallets');
                // $this->fillable = array_keys(config('Handy.wallet.rules'));

    }

    /**
     * Create a new factory instance for the model.
    */
    protected static function newFactory(): Factory
    {
        return \Aqayepardakht\Handy\Database\Factories\WalletFactory::new();
    }
}
