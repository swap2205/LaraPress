<?php

namespace Modules\Auth\Entities;

use Illuminate\Database\Eloquent\Model;

class AdminRole extends Model
{
    protected $fillable = [];
    protected $table = 'admin_roles';

    public function permissions(){
        return $this->belongsToMany(AdminPermission::class,'permissions_roles','role_id','permission_id');
    }

    public function users(){
        return $this->belongsToMany(AdminAuth::class,'admin_users_roles','role_id','user_id');
    }
}
