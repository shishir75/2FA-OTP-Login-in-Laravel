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
        $this->loginUser();
        $OTP = auth()->user()->cacheTheOTP();
        $this->post('/verifyOTP', ["OTP" => $OTP])->assertStatus(302);
        $this->assertDatabaseHas('users', ['isVerified' => 1]);
    }

    /**
    * A Test Method.
    * @test
    * @return void
    */
    public function user_can_see_verification_page()
    {
        $this->loginUser();
        $this->get('/verifyOTP')->assertStatus(200)->assertSee('Enter OTP');
    }

    /**
    * A Test Method.
    * @test
    * @return void
    */
    public function invalid_otp_returns_error_message()
    {
        $this->loginUser();
        $this->post('/verifyOTP', ["OTP" => 'InvalidOTP'])->assertSessionHasErrors();
    }

    /**
    * A Test Method.
    * @test
    * @return void
    */
    public function if_no_otp_is_given_then_it_return_with_error()
    {
        $this->withExceptionHandling();
        $this->loginUser();
        $this->post('/verifyOTP', ["OTP" => null])->assertSessionHasErrors('OTP');
    }
}
