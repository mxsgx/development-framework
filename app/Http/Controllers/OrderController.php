<?php

namespace App\Http\Controllers;

use App\Enums\CarStatus;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Car;
use App\Models\Order;
use Illuminate\Validation\ValidationException;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        $car = Car::find($request->input('car_id'));

        if (! $car) {
            throw ValidationException::withMessages([
                'car_id' => ['Car not found'],
            ]);
        }

        if ($car->status === CarStatus::Unavailable) {
            throw ValidationException::withMessages([
                'car_id' => ['Car is unavailable'],
            ]);
        }

        $order = Order::create($request->validated());
        $rentDuration = $order->end_date->diffInDays($order->start_date);

        $order->increment('total_price', $order->car->base_price * ($rentDuration < 1 ? 1 : $rentDuration));

        if ($order->with_driver) {
            $order->increment('total_price', $order->car->driver_price * ($rentDuration < 1 ? 1 : $rentDuration));
        }

        $car->markAsUnavailable();

        return redirect()->route('admin.orders.edit', ['order' => $order]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
