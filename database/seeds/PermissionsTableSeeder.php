<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Exceptions\PermissionDoesNotExist;
use Spatie\Permission\Exceptions\RoleDoesNotExist;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsTableSeeder extends Seeder
{
    //$ php artisan db:seed --class=PermissionsTableSeeder
    private $exceptNames = [
        'LaravelInstaller*',
        'LaravelUpdater*',
        'debugbar*',
        'cashier.*'
    ];

    private $exceptControllers = [
        'LoginController',
        'ForgotPasswordController',
        'ResetPasswordController',
        'RegisterController',
        'PayPalController'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $routeCollection = Route::getRoutes();
        try{
            $role = Role::findByName('admin');
            if (!$role) {
                $role = Role::create(['name' => 'admin']);
            }
        }catch (Exception $e){
            if($e instanceof RoleDoesNotExist){
                $role = Role::create(['name' => 'admin']);
            }
        }
        foreach ($routeCollection as $route) {
            if ($this->match($route)) {
                // PermissionDoesNotExist
                try{
                    if(!$role->hasPermissionTo($route->getName())){
                        $permission = Permission::create(['name' => $route->getName()]);
                        $role->givePermissionTo($permission);
                    }
                }catch (Exception $e){
                    if($e instanceof PermissionDoesNotExist){
                        $permission = Permission::create(['name' => $route->getName()]);
                        $role->givePermissionTo($permission);
                    }
                }
            }
        }
        $user = User::find(1);
        if(!$user->hasRole('admin')){
            $user->assignRole('admin');
        }
    }

    private function match(Illuminate\Routing\Route $route)
    {
        if ($route->getName() === null) {
            return false;
        } else {
            if(preg_match('/API/',class_basename($route->getController()))){
                return false;
            }
            if (in_array(class_basename($route->getController()), $this->exceptControllers)) {
                return false;
            }
            foreach ($this->exceptNames as $except) {
                if (str_is($except, $route->getName())) {
                    return false;
                }
            }
        }
        return true;
    }
}
