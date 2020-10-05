<?php

namespace Modules\Auth\Entities;

use Illuminate\Database\Eloquent\Model;

class AdminPermission extends Model
{
    protected $fillable = ['name','slug'];

    protected $table = 'admin_permissions';

    public function roles(){
        return $this->belongsToMany(AdminRole::class,'permissions_roles','permission_id','role_id');
    }

    public function users(){
        return $this->belongsToMany(AdminAuth::class,'admin_users_permissions','user_id','permission_id');
    }

    public static $form_fields = [
        ['name'=>'name','label'=>'Permission Name','element'=>'input', 'type'=>'text'],
        ['name'=>'slug','label'=>'Slug','element'=>'input', 'type'=>'text'],
    ];

    public static $dataTable_columns = [
        'name'=>'Permission Name',
        'slug'=>'Slug',
        'created_at'=>'Created Date',
    ];

    public static $dataSelect_columns = [
        'name'=>'Permission Name',
        'slug'=>'Slug',
        'created_at'=>'Created Date',
    ];

    public static $dataTable_filters = [
        'name'=>['name'=>'name','label'=>'Permission Name','element'=>'input', 'type'=>'text'],
        'slug'=>['name'=>'slug','label'=>'Slug','element'=>'input', 'type'=>'text'],
    ];

    public static $dataTable_action = [
        'view'=>'View',
        'edit'=>'Edit',
        'delete'=>'Delete',
        'add'=>'Add',
    ];
}
