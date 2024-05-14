<?php

namespace App\Http\Controllers;

use App\Enums\CarStatus;
use App\Models\Car;

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

    public function createOrder()
    {
        //
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
