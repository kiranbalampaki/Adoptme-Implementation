<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function only_users_can_access_userdashboard(){
        $response = $this->get('/user')->assertRedirect('/login');
    }

    public function authenticated_users_can_access_userdashboard(){
        $this->actingAs(factory(User::class)->create());
        $response = $this->get('/user')->assertOk();
    }
}
