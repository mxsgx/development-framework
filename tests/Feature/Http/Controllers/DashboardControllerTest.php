<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\User;
use Tests\TestCase;

class DashboardControllerTest extends TestCase
{
    protected static ?User $admin = null;

    public function setUp(): void
    {
        parent::setUp();

        if (is_null(self::$admin)) {
            self::$admin = User::factory()->createOne();
        }
    }

    public function test_admins_can_visit_dashboard_page(): void
    {
        $response = $this->actingAs(self::$admin)->get(route('admin.dashboard'));

        $response->assertOk();
    }
}
