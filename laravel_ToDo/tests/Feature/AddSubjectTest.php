<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class AddSubjectTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_user_can_add_subject()
    {
        $user = factory(User::class)->make();
        $response = $this->actingAs($user)->get('/login');
        $response->assertRedirect('/home');

        $courseName = 'cmsc 167';

        $subject = [
            'courseName' => $courseName
        ];

        $response = $this->post('/home', $subject);

        // $this->assertDatabaseHas('subjects', [
        //     'courseName' => $courseName
        // ]);

        $response->assertSee('cmsc 167');
    }
}
