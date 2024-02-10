<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
        (int) $userId = request('user_id');

        return [
            'first_name' => 'string|max:255',
            'name' => 'required|string|max:255',
            'last_name' => 'string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($userId),
            ],
            'gender' => '',
            'role' => '',
        ];
    }
    public function messages()
    {
        return [
            'first_name.string' => 'Поле должно быть строкой',
            'name.string' => 'Поле должно быть строкой',
            'name.required' => 'Поле обязательно для заполнения',
            'last_name.string' => 'Поле должно быть строкой',
            'email.string' => 'Поле должно быть строкой',
            'email.required' => 'Это поле должно быть заполнено',
            'email.email' => 'Почта должна быть в формате example@mail.ru',
            'email.unique' => 'Email уже занят',
        ];
    }
}
