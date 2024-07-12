<?php

namespace App\Http\Requests\Client\Order;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
            'cart_id' => 'required|integer',
            'user_shipping_information' => 'required',
            'user_personal_data' => 'required',
        ];
    }
    /**
     * Receiving messages in case of validation error
     *
     * @return array
     * 
     */
    public function messages()
    {
        return [
            'cart_id.required' => 'Это поле должно быть заполнено',
            'user_shipping_information.required' => 'Это поле должно быть заполнено',
            'user_personal_data.required' => 'Это поле должно быть заполнено',
        ];
    }
}
