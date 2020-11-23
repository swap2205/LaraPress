<?php

namespace Modules\Settings\Entities;

use Illuminate\Database\Eloquent\Model;

class AdminNavigation extends Model
{
    protected $fillable = ['title','uri','icon_class','status','parent_id','nav_order','roles_allowed'];
}
