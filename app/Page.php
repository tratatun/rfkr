<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\User;
use Laravelrus\LocalizedCarbon\Traits\LocalizedEloquentTrait;

class Page extends Model
{
    use LocalizedEloquentTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type', 'title', 'url', 'text', 'user_id', 'page_id'
    ];

    public function scopeSections(Builder $builder)
    {
        return $builder->whereNull('page_id');
    }

    /**
     * Get the sub pages for the page.
     */
    public function subPages()
    {
        return $this->hasMany(self::class);
    }

    /**
     * Get the an author (admin) of the page.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Add a page of a section (a sub page)
     *
     * @param $data
     * @return Model
     */
    public function addSubPage($data)
    {
        return $this->subPages()->create($data);
    }
}
