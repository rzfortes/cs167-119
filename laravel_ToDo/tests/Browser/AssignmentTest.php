<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AssignmentTest extends DuskTestCase
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
    public function testExample()
    {
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
                    ->click('#view1')
                    ->pause(1000)
                    ->assertPathIs('/laravel_ToDo/public/assignments/1')
                    ->assertSee('To do.')
                    ->type('content', 'code coverage')
                    ->press('Add')
                    ->assertPathIs('/laravel_ToDo/public/assignments/1')
                    ->pause(1000)
                    ->assertSee('code coverage')
                    ->press('Mark as done')
                    ->pause(1000)
                    ->press('Mark as not done');
        });
    }
}
