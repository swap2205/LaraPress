<?php

namespace Modules\Auth\Entities;

use Illuminate\Database\Eloquent\Model;

class AdminPermission extends Model
{
    protected $fillable = [];

    protected $table = 'admin_permissions';

    public function roles(){
        return $this->belongsToMany(AdminRole::class,'permissions_roles','permission_id','role_id');
    }

    public function users(){
        return $this->belongsToMany(AdminAuth::class,'admin_users_permissions','user_id','permission_id');
    }
}
