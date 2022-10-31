<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use App\Enums\PostStatus;
use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DashboardTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_dashboard_is_unaccessible_for_non_users()
    {
        $response = $this->get(route('dashboard.index'));

        $response->assertStatus(302);
    }

    public function test_it_can_accept_logged_in_users()
    {
        $this->actingAs(User::first());
        $response = $this->get(route('dashboard.index'));
        $response->assertStatus(200);
    }

    public function test_dashboard_works()
    {
        $this->actingAs(User::first());
        $response = $this->get(route('dashboard.index'));
        $response->assertSee('Posts');
    }
    public function test_user_can_create_post_and_post_is_in_right_category()
    {
        $data = [
            'title' => 'This is a post',
            'description' => 'This is a paragraph and a content',
            'category' => 'Automobiles',
            'status' => PostStatus::PUBLISHED
        ];

        $this->actingAs($user = User::first());
        $response = $this->post(route('dashboard.store'), $data);

        $this->assertDatabaseCount('posts', 1);

        $this->assertDatabaseHas('posts', [
            'user_id' => $user->id,
            'title' => $data['title'],
            'slug' => Str::slug($data['title']),
            'description' => $data['description']
        ]);

        $this->assertDatabaseHas('category_post', [
            'post_id' => Post::latest()->first()->id,
            'category_id' => Category::whereName($data['category'])->first()->id
        ]);
    }



    public function test_validation_works_on_post_creation()
    {
        $data = [
            'title' => 'This is a post'
        ];

        $this->actingAs($user = User::first());
        $response = $this->post(route('dashboard.store'), $data, ['accept' => 'application/json']);

        $response->assertStatus(422);

        $data = [
            'title' => 'This is a post',

            'status' => PostStatus::PUBLISHED
        ];



        $response2 = $this->post(route('dashboard.store'), $data, ['accept' => 'application/json']);
        $response2->assertStatus(422);

        $data = [
            'title' => 'This is a post',
            'description' => 'This is a paragraph and a content',

        ];


        $response3 = $this->post(route('dashboard.store'), $data, ['accept' => 'application/json']);
        $response3->assertStatus(422);
        $data = [
            'title' => 'This is a post',
            'description' => 'This is a paragraph and a content',
            'category' => Category::first()->id,

        ];

        $response4 = $this->post(route('dashboard.store'), $data, ['accept' => 'application/json']);
        $response4->assertStatus(422);
    }
}
