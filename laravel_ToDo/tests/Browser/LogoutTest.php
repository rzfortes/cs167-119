<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LogoutTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed');
    }
    
    /**
     * A Dusk test example.
     *
     * @return void
     */

    public function test_user_can_login() {
        $this->browse(function ($browser) {
            $browser->visit('/login')
                    ->type('email', 'rzfortes@up.edu.ph')
                    ->type('password', 'secret')
                    ->press('Login')
                    ->assertPathIs('/laravel_ToDo/public/home');
        });
    }

    public function test_user_can_logout()
    {
        $this->browse(function ($browser) {
            $browser->assertSee('Logout')
                ->clickLink('Logout')
                ->pause(1000)
                ->assertPathIs('/laravel_ToDo/public/');
        });
    }
}
