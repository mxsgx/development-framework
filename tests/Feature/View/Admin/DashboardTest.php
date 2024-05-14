<?php

namespace Tests\Feature\View\Admin;

use App\Enums\CarStatus;
use App\Enums\OrderStatus;
use App\Models\Car;
use App\Models\Customer;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    /**
     * A basic view test example.
     */
    public function test_it_can_render(): void
    {
        $contents = $this->actingAs(User::factory()->createOne())->view('admin.dashboard', [
            'totalTransaction' => Order::count(),
            'totalTransactionPendingPayment' => Order::whereStatus(OrderStatus::Unpaid)->count(),
            'totalCar' => Car::count(),
            'totalCarOnRent' => Car::whereStatus(CarStatus::Unavailable)->whereHas('orders', function (Builder $query) {
                $query->where(['status' => OrderStatus::Active->value])->latest();
            })->count(),
            'totalCustomer' => Customer::count(),
            'totalCustomerRegisteredAsUser' => Customer::whereNotNull('user_id')->count(),
            'totalOrderOnRefunding' => Order::whereStatus(OrderStatus::Refunding)->count(),
            'totalOrderRefunded' => Order::whereNotNull('refunded_at')->count(),
        ]);

        $contents->assertSeeInOrder(['Transactions', 'Cars', 'Customers', 'Orders Need Refund']);
    }
}
