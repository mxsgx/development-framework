<?php

namespace Tests\Feature\View\Admin\Order;

use Tests\TestCase;

class EditTest extends TestCase
{
    /**
     * A basic view test example.
     */
    public function test_it_can_render(): void
    {
        $contents = $this->view('admin.order.edit', [
            //
        ]);

        $contents->assertSee('');
    }
}
