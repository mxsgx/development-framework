<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_guests_can_visit_registration_page(): void
    {
        $response = $this->get(route('auth.registration'));

        $response->assertOk();
    }

    public function test_guests_can_register(): void
    {
        $data = [
            'name' => $this->faker->name(),
            'email' => $this->faker->safeEmail(),
            'password' => 'password',
            'password_confirmation' => 'password',
            'phone_number' => $this->faker->e164PhoneNumber(),
            'identity_number' => $this->faker->numerify('################'),
            'address' => $this->faker->address(),
        ];
        $response = $this->post(route('auth.register'), $data);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect();
        $this->assertAuthenticated();
        $this->assertDatabaseHas(User::class, [
            'email' => $data['email'],
        ]);
        $this->assertDatabaseHas(Customer::class, [
            'phone_number' => $data['phone_number'],
        ]);
    }

    public function test_guests_can_visit_login_page(): void
    {
        $response = $this->get(route('auth.login'));

        $response->assertOk();
    }

    public function test_guests_can_login(): void
    {
        $user = User::factory()->createOne();
        $response = $this->post(route('auth.authenticate'), ['email' => $user->email, 'password' => 'password']);

        $response->assertSessionHasNoErrors();
        $this->assertAuthenticatedAs($user);
    }

    public function test_users_can_logout(): void
    {
        $user = User::factory()->createOne();

        $this->actingAs($user)->post(route('auth.logout'));
        $this->assertFalse($this->isAuthenticated());
    }
}
