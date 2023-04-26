<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserBookmarkProductRequest extends FormRequest
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

        if(request()->routeIs('products.bookmark') || request()->routeIs('products.unbookmark')){
            return [
                'product' => ['required','exists:products,uid'],
            ];
        }

        return [];
    }

    public function messages()
    {
        if(request()->routeIs('products.bookmark') || request()->routeIs('products.unbookmark')){
            return [
                'product.required' => 'ارسال کد محصول اجباری می باشد',
                'product.exists' => 'کد محصول ارسال شده صحیح نمی باشد',
            ];
        }
        return [];
    }
}
