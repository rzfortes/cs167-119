<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class changePasswordTest extends DuskTestCase
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

    public function test_user_can_login() 
    {
        $this->browse(function ($browser) {
            $browser->visit('/login')
                    ->type('email', 'rzfortes@up.edu.ph')
                    ->type('password', 'secret')
                    ->press('Login')
                    ->assertPathIs('/laravel_ToDo/public/home');
        });
    }

    public function test_user_can_change_password()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('changePassword')
                    ->assertPathIs('/laravel_ToDo/public/changePassword')
                    ->type('current-password', 'secret')
                    ->type('new-password', 'newPassword')
                    ->type('new-password_confirmation', 'newPassword')
                    ->Press('Change Password')
                    ->pause(1000)
                    ->assertSee('successfully');
        });
    }
}
