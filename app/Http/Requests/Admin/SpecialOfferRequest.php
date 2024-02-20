<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SpecialOfferRequest extends FormRequest
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
            'header' => 'required|string|max:255',
            'description' => 'required|string|max:655',
            'hex_code' => 'required',
            'sort_order' => 'required',
            'is_active' => 'required',
            'image' => 'required',
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
            'header.required' => 'Необходимо заполнить заголовок',
            'description.required' => 'Необходимо заполнить описание',
            'hex_code.required' => 'Необходимо выбрать цвет',
            'sort_order.required' => 'Необходимо выбрать порядок отображения',
            'is_active.required' => 'Необходимо выбрать активность',
            'image.required' => 'Поле обязательно для заполнения',
            'header.string' => 'Содержимое должно быть текстом',
            'description.string' => 'Содержимое должно быть текстом',
            'header.max' => 'Максимальная длина 255 знаков',
            'description.max' => 'Максимальная длина 655',
        ];
    }
}
