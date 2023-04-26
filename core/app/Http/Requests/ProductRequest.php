<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        if(request()->routeIs('products.store') || request()->routeIs('products.update')){
            return [
                'title' => ['required'],
                'price' => ['required','integer'],
                'description' => ['required']
            ];
        }

        return [];
    }

    public function messages()
    {
        if(request()->routeIs('products.store') || request()->routeIs('products.update')){
            return [
                'title.required' => 'ارسال عنوان محصول اجباری می باشد',
                'price.required' => 'ارسال قیمت محصول اجباری می باشد',
                'price.integer' => 'قیمت محصول بایستی عدد باشد',
                'description.required' => 'ارسال توضیحات محصول اجباری می باشد',
            ];
        }
        return [];
    }
}
