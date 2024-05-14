<?php

namespace Tests\Feature\View\Auth;

use Tests\TestCase;

class LoginTest extends TestCase
{
    /**
     * A basic view test example.
     */
    public function test_it_can_render(): void
    {
        $contents = $this->withViewErrors([])->view('auth.login');

        $contents->assertSeeInOrder([
            'Email address',
            'Password',
            'Remember me on this device',
            'Login',
            'Register',
        ]);
    }
}
