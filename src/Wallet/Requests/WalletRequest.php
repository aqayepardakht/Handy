<?php 

namespace Aqayepardakht\Handy\Wallet\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WalletRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'holder_id'   => 'required_if:holder_type|integer',
            'holder_type' => 'required_if:holder_id|in:user,customer',
            'wallet_id'   => 'required_without:holder_type,holder_id|integer',
        ];
    }
}