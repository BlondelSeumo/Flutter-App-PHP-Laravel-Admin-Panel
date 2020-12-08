<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class Installed
{

    private $exceptNames = [
        'LaravelInstaller*',
        'LaravelUpdater*',
        'debugbar*'
    ];

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $installed = File::exists(storage_path('installed'));
        if ($this->match($request->route()) || $installed) {
            return $next($request);
        }
        return redirect(url('install'));

    }

    private function match(\Illuminate\Routing\Route $route)
    {
        foreach ($this->exceptNames as $except) {
            if (str_is($except, $route->getName())) {
                return true;
            }
        }
        return false;
    }
}
