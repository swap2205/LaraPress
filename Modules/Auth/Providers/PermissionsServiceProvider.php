<?php

namespace Modules\Auth\Providers;

use Exception;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Modules\Auth\Entities\AdminPermission;

class PermissionsServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function boot()
    {
        try {
            AdminPermission::get()->map(function ($permission){
            // dd($permission);
                Gate::define($permission->slug, function($user) use ($permission){
                    return $user->hasPermissionTo($permission);
                });
            });
        } catch (Exception $e) {
            report($e);
            return false;
        }
        //define our blade directive for the -> role
        Blade::directive('role', function ($role) {
            return "<?php if(auth('admin')->check() && auth('admin')->user()->hasRole({$role})) :?>";
        });
        Blade::directive('endrole', function ($role) {
            return "<?php endif ?>";
        });
    }
}
