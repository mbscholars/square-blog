<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class PostRepository
{

    public function storePost(array $data): Post
    {
        $post = Post::firstOrCreate(
            [
                'title' => $data['title'],

            ],
            array_merge(
                $data,
                ['user_id' => Auth::id()]
            )
        );

        if (isset($data['category_id'])) {
            Category::find($data['category_id'])
                ->posts()->attach($post);
            return $post;
        }


        if (isset($data['category'])) {
            Category::firstOrCreate(['name' => $data['category']])
                ->posts()->attach($post);
            return $post;
        }
    }


    // public function editPost(Post $post, array $data)
    // {
    //     return $post->update($data);
    // }

    // public function deletePost(Post $post)
    // {
    //     $post->delete();
    // }

    public function viewPost(string $slug)
    {
        $post = Cache::get($slug, null);

        if ($post != null) {
            return $post;
        }

        $post = Post::whereSlug($slug)->firstOrFail();

        Cache::put($slug, $post);

        return $post;
    }
}
