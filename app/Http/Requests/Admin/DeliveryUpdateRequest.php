<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class DeliveryUpdateRequest extends FormRequest
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
            'title.required' => 'Необходимо заполнить заголовок',
            'title.string' => 'Содержимое должно быть текстом',
            'title.max' => 'Максимальная длина 255 знаков',
        ];
    }
}
