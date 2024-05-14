<?php

namespace App\Http\Controllers;

use App\Enums\AttachmentType;
use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use App\Models\Brand;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.brand.index', [
            'brands' => Brand::withCount('cars')->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBrandRequest $request)
    {
        $brand = Brand::create($request->except(['logo']));

        if ($request->hasFile('logo') && $request->file('logo')->isValid()) {
            $path = $request->file('logo')->store('brand-logo', 'public');

            $brand->logo()->create([
                'content' => $path,
                'type' => AttachmentType::Image,
            ]);
        }

        return redirect()->route('admin.brands.edit', ['brand' => $brand]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        return view('admin.brand.edit', ['brand' => $brand]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBrandRequest $request, Brand $brand)
    {
        $brand->update($request->except(['logo']));

        if ($request->hasFile('logo') && $request->file('logo')->isValid()) {
            $oldPath = $brand->logo ? $brand->logo->content : null;
            $path = $request->file('logo')->store('brand-logo', 'public');

            $brand->logo()->create([
                'content' => $path,
                'type' => AttachmentType::Image,
            ]);

            if ($oldPath && Storage::disk('public')->fileExists($oldPath)) {
                $brand->logo->delete();

                Storage::disk('public')->delete($oldPath);
            }
        }

        return redirect()->route('admin.brands.edit', ['brand' => $brand]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        $logoPath = $brand->logo ? $brand->logo->content : null;

        $brand->delete();

        if ($logoPath && Storage::disk('public')->fileExists($logoPath)) {
            $brand->logo->delete();

            Storage::disk('public')->delete($logoPath);
        }

        return redirect()->route('admin.brands.index');
    }
}
