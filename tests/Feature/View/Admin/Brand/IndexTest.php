<?php

namespace Tests\Feature\View\Admin\Brand;

use App\Models\Brand;
use App\Models\User;
use Tests\TestCase;

class IndexTest extends TestCase
{
    /**
     * A basic view test example.
     */
    public function test_it_can_render(): void
    {
        $contents = $this->actingAs(User::factory()->createOne())->withViewErrors([])->view('admin.brand.index', [
            'brands' => Brand::withCount('cars')->paginate(10),
        ]);

        $contents->assertSeeInOrder(['Create a brand', 'Brand name', 'Logo', 'Create']);
    }
}
