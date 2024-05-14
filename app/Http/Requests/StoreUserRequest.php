<?php

namespace App\Http\Requests;

use App\Enums\UserRole;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
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
            'email' => ['required', 'email', Rule::unique(User::class, 'email')],
            'password' => ['required', 'string'],
            'role' => ['required', Rule::enum(UserRole::class)],
            'avatar' => ['nullable', 'image'],
            'customer_phone_number' => ['nullable', Rule::unique(Customer::class, 'phone_number')],
            'customer_identity_number' => ['nullable', Rule::unique(Customer::class, 'identity_number')],
            'customer_address' => ['nullable', 'string'],
        ];
    }
}
