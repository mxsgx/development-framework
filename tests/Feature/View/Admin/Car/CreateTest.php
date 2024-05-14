<?php

namespace Tests\Feature\View\Admin\Car;

use Tests\TestCase;

class CreateTest extends TestCase
{
    /**
     * A basic view test example.
     */
    public function test_it_can_render(): void
    {
        $contents = $this->view('admin.car.create', [
            //
        ]);

        $contents->assertSee('');
    }
}
