<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_user_can_register()
    {
        $name = 'Functional Testing';
        $email     = 'test@laravel.com';
        $password  = 'secret';

        $user = [
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'password_confirmation' => $password
        ];

        $response = $this->post('/register', $user);

        $this->assertDatabaseHas('users', [
            'name' => $name,
            'email'    => $email
        ]);

        $response->assertRedirect('/home');
    }
}
