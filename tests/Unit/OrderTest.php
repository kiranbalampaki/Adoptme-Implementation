<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Order;
use App\User;
use App\Product;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Session;

class OrderTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function an_order_can_be_created_only_by_valid_users()
    {
        Session::start();
        $this->withoutExceptionHandling();
        
        $this->actingAs(factory(User::class)->create());
        factory('App\Product')->create();

        $response = $this->post('/orders', [
            'quantity' => 1,
            'total' => 2000,
            'payment_option' => 'Esewa',
            'product_id' => 1,
            'user_id' => 5,
            '_token' => csrf_token(),
        ]);

        $this->assertCount(1, Order::all());
    }

    /** @test */
    public function check_total_price_of_order()
    {
        factory(User::class)->create();
        $user = User::first();
        
        factory(Product::class)->create();
        $product = Product::first();

        factory(Order::class)->create(
            [
                'user_id' => $user->id,
                'product_id' => $product->id
            ]
        );

        $order =  Order::first();
        $this->assertInternalType("integer", $order->price);
        $this->assertTrue(true);
    }
}
