<?php

namespace Modules\CMS\Entities;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [
        'title',
        'meta_keywords',
        'meta_description',
        'slug',
        'page_type',
        'content',
        'template_name',
        'featured_image',
        'status',
        'parent_id',
        'created_by',
        'updated_by'
    ];

    public static $form_fields = [
        ['name'=>'title','label'=>'Title','element'=>'input', 'type'=>'text'],
        ['name'=>'meta_keywords','label'=>'Meta Keywords', 'element'=>'input', 'type'=>'text'],
        ['name'=>'meta_description','label'=>'Meta Description' ,'element'=>'input', 'type'=>'text'],
        ['name'=>'slug','label'=>'Slug', 'type'=>'text','element'=>'input'],
        'page_type'=>['name'=>'page_type','label'=>'Page Type','type'=>'hidden','element'=>'input'],
        ['name'=>'content','label'=>'Content', 'element'=>'textarea'],
        'template_name'=>['name'=>'template_name','label'=>'Template Name','element'=>'select', 'values'=>['layout'=>'Default', 'sidebar'=>'Sidebar', 'sidebar_right'=>'Sidebar Right']],
        ['name'=>'featured_image','label'=>'Featured Image', 'type'=>'file','element'=>'input'],
        ['name'=>'status','label'=>'Status', 'element'=>'select','values'=>['Disable','Active']],
        'parent_id'=>['name'=>'parent_id','label'=>'Parent' ,'element'=>'select','values'=>['0'=>'None']],
    ];

    public static $dataTable_columns = [
        'title'=>'Title',
        'slug'=>'Slug',
        'pageType->title'=>'Page Type',
        'created_at'=>'Created Date',
    ];

    public static $dataSelect_columns = [
        'title'=>'Title',
        'slug'=>'Slug',
        'page_type'=>'Page Type',
        'created_at'=>'Created Date',
    ];

    public static $dataTable_filters = [
        'page_type'=>['name'=>'page_type','label'=>'Page Type','type'=>'hidden','element'=>'input'],
        'created_at'=>['name'=>'created_at','label'=>'Created Date','type'=>'text','element'=>'input'],
        'slug'=>['name'=>'slug','label'=>'Slug','type'=>'text','element'=>'input'],
        'title'=>['name'=>'title','label'=>'Title','type'=>'text','element'=>'input'],
    ];


    public static $dataTable_action = [
        'view'=>'View',
        'edit'=>'Edit',
        'delete'=>'Delete',
        'add'=>'Add',
    ];

    // protected $with = ['pageType'];

    public function pageType(){
        return $this->hasOne(PageType::class,'slug','page_type');
    }
}







