<?php

namespace Database\Factories;

use App\Enums\OrderPaymentMethod;
use App\Enums\OrderStatus;
use App\Models\Car;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'customer_id' => Customer::factory(),
            'car_id' => Car::factory(),
            'status' => Arr::random([
                OrderStatus::Unpaid,
                OrderStatus::Settled,
                OrderStatus::Active,
                OrderStatus::Refunding,
                OrderStatus::Completed,
                OrderStatus::Canceled,
            ]),
            'payment_method' => Arr::random([
                OrderPaymentMethod::BankTransfer,
                OrderPaymentMethod::Cash,
                OrderPaymentMethod::EWallet,
                OrderPaymentMethod::Qris,
            ]),
            'with_driver' => $this->faker->boolean(),
            'start_date' => $this->faker->dateTime(),
            'end_date' => function (array $attributes) {
                $datetime = Carbon::createFromInterface($attributes['start_date']);

                return $datetime->addDays($this->faker->numberBetween(1, 10))->toDateTime();
            },
            'total_price' => function (array $attributes) {
                $car = Car::find($attributes['car_id']);
                $startDate = Carbon::createFromInterface($attributes['start_date']);
                $endDate = Carbon::createFromInterface($attributes['end_date']);
                $rentDuration = $endDate->diffInDays($startDate);

                return ($car->base_price + ($attributes['with_driver'] ? $car->driver_price : 0)) * ($rentDuration < 1 ? 1 : $rentDuration);
            },
            'returned_at' => function (array $attributes) {
                if ($attributes['status'] !== OrderStatus::Completed) {
                    return null;
                }

                $late = $this->faker->boolean();

                if (! $late) {
                    return null;
                }

                return Carbon::createFromInterface($attributes['end_date'])->addHours(1)->toDateTime();
            },
            'total_fine' => function (array $attributes) {
                if (is_null($attributes['returned_at'])) {
                    return null;
                }

                $endDate = Carbon::createFromInterface($attributes['end_date']);
                $returnedDate = Carbon::createFromInterface($attributes['returned_at']);
                $lateHours = $returnedDate->diffInHours($endDate);

                return ($lateHours < 1 ? 1 : $lateHours) * 10_000;
            },
            'refunded_at' => null,
        ];
    }

    public function customer(): static
    {
        return $this->state(fn (array $attributes) => [
            'refunded_at' => $this->faker->dateTime(),
        ]);
    }
}
