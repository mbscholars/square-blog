<?php


namespace App\Http\Filters\Post;

use App\Http\Filters\Filter;
use Illuminate\Support\Facades\Auth;

class StatusFilter extends Filter
{

    public function applyFilter($query)
    {
        return (Auth::check()) ?  $query->where('status', request('status')) : $query;
    }
}
