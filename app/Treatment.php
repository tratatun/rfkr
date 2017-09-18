<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{
    public static $STATUS_OPENED = 'opened';
    public static $STATUS_CLOSED = 'closed';

    protected $fillable = ['status', 'type', 'lastname', 'firstname', 'patronymic', 'gender', 'address', 'email',
        'post_address', 'phone', 'thematic', 'message', 'file_url'];

    public function scopeNewOnes(Builder $builder)
    {
        return $builder->where('status', self::$STATUS_OPENED);
    }

    public function scopeOldOnes(Builder $builder)
    {
        return $builder->where('status', self::$STATUS_CLOSED);
    }
}
