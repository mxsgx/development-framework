<?php

namespace App\Http\Controllers;

use App\Enums\CarStatus;
use App\Enums\OrderPaymentMethod;
use App\Enums\OrderStatus;
use App\Models\Car;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class RentController extends Controller
{
    public function home()
    {
        return view('welcome', [
            'cars' => Car::whereStatus(CarStatus::Available)->paginate(6),
        ]);
    }

    public function detail(Car $car)
    {
        return view('rent.detail', [
            'car' => $car,
        ]);
    }

    public function search()
    {
        //
    }

    public function createOrder(Request $request, Car $car)
    {
        $request->validate([
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date'],
            'with_driver' => ['nullable', 'boolean'],
        ]);

        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);
        $rentDuration = $startDate->diffInDays($endDate);

        Order::create([
            'car_id' => $car->id,
            'status' => OrderStatus::Unpaid,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'with_driver' => $request->boolean('with_driver'),
            'payment_method' => OrderPaymentMethod::Cash,
            'customer_id' => $request->user()->customer->id,
            'total_price' => $car->base_price * (max($rentDuration, 1))
        ]);

        $car->markAsUnavailable();

        return redirect()->route('rent.checkout', compact('car'));
    }

    public function checkout(Car $car)
    {
        return view('rent.checkout', [
            'car' => $car,
        ]);
    }

    public function makeOrder()
    {
        //
    }

    public function createPaymentOrder()
    {
        //
    }
}
