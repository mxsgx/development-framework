<?php

namespace Database\Factories;

use App\Enums\CarStatus;
use App\Enums\CarTransmissionType;
use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Car>
 */
class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'brand_id' => Brand::factory(),
            'name' => $this->faker->name(),
            'plate_number' => $this->faker->numerify('AB####CD'),
            'vehicle_year' => $this->faker->year(),
            'color' => $this->faker->colorName,
            'status' => Arr::random([CarStatus::Available, CarStatus::Unavailable]),
            'base_price' => $this->faker->numberBetween(100_000, 500_000),
            'with_driver' => $this->faker->boolean(),
            'driver_price' => function (array $attributes) {
                if ($attributes['with_driver']) {
                    return $this->faker->numberBetween(50_000, 100_000);
                }

                return null;
            },
            'transmission_type' => Arr::random([CarTransmissionType::Automatic, CarTransmissionType::Manual]),
            'total_seat' => $this->faker->numberBetween(1, 6),
            'total_baggage' => $this->faker->numberBetween(1, 3),
        ];
    }
}
