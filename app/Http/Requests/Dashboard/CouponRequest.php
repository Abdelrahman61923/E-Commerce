<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CouponRequest extends FormRequest
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
            'code' => ['required', 'string', 'max:255',
                Rule::unique('coupons', 'code')->ignore($this->route('coupon')?->id)],
            'type' => ['required', 'in:fixed,percent'],
            'value' => ['required', 'numeric', 'min:0',
                function ($attribute, $value, $fail) {
                    if (request('type') === 'percent' && $value > 100) {
                        $fail('The discount percentage cannot be more than 100.');
                    }
                },
            ],
            'cart_value' => ['required', 'numeric', 'min:0'],
            'expiry_date' => ['required', 'date', 'after_or_equal:today'],
        ];
    }
    public function messages(): array
    {
        return [
            'code.required' => 'Coupon code is required.',
            'code.unique' => 'This coupon code already exists.',
            'type.in' => 'Coupon type must be fixed or percent.',
            'value.required' => 'Discount value is required.',
            'value.numeric' => 'Discount value must be a number.',
            'cart_value.required' => 'Minimum cart value is required.',
            'expiry_date.after_or_equal' => 'Expiry date must be today or later.',
        ];
    }
}
