<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use App\Mail\OTPMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

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
        Mail::fake();

        $this->withoutExceptionHandling();
        
        $user = factory(User::class)->create();
        $res = $this->post('/login', ['email'=> $user->email, 'password'=> 'password']);

        Mail::assertSent(OTPMail::class);
    }
}
