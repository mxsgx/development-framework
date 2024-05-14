<?php

namespace App\Http\Controllers;

use App\Enums\CarStatus;
use App\Enums\OrderStatus;
use App\Models\Car;
use App\Models\Customer;
use App\Models\Order;
use Illuminate\Database\Eloquent\Builder;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        return view('admin.dashboard', [
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
    }
}
