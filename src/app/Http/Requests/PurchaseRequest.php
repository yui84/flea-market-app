<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'purchase_id' => 'required',
            'user_address' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'purchase_id.required' => '支払い方法を選択してください',
            'user_address.required' => '配送先を選択してください'
        ];
    }
}
