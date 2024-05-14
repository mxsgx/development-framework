<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Brand;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class BrandControllerTest extends TestCase
{
    use WithFaker;

    protected static ?User $admin = null;

    protected static ?Brand $brand = null;

    public function setUp(): void
    {
        parent::setUp();

        if (is_null(self::$admin)) {
            self::$admin = User::factory()->createOne();
        }

        if (is_null(self::$brand)) {
            self::$brand = Brand::factory()->createOne();
        }
    }

    public function test_admins_can_visit_brands_page(): void
    {
        $response = $this->actingAs(self::$admin)->get(route('admin.brands.index'));

        $response->assertOk();
    }

    public function test_admins_can_visit_create_brand_page(): void
    {
        $response = $this->actingAs(self::$admin)->get(route('admin.brands.create'));

        $response->assertOk();
    }

    public function test_admins_can_create_brand(): void
    {
        Storage::fake('public');

        $data = [
            'name' => $this->faker->company(),
            'logo' => UploadedFile::fake()->create('logo.jpg'),
        ];
        $response = $this->actingAs(self::$admin)->post(route('admin.brands.store'), $data);

        $response->assertSessionHasNoErrors();
        $response->assertRedirectContains('/edit');
        $this->assertDatabaseHas(Brand::class, [
            'name' => $data['name'],
        ]);
        Storage::disk('public')->assertExists('brand-logo/'.$data['logo']->hashName());
    }

    public function test_admins_can_visit_edit_brand_page(): void
    {
        $response = $this->actingAs(self::$admin)->get(route('admin.brands.edit', ['brand' => self::$brand]));

        $response->assertOk();
    }

    public function test_admins_can_update_brand(): void
    {
        Storage::fake('public');

        $data = [
            'name' => $this->faker->company(),
            'logo' => UploadedFile::fake()->create('logo.jpg'),
        ];
        $response = $this->actingAs(self::$admin)->patch(route('admin.brands.update', ['brand' => self::$brand]), $data);

        $response->assertSessionHasNoErrors();
        $response->assertRedirectContains('/edit');
        $this->assertDatabaseHas(Brand::class, [
            'name' => $data['name'],
        ]);
        Storage::disk('public')->assertExists('brand-logo'.DIRECTORY_SEPARATOR.$data['logo']->hashName());

        self::$brand->refresh();
    }

    public function test_admins_can_delete_brand(): void
    {
        $response = $this->actingAs(self::$admin)->delete(route('admin.brands.destroy', ['brand' => self::$brand]));

        $response->assertRedirectToRoute('admin.brands.index');
        $this->assertDatabaseMissing(Brand::class, [
            'name' => self::$brand->name,
        ]);
    }
}
