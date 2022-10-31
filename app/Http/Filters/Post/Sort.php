<?php


namespace App\Http\Filters\Post;

use App\Http\Filters\Filter;


class Sort extends Filter
{

    public function applyFilter($query)
    {
        $column = request('sort', 'id');
        $sortOrder = request('order', 'asc');
        return $query->orderBy($column, $sortOrder);
    }
}
