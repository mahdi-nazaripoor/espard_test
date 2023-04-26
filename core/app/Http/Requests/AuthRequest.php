<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        if(request()->routeIs('auth.login')){
            return [
                'mobile' => ['required','regex:/^[0-9]{11}$/','exists:users,mobile'],
                'password' => ['required']
            ];
        }

        return [];
    }

    public function messages()
    {
        if(request()->routeIs('auth.login')){
            return [
                'mobile.required' => 'ارسال شماره موبایل اجباری می باشد',
                'mobile.regex' => 'فرمت شماره موبایل ارسالی صحیح نمی باشد',
                'mobile.exists' => 'کاربری با این مشخصات یافت نگردید',
                'password.required' => 'ارسال رمز عبور اجباری می باشد',
            ];
        }
        return [];
    }
}
