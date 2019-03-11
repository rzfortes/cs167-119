<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\User;

class ToDoTest extends DuskTestCase
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
                    ->assertPathIs('/laravel_ToDo/public/home')
                    ->assertSee('My Courses.')
                    ->type('courseName', 'cmsc 167')
                    ->press('Add')
                    ->assertPathIs('/laravel_ToDo/public/home')
                    ->pause(1000)
                    ->assertSee('cmsc 167')
                    ->assertSee('cmsc 167')
                    ->press('Delete')
                    ->pause(1000)
                    ->assertPathIs('/laravel_ToDo/public/home')
                    ->pause(1000)
                    ->assertDontSee('cmsc 167')
                    ->type('courseName', 'cmsc 198.2')
                    ->press('Add')
                    ->pause(1000)
                    ->assertSee('cmsc 198.2')
                    ->click('#view2')
                    ->assertPathIs('/laravel_ToDo/public/assignments/2');
        });
    }

    // public function test_user_can_add_subject()
    // {
    //     $this->browse(function ($browser) {
    //         $browser->assertSee('My Courses.')
    //             ->type('courseName', 'cmsc 167')
    //             ->press('Add')
    //             ->assertPathIs('/laravel_ToDo/public/home')
    //             ->pause(1000)
    //             ->assertSee('cmsc 167');
    //     });
    // }

    // public function test_user_can_delete_subject()
    // {
    //     $this->browse(function ($browser) {
    //         $browser->assertSee('cmsc 167')
    //             ->press('Delete')
    //             ->pause(1000)
    //             // ->assertPathIs('/laravel_ToDo/public/home')
    //             ->pause(1000)
    //             ->assertDontSee('cmsc 167');
    //     });
    // }
}