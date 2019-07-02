<?php

namespace Tests\Unit;
use App\Blog;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Session;

class BlogTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;
    /** @test */
    public function a_blog_can_be_added()
    {
        Session::start();
        $this->withoutExceptionHandling();
        
        $this->actingAs(factory(User::class)->create());

        $response = $this->post('/blogs', [
            'title' => 'Test Title',
            'body' => 'Test Body',
            'blog_image' => 'Uploads/blogimages/938451194.jpg',
            '_token' => csrf_token(),
        ]);

        $this->assertCount(1, Blog::all());
    }

    /** @test */
    public function a_blog_can_be_updated()
    {
        $data['title'] = 'New title for test';

        factory(Blog::class)->create();
        $blog = Blog::first();

        $blog->update($data);

        $this->assertInstanceOf(Blog::class, $blog);
        $this->assertEquals($data['title'], $blog->title);
        $this->assertTrue(true);
    }
}
