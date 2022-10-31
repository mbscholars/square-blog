<?php

namespace App\Http\Filters\Post;

use App\Http\Filters\Filter;


class AuthorFilter extends Filter
{

    public function applyFilter($query)
    {
        return $query->where('user_id',  request('author'));
    }
}
