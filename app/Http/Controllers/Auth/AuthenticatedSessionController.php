<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        try{
            $request->authenticate();
        }catch (\Exception $e){
            $notification = array(
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }

        $request->session()->regenerate();

        if($request->user()->role_id == config('constants.roles.admin_role_id')){
            return redirect(route('admin.dashboard'));
        }
        else if($request->user()->role_id == config('constants.roles.staff_role_id')){
            return redirect(route('staff.loans'));
        }
        else if($request->user()->role_id == config('constants.roles.user_role_id')){
            return redirect(route('user.dashboard'));
        }
//        else return redirect()->intended(route('dashboard', absolute:false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
