<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Customer;
use App\Models\User;
use Tests\TestCase;

class OrderControllerTest extends TestCase
{
    protected static ?User $admin = null;

    protected static ?Customer $customer = null;

    protected static ?User $user = null;

    public function setUp(): void
    {
        parent::setUp();

        if (is_null(self::$admin)) {
            self::$admin = User::factory()->createOne();
        }

        if (is_null(self::$user)) {
            self::$user = User::factory()->customer()->has(Customer::factory())->createOne();
        }

        if (is_null(self::$customer)) {
            self::$customer = Customer::factory()->createOne();
        }
    }

    public function test_admins_can_visit_orders_page(): void
    {
        $response = $this->actingAs(self::$admin)->get(route('admin.orders.index'));

        $response->assertOk();
    }
}
