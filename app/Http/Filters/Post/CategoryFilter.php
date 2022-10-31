<?php

namespace App\Http\Filters\Post;

use App\Http\Filters\Filter;

class CategoryFilter extends Filter
{

    public function applyFilter($query)
    {
        return $query->whereHas('category', function ($query) {
            $query->where('id', request('category'));
        });
    }
}
