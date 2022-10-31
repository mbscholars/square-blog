<?php

namespace App\View\Components;

use App\Models\Post;
use Illuminate\View\Component;

class PostCardItemComponent extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */


    public function __construct(public Post $post)
    {
        $this->post = $post;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.post-card-item-component');
    }
}
