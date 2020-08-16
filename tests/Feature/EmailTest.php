<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use App\Mail\OTPMail;
use App\Notifications\OTPNotification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Notification;

class EmailTest extends TestCase
{
    use DatabaseMigrations;

    public $user;

    public function setUp() : void
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
    }
    /**
     * A basic feature test example.
     * @test
     * @return void
     */
    public function an_otp_is_send_when_an_user_is_logged_in()
    {
        Notification::fake();
        $res = $this->post('/login', ['email'=> $this->user->email, 'password'=> 'password', 'otp_via' => 'via_email']);
        Notification::assertSentTo([$this->user], OTPNotification::class);
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
        $res = $this->post('/login', ['email'=> $this->user->email, 'password'=> 'abc']);
        Mail::assertNotSent(OTPMail::class);
    }

    /**
    * A Test Method.
    * @test
    * @return void
    */
    public function otp_is_stored_in_cache_for_the_user()
    {
        $res = $this->post('/login', ['email' => $this->user->email, 'password' => 'password']);
        $this->assertNotNull($this->user->OTP());
    }
}
