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
        $user = factory(User::class)->create();
        $res = $this->post('/login', ['email'=> $user->email, 'password'=> 'password']);
        Mail::assertSent(OTPMail::class);
    }

    /**
    * A Test Method.
    * @test
    * @return void
    */
    public function an_otp_email_is_not_sent_if_credentials_are_incorrect()
    {
        Mail::fake();
        $this->withExceptionHandling();
        $user = factory(User::class)->create();
        $res = $this->post('/login', ['email'=> $user->email, 'password'=> 'abc']);
        Mail::assertNotSent(OTPMail::class);
    }

    /**
    * A Test Method.
    * @test
    * @return void
    */
    public function otp_is_stored_in_cache_for_the_user()
    {
        $user = factory(User::class)->create();
        $res = $this->post('/login', ['email' => $user->email, 'password' => 'password']);
        $this->assertNotNull($user->OTP());
    }
}
