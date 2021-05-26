<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class ConfirmablePasswordController extends Controller
{
    /**
     * Show the confirm password view.
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        return view('auth.confirm-password');
    }

    /**
     * Confirm the user's password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function store(Request $request)
    {
        if (! Auth::guard('web')->validate([
            'email' => $request->user()->email,
            'password' => $request->password,
        ])) {
            throw ValidationException::withMessages([
                'password' => __('auth.password'),
            ]);
        }

        $request->session()->put('auth.password_confirmed_at', time());

        if (auth()->user()->role == 1) {
            return redirect()->intended(RouteServiceProvider::ADMIN);
        } else if (auth()->user()->role == 2) {
            return redirect()->intended(RouteServiceProvider::JURI);
        } else if (auth()->user()->role == 3) {
            return redirect()->intended(RouteServiceProvider::LEADER);
        } else if (auth()->user()->role == 4) {
            return redirect()->intended(RouteServiceProvider::MEMBER);
        }
    }
}
