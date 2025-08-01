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
        return view('register.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        //   if($request->user()->role == 'admin' || $request->user()->role =='superadmin' ){
        //     // dd($request->user());
        //     return'Hello world';
        //   }else{
        //     return'Hi This is testing';
        //   }
          if($request->user()->role == 'admin' || $request->user()->role =='superadmin' ){
            // dd($request->user());
           return to_route('admin#dashboard');
          }else{
            return to_route('admin#profile');
          }
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
