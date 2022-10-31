<?php

namespace App\Listeners;

use Illuminate\Support\Str;
use App\Events\CreatePostEvent;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreatePostListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(CreatePostEvent $event)
    {
        $post = $event->post;
        $post->slug  =  Str::slug($post->title);
        $post->user_id = $post->user_id != null ? $post->user_id : User::systemAdmin()->id;
        $post->excerpt = substr($post->description, 0, 255);
        $post->save();
    }
}
