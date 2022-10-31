<?php

namespace App\View\Components;

use App\Models\Post;
use Illuminate\View\Component;

class BlogPostViewComponent extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(public Post $post)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.blog-post-view-component');
    }
}
