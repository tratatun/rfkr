<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GovResource extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'url', 'user_id', 'updated_user_id'
    ];


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