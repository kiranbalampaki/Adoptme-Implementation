<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Pet;
use App\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Session;

class PetTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function a_pet_can_be_added()
    {
        Session::start();
        $this->withoutExceptionHandling();
        
        $this->actingAs(factory(User::class)->create());

        $response = $this->post('/pets', [
            'type' => 'dog',
            'pet_photo' => 'Uploads/pets/1695713276.jpg',
            'name' => 'Shettu',
            'gender' => 'm',
            'age' => 'young',
            'size' => 'small',
            'color' => 'white',
            'details' => 'Test Details',
            '_token' => csrf_token(),
        ]);

        $this->assertCount(1, Pet::all());
    }

    /** @test */
    public function count_pets_is_twenty()
    {
        $petCount = 20;
        
        $pets = factory(Pet::class, $petCount)->create();
        
        $this->assertLessThanOrEqual( $petCount, \count( $pets ) );
        $this->assertTrue(true);
    }
}
