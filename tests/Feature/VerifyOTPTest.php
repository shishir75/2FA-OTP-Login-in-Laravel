<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class VerifyOTPTest extends TestCase
{
    use DatabaseMigrations;
    /**
    * A Test Method.
    * @test
    * @return void
    */
    public function user_can_submit_otp_and_get_verified()
    {
        $this->withoutExceptionHandling();
        $otp = rand(100000, 999999);
        Cache::put('OTP', $otp, now()->addSeconds(20));
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $this->post('/verifyOTP', ['OTP' => $otp])->assertStatus(201);
        $this->assertDatabaseHas('users', ['isVerified' => 1]);
    }
}
