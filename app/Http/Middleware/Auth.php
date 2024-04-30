<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Auth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if($request->user() == null){
            return $next($request);
        }
        else if($request->user()->role_id == config('constants.roles.admin_role_id')){
            return redirect(route('admin.dashboard'));
        }
        else if($request->user()->role_id == config('constants.roles.staff_role_id')){
            return redirect(route('staff.loans', ['state' => 'all']));
        }
        else if($request->user()->role_id == config('constants.roles.user_role_id')){
            return redirect(route('user.dashboard'));
        }
    }
}
