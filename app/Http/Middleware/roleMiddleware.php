<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;
use JWTAuth;

class roleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role = 'admin')
    {

        try {
            if (Auth::check() || JWTAuth::parseToken()->authenticate())
            {
                $roles = explode('-',$role);
                if(in_array(Auth::user()->role,$roles))
                {
                    return $next($request);
                }
            }
            return abort('401');
        }catch (\ Exception $ex)
        {
            return response()->json(['status' => 'You are not An Admin Or A Moderator sorry!']);
        }

    }
}
