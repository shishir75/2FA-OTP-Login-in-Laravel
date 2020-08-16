<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
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
        $response = $this->post('/resent-otp', ['otp_via' => 'vai_email']);
        $response->assertStatus(201);
    }
}
