<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Laravel\Scout\Searchable;

class News extends Model
{
    use Searchable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status', 'type', 'title', 'url', 'text', 'user_id', 'updated_user_id'
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

    public function url()
    {
        return '/n/' . $this->id . '-' .  $this->url;
    }

    public function searchText($searchStr = '')
    {
        $length = 150;
        $str = mb_substr(strip_tags($this->text), 0 , $length);

        if (strlen($str) > $length) {
            return $str . '...';
        }

        return $str;
    }
}
