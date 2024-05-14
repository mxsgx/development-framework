<?php

namespace App\Http\Requests;

use App\Enums\UserRole;
use App\Models\Customer;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->role === UserRole::Admin;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $customer = $this->route('customer');

        return [
            'user_id' => [
                'nullable',
                'integer',
                Rule::unique(Customer::class, 'user_id')->ignore($customer->user_id, 'user_id'),
            ],
            'name' => ['required', 'string'],
            'identity_number' => ['required', 'string', Rule::unique(Customer::class, 'identity_number')->ignore($customer->identity_number, 'identity_number')],
            'phone_number' => ['required', 'string'],
            'address' => ['required', 'string'],
        ];
    }
}
