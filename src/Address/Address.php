<?php

namespace Aqayepardakht\Handy\Address;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Validator;

class Address extends Model
{
    use SoftDeletes;

    protected $fillable = [];

    protected $casts = [
        'properties' => 'array',

        'deleted_at' => 'datetime',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->table    = config('Handy.address.table', 'address');
        $this->fillable = array_keys(config('Handy.address.rules'));
    }

    public static function boot()
    {
        parent::boot();
    }

    public function addressable(): MorphTo
    {
        return $this->morphTo();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(config('Handy.addresses.users.model', config('auth.providers.users.model', 'App\Models\User')));
    }

    public static function getValidationRules(): array
    {
        $rules = config('Handy.addresses.rules', [
            'postal'  => 'required|ir_postal_code',
            'city'    => 'required|exists:cities,id',
            'address' => 'required|min:3|persian_alpha',
            'type'    => 'nullable',
            'taxcode' => 'nullable',
        ]);

        return $rules;
    }
}
