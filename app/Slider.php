<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Slider extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status', 'title', 'text', 'img', 'user_id', 'updated_user_id'
    ];

    public function scopeShown(Builder $builder)
    {
        return $builder->where('status', 'shown');
    }


    /**
     * Get the an author (admin) of the page.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the an author (admin) of the page.
     */
    public function userUpdated()
    {
        return $this->belongsTo(User::class, 'updated_user_id')->withDefault();
    }

}
