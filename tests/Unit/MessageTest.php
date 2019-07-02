<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Message;
use App\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Session;

class MessageTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_message_can_be_sent_by_authorized_user_only()
    {
        Session::start();
        $this->withoutExceptionHandling();
        
        $this->actingAs(factory(User::class)->create(
            [
                'id'=>2,
            ]
        ));
        $user = User::first();

        factory('App\Channel')->create(
            [
                'second_user' => 5
            ]
        );
        $channel = Channel::first();
        // factory('App\User')->create('2');
        // $user_one = User::first();
        // $user_two = User::last();

        $response = $this->post('/messages', [
            'sender' => $user->id,
            'receiver' => $channel->second_user,
            'message' => 'Test Message for Computing Projects Unit Test',
            'channel_id' => $channel->id,
            '_token' => csrf_token(),
        ]);

        $this->assertCount(1, Message::all());
    }
    
}
