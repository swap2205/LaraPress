<?php

namespace Modules\CMS\Entities;

use Illuminate\Database\Eloquent\Model;

class PageType extends Model
{
    protected $fillable = ['slug','title'];

    // protected $table = 'page_types';

    public static $form_fields = [
        ['name'=>'title','label'=>'Title','element'=>'input', 'type'=>'text'],
        ['name'=>'slug','label'=>'Slug', 'type'=>'text','element'=>'input'],
    ];

    public static $dataTable_columns = [
        'title'=>'Title',
        'slug'=>'Slug',
        'created_at'=>'Created Date',
    ];

    public static $dataSelect_columns = [
        'title'=>'Title',
        'slug'=>'Slug',
        'created_at'=>'Created Date',
    ];

    public static $dataTable_filters = [
        // 'created_at'=>['name'=>'created_at','label'=>'Created Date','type'=>'text','element'=>'input'],
        'slug'=>['name'=>'slug','label'=>'Slug','type'=>'text','element'=>'input'],
        'title'=>['name'=>'title','label'=>'Title','type'=>'text','element'=>'input'],
    ];

    public static $dataTable_action = [
        'view'=>'View',
        'edit'=>'Edit',
        'delete'=>'Delete',
        'add'=>'Add',
    ];

    public function page(){
        return $this->hasMany(Page::class,'page_type','slug');
    }
}
