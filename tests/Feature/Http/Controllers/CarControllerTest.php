<?php

namespace Tests\Feature\Http\Controllers;

use App\Enums\CarStatus;
use App\Enums\CarTransmissionType;
use App\Models\Brand;
use App\Models\Car;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CarControllerTest extends TestCase
{
    use WithFaker;

    protected static ?User $admin = null;

    protected static ?Brand $brand = null;

    protected static ?Car $car = null;

    public function setUp(): void
    {
        parent::setUp();

        if (is_null(self::$admin)) {
            self::$admin = User::factory()->createOne();
        }

        if (is_null(self::$brand)) {
            self::$brand = Brand::factory()->createOne();
        }

        if (is_null(self::$car)) {
            self::$car = Car::factory()->for(self::$brand)->createOne();
        }
    }

    public function test_admins_can_visit_cars_page(): void
    {
        $response = $this->actingAs(self::$admin)->get(route('admin.cars.index'));

        $response->assertOk();
    }

    public function test_admins_can_visit_create_car_page(): void
    {
        $response = $this->actingAs(self::$admin)->get(route('admin.cars.create'));

        $response->assertOk();
    }

    public function test_admins_can_create_car(): void
    {
        Storage::fake('public');

        $preview = UploadedFile::fake()->create('car.jpg');
        $data = [
            'brand_id' => self::$brand->id,
            'plate_number' => $this->faker->numerify('AB####CD'),
            'vehicle_year' => $this->faker->year(),
            'color' => $this->faker->colorName(),
            'status' => Arr::random([CarStatus::Available->value, CarStatus::Unavailable->value]),
            'base_price' => $this->faker->numberBetween(100_000, 250_000),
            'with_driver' => $this->faker->boolean(),
            'driver_price' => $this->faker->numberBetween(50_000, 150_000),
            'transmission_type' => Arr::random([CarTransmissionType::Manual->value, CarTransmissionType::Automatic->value]),
            'total_seat' => $this->faker->numberBetween(2, 6),
            'total_baggage' => $this->faker->numberBetween(1, 3),
            'previews' => [$preview],
        ];
        $response = $this->actingAs(self::$admin)->post(route('admin.cars.store'), $data);

        $response->assertSessionHasNoErrors();
        $response->assertRedirectContains('/edit');
        $this->assertDatabaseHas(Car::class, [
            'plate_number' => $data['plate_number'],
        ]);
        Storage::disk('public')->assertExists('car-preview'.DIRECTORY_SEPARATOR.$preview->hashName());
    }

    public function test_admins_can_visit_edit_car_page(): void
    {
        $response = $this->actingAs(self::$admin)->get(route('admin.cars.edit', ['car' => self::$car]));

        $response->assertOk();
    }

    public function test_admins_can_update_car(): void
    {
        $data = [
            'brand_id' => self::$brand->id,
            'plate_number' => $this->faker->numerify('AB####CD'),
            'vehicle_year' => $this->faker->year(),
            'color' => $this->faker->colorName(),
            'status' => Arr::random([CarStatus::Available->value, CarStatus::Unavailable->value]),
            'base_price' => $this->faker->numberBetween(100_000, 250_000),
            'with_driver' => $this->faker->boolean(),
            'driver_price' => $this->faker->numberBetween(50_000, 150_000),
            'transmission_type' => Arr::random([CarTransmissionType::Manual->value, CarTransmissionType::Automatic->value]),
            'total_seat' => $this->faker->numberBetween(2, 6),
            'total_baggage' => $this->faker->numberBetween(1, 3),
        ];
        $response = $this->actingAs(self::$admin)->patch(route('admin.cars.update', ['car' => self::$car]), $data);

        $response->assertSessionHasNoErrors();
        $response->assertRedirectContains('/edit');
        $this->assertDatabaseHas(Car::class, [
            'plate_number' => $data['plate_number'],
        ]);
    }

    public function test_admins_can_delete_car(): void
    {
        $response = $this->actingAs(self::$admin)->delete(route('admin.cars.destroy', ['car' => self::$car]));

        $response->assertRedirectToRoute('admin.cars.index');
        $this->assertDatabaseMissing(Car::class, [
            'plate_number' => self::$car->plate_number,
        ]);
    }
}
