<?php

namespace Tests\Feature\Http\Controllers;

use App\Enums\UserRole;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use WithFaker;

    protected static ?User $admin = null;

    protected static ?User $user = null;

    public function setUp(): void
    {
        parent::setUp();

        if (is_null(self::$admin)) {
            self::$admin = User::factory()->createOne();
        }

        if (is_null(self::$user)) {
            self::$user = User::factory()->createOne();
        }
    }

    public function test_admins_can_visit_users_page(): void
    {
        $response = $this->actingAs(self::$admin)->get(route('admin.users.index'));

        $response->assertOk();
    }

    public function test_admins_can_visit_create_user_page(): void
    {
        $response = $this->actingAs(self::$admin)->get(route('admin.users.create'));

        $response->assertOk();
    }

    public function test_admins_can_create_user(): void
    {
        Storage::fake('public');

        $data = [
            'name' => $this->faker->name(),
            'email' => $this->faker->safeEmail(),
            'password' => 'password',
            'role' => Arr::random([UserRole::Admin->value, UserRole::Customer->value]),
            'avatar' => UploadedFile::fake()->create('avatar.jpg'),
        ];
        $response = $this->actingAs(self::$admin)->post(route('admin.users.store'), $data);

        $response->assertSessionHasNoErrors();
        $response->assertRedirectContains('/edit');
        $this->assertDatabaseHas(User::class, [
            'email' => $data['email'],
        ]);
        Storage::disk('public')->assertExists('user-avatar'.DIRECTORY_SEPARATOR.$data['avatar']->hashName());
    }

    public function test_admins_can_create_user_and_customer(): void
    {
        Storage::fake('public');

        $data = [
            'name' => $this->faker->name(),
            'email' => $this->faker->safeEmail(),
            'password' => 'password',
            'role' => UserRole::Customer->value,
            'avatar' => UploadedFile::fake()->create('avatar.jpg'),
            'customer_phone_number' => $this->faker->e164PhoneNumber(),
            'customer_identity_number' => $this->faker->numerify('################'),
            'customer_address' => $this->faker->address(),
        ];
        $response = $this->actingAs(self::$admin)->post(route('admin.users.store'), $data);

        $response->assertSessionHasNoErrors();
        $response->assertRedirectContains('/edit');
        $this->assertDatabaseHas(User::class, [
            'email' => $data['email'],
        ]);
        $this->assertDatabaseHas(Customer::class, [
            'phone_number' => $data['customer_phone_number'],
        ]);
        Storage::disk('public')->assertExists('user-avatar'.DIRECTORY_SEPARATOR.$data['avatar']->hashName());
    }

    public function test_admins_can_visit_edit_user_page(): void
    {
        $response = $this->actingAs(self::$admin)->get(route('admin.users.edit', ['user' => self::$user]));

        $response->assertOk();
    }

    public function test_admins_can_update_user(): void
    {
        Storage::fake('public');

        $data = [
            'name' => $this->faker->name(),
            'email' => $this->faker->safeEmail(),
            'password' => 'password',
            'role' => Arr::random([UserRole::Admin->value, UserRole::Customer->value]),
            'avatar' => UploadedFile::fake()->create('avatar.jpg'),
        ];
        $response = $this->actingAs(self::$admin)->patch(route('admin.users.update', ['user' => self::$user]), $data);

        $response->assertSessionHasNoErrors();
        $response->assertRedirectContains('/edit');
        $this->assertDatabaseHas(User::class, [
            'email' => $data['email'],
        ]);
        Storage::disk('public')->assertExists('user-avatar'.DIRECTORY_SEPARATOR.$data['avatar']->hashName());
    }

    public function test_admins_can_delete_user(): void
    {
        $response = $this->actingAs(self::$admin)->delete(route('admin.users.destroy', ['user' => self::$user]));

        $response->assertRedirectToRoute('admin.users.index');
        $this->assertDatabaseMissing(User::class, [
            'email' => self::$user->email,
        ]);
    }
}
