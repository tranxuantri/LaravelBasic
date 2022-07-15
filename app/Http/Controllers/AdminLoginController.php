<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminLoginController extends Controller
{


    public function getLogin()
    {
        // if (Auth::check()) {
        //     return redirect('admincp');
        // } else {
            return view('login');
        // }
    }

    /**
     * @param LoginRequest $request
     * @return RedirectResponse
     */
    public function postLogin(LoginRequest $request)
    {
        $login = [
            'email' => $request->email,
            'password' => $request->password,
            'level' => 1,
            'status' => 1
        ];

        if (Auth::attempt($login)) {
            return redirect('companies');
        } else {
            return redirect()->back()->with('status', 'Email hoặc Password không chính xác');
        }
    }

    /**
     * action admincp/logout
     * @return RedirectResponse
     */
    public function getLogout()
    {
        Auth::logout();
        return redirect()->route('getLogin');
    }

    public function getRegister() {
        return view('register');
    }

    public function postRegister(RegisterRequest $request) {
        User::create([
            'name' => trim($request->input('name')),
            'email' => strtolower($request->input('email')),
            'password' => bcrypt($request->input('password')),
            'level' => 1,
            'status' => 1
        ]);
        return redirect()->route('getLogin');
    }
}
