<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
    public function after_login_user_can_not_access_home_page_until_verified()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $this->get('/home')->assertRedirect('/');
    }
}
