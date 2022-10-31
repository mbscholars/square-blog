<?php

namespace App\Http\Controllers;

use App\Enums\CachedPages;
use App\Facade\Blog;
use App\Models\Post;
use Illuminate\Http\Request;


class PostController extends Controller
{
    public function index()
    {
        $posts = Blog::index(CachedPages::BLOG);

        return view('website.home', compact('posts'));
    }

    public function show(string $slug)
    {
        $post = Blog::viewPost($slug);

        return view('website.post-single', compact('post'));
    }
}
