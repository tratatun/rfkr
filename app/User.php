<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    const STATUS_ACTIVE = 'active';
    const STATUS_BLOCKED = 'blocked';

    const ROLE_SUPER_ADMIN = 'superadmin';
    const ROLE_AUTHOR = 'author';
    const ROLE_SUPPORT = 'support';

    public static $roles = [
      self::ROLE_SUPER_ADMIN,
      self::ROLE_AUTHOR,
      self::ROLE_SUPPORT,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role', 'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getFirstName()
    {
        return explode(' ', $this->name)[0];
    }

    public function getLastName()
    {
        return explode(' ', $this->name)[1];
    }

    public function isActive()
    {
        return $this->status === 'active';
    }

    public function isSuperAdmin()
    {
        return $this->role === self::ROLE_SUPER_ADMIN;
    }

    public function isSupport()
    {
        return $this->role === self::ROLE_SUPPORT;
    }

    public function isAuthor()
    {
        return $this->role === self::ROLE_AUTHOR;
    }


}
