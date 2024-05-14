<?php

namespace App\Http\Requests;

use App\Enums\OrderPaymentMethod;
use App\Enums\UserRole;
use App\Models\Car;
use App\Models\Customer;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreOrderRequest extends FormRequest
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
            'car_id' => ['required', Rule::exists(Car::class, 'id')],
            'customer_id' => ['required', Rule::exists(Customer::class, 'id')],
            'with_driver' => ['required', 'boolean'],
            'payment_method' => ['required', Rule::enum(OrderPaymentMethod::class)],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date'],
        ];
    }
}
