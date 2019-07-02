<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PageTest extends TestCase
{
    /** @test */
    public function help_page_can_be_viewed()
    {
        $response = $this->get('/help');
        $response->assertStatus(200);
    }
}
