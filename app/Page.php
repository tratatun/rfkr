<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Page extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type', 'title', 'url', 'text', 'user_id'
    ];

    public function scopeSections(Builder $builder)
    {
        return $builder->whereNull('parent_id');
    }
}
