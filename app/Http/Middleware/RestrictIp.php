<?php

namespace App\Http\Middleware;

use Closure;

class RestrictIp
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try{
            $ipsDeny = setting('blocked_ips',[]);
            if(count($ipsDeny) >= 1 )
            {
                if(in_array(request()->ip(), $ipsDeny))
                {
                    return response()->view('vendor.errors.page', ['code'=>403,'message' => "Unauthorized access, IP address was <b>".request()->ip()."</b>"]);
                }
            }
        } catch (\Exception $exception) {


        }
        return $next($request);
    }
}
