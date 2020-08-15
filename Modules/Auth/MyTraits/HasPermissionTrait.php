<?php
/*
* We will use this trait to get & set the admin user permissions & roles details
*/
namespace Modules\Auth\MyTraits;

use Modules\Auth\Entities\AdminPermission;
use Modules\Auth\Entities\AdminRole;

trait HasPermissionTrait{

    //define admin_user relationship with roles
    public function roles(){
        return $this->belongsToMany(AdminRole::class, 'admin_users_roles','user_id','role_id');
    }


    //define admin_user relationship with permissions
    public function permissions(){
        return $this->belongsToMany(AdminPermission::class,'admin_users_permissions','user_id','permission_id');
    }

    //function to add permissions to the user
    public function givePermissionsTo(... $persmissions){
        //get all permissions available
        $persmissions = $this->getAllPermissions(... $persmissions);
        dd($persmissions);

        if($persmissions===null){
            return $this;
        }

        //save all permissions to the users
        $this->permissions()->saveMany($persmissions);
    }

    //function to remove permissions from a user
    public function withdrawPermissionsTo(... $persmissions){
        $this->permissions()->detach($this->getAllPermissions($persmissions));
        return $this;
    }

    public function refreshPermissions(... $persmissions){
        // remove all the permissions first
        $this->permissions()->detach();
        //then add the permissions
        return $this->givePermissionsTo($persmissions);
    }

    public function hasPermissionTo($persmission){
        return $this->hasPermissionThroughRole($persmission) || $this->hasPermission($persmission);
    }

    //method to get all related permissions
    protected function getAllPermissions(... $persmissions){
        return AdminPermission::whereIn('slug',$persmissions);
    }

    public function hasPermissionThroughRole($persmission){
        foreach($persmission->roles as $role){
            if($this->roles->contains($role)){
                return true;
            }
        }
        return false;
    }

    //check if the role has necessary permission or not
    protected function hasPermission($persmission){
        return (bool) $this->permissions->where('slug',$persmission->slug)->count();
    }

    public function hasRole(... $roles){
        foreach($roles as $role){
            if($this->roles->contains('slug',$role))
            {
                return true;
            }
        }
        return false;
    }
}
