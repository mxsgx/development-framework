<?php

namespace App\Http\Requests;

use App\Enums\CarStatus;
use App\Enums\CarTransmissionType;
use App\Enums\UserRole;
use App\Models\Brand;
use App\Models\Car;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCarRequest extends FormRequest
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
        $car = $this->route('car');

        return [
            'brand_id' => ['required', Rule::exists(Brand::class, 'id')],
            'name' => ['required', 'string'],
            'plate_number' => ['required', Rule::unique(Car::class, 'plate_number')->ignore($car->plate_number, 'plate_number')],
            'vehicle_year' => ['required', 'numeric'],
            'color' => ['required', 'string'],
            'status' => ['required', Rule::enum(CarStatus::class)],
            'base_price' => ['required', 'decimal:0'],
            'with_driver' => ['nullable', 'boolean'],
            'driver_price' => ['required_if:with_driver,1', 'nullable', 'decimal:0'],
            'transmission_type' => ['required', Rule::enum(CarTransmissionType::class)],
            'total_seat' => ['required', 'integer'],
            'total_baggage' => ['required', 'integer'],
            'previews' => ['nullable'],
            'previews.*' => ['nullable', 'image'],
        ];
    }
}
