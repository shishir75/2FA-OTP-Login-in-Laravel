<?php

namespace Tests\Feature;

use App\Notifications\OTPNotification;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Notifications\Notification as NotificationsNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Validation\Rules\DatabaseRule;
use Tests\TestCase;

class ResendOTPTest extends TestCase
{
    use DatabaseMigrations;
    /**
    * A Test Method.
    * @test
    * @return void
    */
    public function a_user_can_request_for_new_otp()
    {
        $user = $this->loginUser();
        $this->get('/verifyOTP');
        $response = $this->post('/resend-otp', ['otp_via' => 'vai_email']);
        $response->assertRedirect('/verifyOTP');
    }

    /**
    * A Test Method.
    * @test
    * @return void
    */
    public function an_otp_is_sent_when_user_request_new_otp()
    {
        Notification::fake();
        $user = $this->loginUser();
        $response = $this->post('/resend-otp', ['otp_via' => 'vai_email']);
        Notification::assertSentTo([$user], OTPNotification::class);
    }
}
