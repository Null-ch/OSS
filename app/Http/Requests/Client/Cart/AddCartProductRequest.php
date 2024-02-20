<?php

namespace App\Http\Requests\Client\Cart;

use Illuminate\Foundation\Http\FormRequest;

class AddCartProductRequest extends FormRequest
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
            'id' => 'required|integer',
            'quantity' => 'required|integer',
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
            'id.required' => 'Это поле должно быть заполнено',
            'quantity.required' => 'Это поле должно быть заполнено',
            'id.integer' => 'Должно быть передано числовое значение',
            'quantity.integer' => 'Должно быть передано числовое значение',

        ];
    }
}
