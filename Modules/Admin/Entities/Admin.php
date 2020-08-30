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

    public static $form_fields = [
        ['name'=>'name','label'=>'Name','element'=>'input', 'type'=>'text'],
        ['name'=>'email','label'=>'Email','element'=>'input', 'type'=>'email'],
        ['name'=>'password','label'=>'Password','element'=>'input', 'type'=>'password'],
        ['name'=>'is_super','label'=>'Make Super Admin','element'=>'select', 'values'=>['0'=>'No', '1' => 'Yes']],
    ];

    public static $dataTable_columns = [
        'name'=>'Name',
        'email'=>'Email',
        'created_at'=>'Created Date',
    ];

    public static $dataSelect_columns = [
        'name'=>'Name',
        'email'=>'Email',
        'created_at'=>'Created Date',
    ];

    public static $dataTable_filters = [
        'name'=>['name'=>'name','label'=>'Name','element'=>'input', 'type'=>'text'],
        'email'=>['name'=>'email','label'=>'Email','element'=>'input', 'type'=>'email'],
        'is_super'=>['name'=>'is_super','label'=>'Admin Type','element'=>'select', 'values'=>['0'=>'Normal Admin', '1' => 'Super Admin']],
    ];

    public static $dataTable_action = [
        'view'=>'View',
        'edit'=>'Edit',
        'delete'=>'Delete',
        'add'=>'Add',
    ];
    
}
