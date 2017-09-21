<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\User;

class Page extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status', 'type', 'title', 'url', 'text', 'user_id', 'updated_user_id', 'page_id'
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    public function scopeSections(Builder $builder)
    {
        return $builder->whereNull('page_id');
    }

    public function scopeShown(Builder $builder)
    {
        return $builder->where('status', 'shown');
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
     * Get the an author (admin) of the page.
     */
    public function userUpdated()
    {
        return $this->belongsTo(User::class, 'updated_user_id')->withDefault();
    }

    /**
     * Add a page of a section (a sub page)
     *
     * @param $data
     * @return Model
     */
    public function createSubPage($data)
    {
        return $this->subPages()->create($data);
    }

    public function url()
    {
        return '/p/' . $this->id . '-' .  $this->url;
    }

    public function searchText($searchStr = '')
    {
        return substr(strip_tags($this->text), 0 , 150);
    }
}
