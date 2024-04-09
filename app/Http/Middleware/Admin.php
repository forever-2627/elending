<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    private $ADMIN_ROLE_ID = 3;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if($request->user() && $request->user()->role_id == config('constants.roles.admin_role_id')){
            return $next($request);
        }

        if ($exception instanceof \Illuminate\Session\TokenMismatchException) {
            return redirect()->route('login');
        }
        return redirect(route('login.get'));
    }
}
