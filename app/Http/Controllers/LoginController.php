<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);
        if(Auth::attempt($request->only('email', 'password')))
        {
            return redirect('/profile');
        }

        return back();

    }

    public function logout(Request $request)
    {
        Auth::logout();

        return redirect('/');
    }

    public function profile(Request $request)
    {
        $user = $request->user();
        $orders = $user->orders->reverse();
        $locale = (session('locale') == 'ua') ? 'ua' : 'ru';
        $userName = $user->name;

        return view('auth.profile', ['name' => $userName, 'request' => $request, 'locale' => $locale, 'orders' => $orders]);
    }
}
