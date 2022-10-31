<?php

namespace App\Http\Filters\Post;

use App\Http\Filters\Filter;


class IDFilter extends Filter
{

    public function applyFilter($query)
    {
        return $query->where('id', request('id'));
    }
}
