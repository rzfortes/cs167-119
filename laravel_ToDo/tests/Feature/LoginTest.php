<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_user_can_login()
    {
        $email     = 'test@laravel.com';
        $password  = 'secret';

        $user = [
            'email' => $email,
            'password' => $password
        ];

        $response = $this->post('/login', $user);

        $response->assertRedirect('/');
    }
}
