<?php

namespace App\Http\Requests;

use App\Enums\UserRole;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCustomerRequest extends FormRequest
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
        return [
            'name' => ['required', 'string'],
            'phone_number' => ['required', 'string', Rule::unique(Customer::class, 'phone_number')],
            'identity_number' => ['required', 'string', Rule::unique(Customer::class, 'identity_number')],
            'address' => ['required', 'string'],
            'create_user' => ['nullable', 'boolean'],
            'user_id' => ['nullable', Rule::exists(User::class, 'id')],
            'user_email' => ['required_if:create_user,1', 'nullable', 'email', Rule::unique(User::class, 'email')],
            'user_password' => ['required_if:create_user,1', 'nullable', 'string'],
        ];
    }
}
