<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CategoryStoreRequest extends FormRequest
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
            'preview_image' => 'required|file|mimes:jpeg,png,jpg|max:16384',
            'description' => 'nullable|string|max:2000',
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
            'preview_image.required' => 'Загрузка превью обязательна',
            'preview_image.file' => 'Загружаемый объект должен быть файлом',
            'preview_image.mimes' => 'Доступные для загрузки расширения файлов: jpeg,png,jpg',
            'preview_image.max' => 'Максимальный размер изображение 16мб',
            'description.string' => 'Содержимое должно быть текстом',
            'description.max' => 'Максимальная длина 2000 знаков',
        ];
    }
}
