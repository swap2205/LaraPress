<?php

namespace Modules\Auth\Entities;

use Illuminate\Database\Eloquent\Model;

class AdminRole extends Model
{
    protected $fillable = ['name','slug'];
    protected $table = 'admin_roles';

    public function permissions(){
        return $this->belongsToMany(AdminPermission::class,'permissions_roles','role_id','permission_id');
    }

    public function users(){
        return $this->belongsToMany(AdminAuth::class,'admin_users_roles','role_id','user_id');
    }


    public static $form_fields = [
        ['name'=>'name','label'=>'Role Name','element'=>'input', 'type'=>'text'],
        ['name'=>'slug','label'=>'Slug','element'=>'input', 'type'=>'text'],
    ];

    public static $dataTable_columns = [
        'name'=>'Name',
        'slug'=>'Slug',
        'created_at'=>'Created Date',
    ];

    public static $dataSelect_columns = [
        'name'=>'Name',
        'slug'=>'Slug',
        'created_at'=>'Created Date',
    ];

    public static $dataTable_filters = [
        'name'=>['name'=>'name','label'=>'Role Name','element'=>'input', 'type'=>'text'],
        'slug'=>['name'=>'slug','label'=>'Slug','element'=>'input', 'type'=>'text'],
    ];

    public static $dataTable_action = [
        'view'=>'View',
        'edit'=>'Edit',
        'delete'=>'Delete',
        'add'=>'Add',
    ];
}
