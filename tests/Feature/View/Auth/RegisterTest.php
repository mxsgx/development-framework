<?php

namespace Tests\Feature\View\Auth;

use Tests\TestCase;

class RegisterTest extends TestCase
{
    /**
     * A basic view test example.
     */
    public function test_it_can_render(): void
    {
        $contents = $this->withViewErrors([])->view('auth.register');

        $contents->assertSeeInOrder([
            'Full name',
            'Email address',
            'Password',
            'Confirm password',
            'Identity number',
            'Phone number',
            'Address',
            'Reset',
            'Register',
            'Login',
        ]);
    }
}
