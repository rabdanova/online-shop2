<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignUpRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:2|max:255|regex:/^[a-zA-Za-яА-ЯёЕ]+$/u',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:4|confirmed'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'=>'Имя должно быть обязательно указано',
            'name.min'=>'Имя должно быть больше 2 символов',
            'email.required'=>'email должно быть обязательно указано',
            'email.email'=>'Некорректный тип email',
            'password.required'=>'Пароль должен быть обязательно указан',
            'password.min'=>'Пароль должен быть больше 4 символов'
        ];
    }
}
