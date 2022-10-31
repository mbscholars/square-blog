<?php

namespace App\Models;

use App\Events\CreatePostEvent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $guarded = ['user_id', 'slug'];

    protected $fillable = ['title', 'description',  'excerpt', 'status', 'created_at'];

    protected $dispatchesEvents = [
        'created' => CreatePostEvent::class
    ];

    public function category()
    {
        return $this->belongsToMany(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
