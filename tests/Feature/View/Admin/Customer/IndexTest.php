<?php

namespace Tests\Feature\View\Admin\Customer;

use Tests\TestCase;

class IndexTest extends TestCase
{
    /**
     * A basic view test example.
     */
    public function test_it_can_render(): void
    {
        $contents = $this->view('admin.customer.index', [
            //
        ]);

        $contents->assertSee('');
    }
}
