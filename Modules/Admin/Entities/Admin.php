<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'admin_users';

    protected $fillable = [
        'name', 'email', 'password','is_super'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
