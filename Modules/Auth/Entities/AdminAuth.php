<?php

namespace Modules\Auth\Entities;


use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Modules\Auth\MyTraits\HasPermissionTrait;

class AdminAuth extends Authenticatable
{
    use Notifiable;
    protected $table = 'admin_users';
    use HasPermissionTrait, HasApiTokens;

    protected $guard = 'admin';


    protected $fillable = [
        'name', 'email', 'password','is_super'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}

