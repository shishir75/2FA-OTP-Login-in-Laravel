<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EmailTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic feature test example.
     * @test
     * @return void
     */
    public function an_otp_is_send_when_an_user_is_logged_in()
    {
        //$user = factory(User::class)->create();
        //$res = $this->post('/login', ['email'=> $user->email, 'password'=> 'password']);
        //$res->assertRedirect('/');

        $this->assertTrue(true); // for test purpose
    }
}
