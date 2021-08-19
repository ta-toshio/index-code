<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;

trait Scope
{

    /**
     * @param  Builder  $query
     * @param  array  $args
     * @return Builder
     */
    public function scopeSort(Builder $query, array $args)
    {
        return $query->orderBy('id', 'DESC');
    }

}
