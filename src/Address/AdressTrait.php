<?php

namespace Aqayepardakht\Handy\Addresse;

use Exception;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Collection;

use Aqayepardakht\Handy\Address\Models\Address;
use Aqayepardakht\Handy\Address\Exceptions\FailedValidationException;

class HasAddresses
{

    public function addresses(): MorphMany
    {
        return $this->morphMany(Address::class, 'addressable');
    }

    public function hasAddresses(): bool
    {
        return $this->addresses->isNotEmpty();
    }

    public function addAddress(array $attributes): Address|Model
    {
        $attributes = $this->loadAddressAttributes($attributes);

        return $this->addresses()->updateOrCreate($attributes);
    }

    public function updateAddress(Address $address, array $attributes): bool
    {
        $attributes = $this->loadAddressAttributes($attributes);

        return $address->fill($attributes)->save();
    }

     public function deleteAddress(Address $address): bool
    {
        return $this->addresses()->where('id', $address->id)->delete();
    }

    public function flushAddresses(): bool
    {
        return $this->addresses()->delete();
    }

    public function loadAddressAttributes(array $attributes): array
    {
        $validatedAttributes = $this->validateAddress($attributes);

        return $attributes;
    }

    protected function validateAddress(array $attributes): array
    {
        $rules = (new Address())->getValidationRules();

        try {
            return Validator::make($attributes, $rules)->validate();
        } catch (ValidationException $exception) {
            throw new FailedValidationException('[Addresses] ' . implode(' ', $exception->errors()));
        }
    }

}
