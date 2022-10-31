<?php

namespace App\Http\Controllers\Dashboard;

use App\Enums\CachedPages;
use App\Http\Controllers\Controller;
use App\Http\Filters\Post\{
    AuthorFilter,
    CategoryFilter,
    Sort,
    StatusFilter,
    IDFilter
};
use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\EditPostRequest;
use App\Http\Requests\PostFilterRequest;
use App\Models\Post;
use App\Facade\Blog;
use App\Models\Category;
use App\Repositories\PostRepository;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index(PostFilterRequest $request)
    {
        $posts  = Blog::index(CachedPages::DASHBOARD);

        return view('dashboard.home', compact('posts'));
    }

    public function create()
    {
        $categories = Category::all();


        return view('dashboard.post-create', compact('categories'));
    }
    public function store(CreatePostRequest $request)
    {
        try {
            Blog::storePost($request->validated());
            return redirect(route('dashboard.index'))->with('success', 'Post Created successfully');
        } catch (\Throwable $th) {

            report($th);
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    // public function update(Post $post, EditPostRequest $request)
    // {
    //     if (!Auth::user()->can('update', $post)) {
    //         abort(401, 'You are not allowed to edit this content');
    //     }

    //     Blog::editPost($post, $request->validated());

    // return redirect(route('dashboard.index'))->with('success', 'Post Edited successfully');
    //     
    // }


}
