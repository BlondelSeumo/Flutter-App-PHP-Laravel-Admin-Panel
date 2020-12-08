<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Exceptions\PermissionDoesNotExist;
use Spatie\Permission\Exceptions\RoleDoesNotExist;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RefreshPermissionsSeeder extends Seeder
{
    //$ php artisan db:seed --class=RefreshPermissionsSeeder
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
        foreach ($routeCollection as $route) {
            if ($this->match($route)) {
                // PermissionDoesNotExist
                try{
                    Permission::findOrCreate($route->getName(),'web');
                }catch (Exception $e){

                }
            }
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