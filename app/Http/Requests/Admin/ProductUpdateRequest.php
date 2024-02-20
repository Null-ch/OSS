<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:655',
            'price' => 'required|int',
            'quantity' => 'required|int',
            'hex_code' => 'required',
            'category_id' => 'required|int',
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
            'title.required' => 'Поле обязательно для заполнения',
            'description.required' => 'Поле обязательно для заполнения',
            'price.required' => 'Поле обязательно для заполнения',
            'quantity.required' => 'Поле обязательно для заполнения',
            'category_id.required' => 'Поле обязательно для заполнения',
            'hex_code.required' => 'Поле обязательно для заполнения',
            'title.string' => 'Содержимое должно быть текстом',
            'description.string' => 'Содержимое должно быть текстом',
            'price.int' => 'Содержиое должно быть числом',
            'quantity.int' => 'Содержиое должно быть числом',
            'category_id.int' => 'Содержиое должно быть числом',
            'title.max' => 'Максимальная длина 255 знаков',
            'description.max' => 'Максимальная длина 655',
        ];
    }
}
