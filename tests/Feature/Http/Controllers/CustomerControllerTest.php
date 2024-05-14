<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CustomerControllerTest extends TestCase
{
    use WithFaker;

    protected static ?User $admin = null;

    protected static ?User $user = null;

    protected static ?Customer $customer = null;

    public function setUp(): void
    {
        parent::setUp();

        if (is_null(self::$admin)) {
            self::$admin = User::factory()->createOne();
        }

        if (is_null(self::$user)) {
            self::$user = User::factory()->customer()->createOne();
        }

        if (is_null(self::$customer)) {
            self::$customer = Customer::factory()->for(self::$user)->createOne();
        }
    }

    public function test_admins_can_visit_customers_page(): void
    {
        $response = $this->actingAs(self::$admin)->get(route('admin.customers.index'));

        $response->assertOk();
    }

    public function test_admins_can_visit_create_customer_page(): void
    {
        $response = $this->actingAs(self::$admin)->get(route('admin.customers.create'));

        $response->assertOk();
    }

    public function test_admins_can_create_customer(): void
    {
        $data = [
            'name' => $this->faker->name(),
            'phone_number' => $this->faker->e164PhoneNumber(),
            'identity_number' => $this->faker->numerify('################'),
            'address' => $this->faker->address(),
            'create_user' => false,
        ];
        $response = $this->actingAs(self::$admin)->post(route('admin.customers.store'), $data);

        $response->assertSessionHasNoErrors();
        $response->assertRedirectContains('/edit');
        $this->assertDatabaseHas(Customer::class, [
            'phone_number' => $data['phone_number'],
        ]);
    }

    public function test_admins_can_create_customer_and_user(): void
    {
        $data = [
            'name' => $this->faker->name,
            'phone_number' => $this->faker->e164PhoneNumber(),
            'identity_number' => $this->faker->numerify('################'),
            'address' => $this->faker->address(),
            'create_user' => true,
            'user_email' => $this->faker->email,
            'user_password' => 'password',
        ];
        $response = $this->actingAs(self::$admin)->post(route('admin.customers.store'), $data);

        $response->assertSessionHasNoErrors();
        $response->assertRedirectContains('/edit');
        $this->assertDatabaseHas(User::class, [
            'email' => $data['user_email'],
        ]);
        $this->assertDatabaseHas(Customer::class, [
            'phone_number' => $data['phone_number'],
        ]);
    }

    public function test_admins_can_visit_edit_customer_page(): void
    {
        $response = $this->actingAs(self::$admin)->get(route('admin.customers.edit', ['customer' => self::$customer]));

        $response->assertOk();
    }

    public function test_admins_can_update_customer(): void
    {
        $data = [
            'name' => $this->faker->name(),
            'phone_number' => $this->faker->e164PhoneNumber(),
            'identity_number' => $this->faker->numerify('################'),
            'address' => $this->faker->address(),
        ];
        $response = $this->actingAs(self::$admin)->patch(route('admin.customers.update', ['customer' => self::$customer]), $data);

        $response->assertSessionHasNoErrors();
        $response->assertRedirectContains('/edit');
        $this->assertDatabaseHas(Customer::class, [
            'phone_number' => $data['phone_number'],
        ]);
    }

    public function test_admins_can_delete_customer(): void
    {
        $response = $this->actingAs(self::$admin)->delete(route('admin.customers.destroy', ['customer' => self::$customer]));

        $response->assertRedirectToRoute('admin.customers.index');
        $this->assertDatabaseMissing(Customer::class, [
            'id' => self::$customer->id,
        ]);
    }
}
