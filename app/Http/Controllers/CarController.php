<?php

namespace App\Http\Controllers;

use App\Enums\AttachmentType;
use App\Http\Requests\StoreCarRequest;
use App\Http\Requests\UpdateCarRequest;
use App\Models\Brand;
use App\Models\Car;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.car.index', [
            'cars' => Car::paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.car.create', [
            'brands' => Brand::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCarRequest $request)
    {
        $car = Car::create($request->except('previews'));

        if ($request->hasFile('previews')) {
            foreach ($request->file('previews') as $file) {
                $path = $file->store('car-preview', 'public');

                $car->imagePreviews()->create([
                    'content' => $path,
                    'type' => AttachmentType::Image,
                ]);
            }
        }

        return redirect()->route('admin.cars.edit', ['car' => $car]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Car $car)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car $car)
    {
        return view('admin.car.edit', [
            'car' => $car,
            'brands' => Brand::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCarRequest $request, Car $car)
    {
        $car->update($request->except('previews'));

        if (! $request->input('with_driver')) {
            $car->update(['with_driver' => false]);
        }

        if ($request->hasFile('previews')) {
            $oldPath = $car->imagePreviews->count() > 0 ? $car->imagePreviews->first()->content : null;

            foreach ($request->file('previews') as $file) {
                $path = $file->store('car-preview', 'public');

                $car->imagePreviews()->create([
                    'content' => $path,
                    'type' => AttachmentType::Image,
                ]);
            }

            if ($oldPath && Storage::disk('public')->fileExists($oldPath)) {
                $car->imagePreviews->first()->delete();

                Storage::disk('public')->delete($oldPath);
            }
        }

        return redirect()->route('admin.cars.edit', ['car' => $car]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        $imagePath = $car->imagePreviews ? $car->imagePreviews->first->content : null;

        $car->delete();

        if ($imagePath && Storage::disk('public')->fileExists($imagePath)) {
            $car->imagePreviews->first()->delete();

            Storage::disk('public')->delete($imagePath);
        }

        return redirect()->route('admin.cars.index');
    }
}
