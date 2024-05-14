<?php

namespace Tests\Feature\View\Rent;

use Tests\TestCase;

class DetailTest extends TestCase
{
    /**
     * A basic view test example.
     */
    public function test_it_can_render(): void
    {
        $contents = $this->view('rent.detail', [
            //
        ]);

        $contents->assertSee('');
    }
}
