<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TreatmentAnswer extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'treatment_id', 'text', 'user_id'
    ];
}
