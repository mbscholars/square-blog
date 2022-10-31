<?php

namespace App\Http\Filters;

use Closure;
use Illuminate\Support\Str;

abstract class Filter
{

    public function handle($request, Closure $next)
    {
        if (!request()->has(str_replace('_filter', '', $this->filterColumnName()))) {
            return $next($request);
        }

        $query = $next($request);
        return $this->applyFilter($query);
    }



    protected function filterColumnName()
    {
        return Str::snake(class_basename($this));
    }

    protected abstract function applyFilter($query);
}
