<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class RegisterTest extends DuskTestCase
{
    use DatabaseMigrations;
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function test_user_can_register()
    {
        $this->browse(function ($browser) {
            $browser->visit('register')
                ->type('name', 'Functional Testing')
                ->type('email', 'test@laravel.com')
                ->type('password', 'passw0rd')
                ->type('password_confirmation', 'passw0rd')
                ->press('Register')
                ->pause(1000)
                ->assertPathIs('/laravel_ToDo/public/home');
        });
    }
}
