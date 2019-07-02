<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\User;
use App\Pet;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RelationTest extends TestCase
{
    /** @test */
    public function a_user_has_many_pets()
    {
        $user = factory('App\User')->create();
        $this->assertInstanceOf(Collection::class, $user->pets);
    }
}
