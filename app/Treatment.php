<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{
    public static $STATUS_NEW = 'new';

    protected $fillable = ['status', 'type', 'lastname', 'firstname', 'patronymic', 'gender', 'address', 'email',
        'post_address', 'phone', 'thematic', 'message', 'file_url'];
}
