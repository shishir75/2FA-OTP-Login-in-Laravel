<?php

namespace Tests\Unit;

use App\Notifications\OTPNotification;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Notification;

class UserTest extends TestCase
{
    use DatabaseMigrations;
    /**
    * A Test Method.
    * @test
    * @return void
    */
    public function it_has_cache_key_for_otp()
    {
        $user = factory(User::class)->create();
        $this->assertEquals($user->OTPKey(), 'OTP_for_1');
    }

    /**
    * A Test Method.
    * @test
    * @return void
    */
    public function it_can_send_an_OTP_notification_to_user()
    {
        $user = factory(User::class)->create();
        Notification::fake();
        $user->sendOTP('via_sms');
        Notification::assertSentTo([$user], OTPNotification::class);
    }
}
