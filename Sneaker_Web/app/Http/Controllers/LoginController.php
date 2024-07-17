<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LoginController extends Controller
{


    /**
     * Display the login form.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('admin.login', [
            'title' => 'Đăng nhập hệ thống'
        ]);
    }

    /**
     * Handle the login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate input data
        $request->validate([
            'email' => 'required|email|exists:users,email', // Check email existence in users table
            'password' => 'required|min:6',
        ]);



        $credentials = $request->only('email', 'password');

        // Attempt to login
        // if (Auth::attempt($credentials)) {
        //     $user = Auth::user();

        //     // Regenerate session ID
        //     $request->session()->regenerate();

        //     if ($user->level === 'USER' && $user->active === '0') {
        //         Session::flash('error', 'Tài khoản của bạn chưa được cấp phép hoạt động');
        //         return redirect()->back();
        //     } elseif ($user->level === "ADMIN" && $user->active === '0') {
        //         Session::flash('error', 'Tài khoản của bạn chưa được cấp phép hoạt động');
        //         return redirect()->back();
        //     } elseif ($user->level === 'USER' && $user->active === '1') {
        //         return redirect()->route('home'); // Redirect to user home
        //     } elseif ($user->level === "ADMIN" && $user->active === '1') {
        //         return redirect()->route('admin'); // Redirect to admin main
        //     }
        // }
        // // Authentication failed
        // Session::flash('error', 'Email hoặc password không đúng');

        // return redirect()->back();
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
 
            return redirect()->route('admin');
        }
 
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    /**
     * Logout the user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        // Lấy thông tin người dùng trước khi đăng xuất
        $user = Auth::user();

        // Đăng xuất người dùng
        Auth::logout();

        // Invalidate the session to prevent reuse
        $request->session()->invalidate();

        // Regenerate the session token to prevent CSRF attacks
        $request->session()->regenerateToken();

        // Redirect based on user level
        if ($user->level === "USER") {
            return redirect()->route('home'); // Redirect to user home
        } elseif ($user->level === "ADMIN") {
            return redirect()->route('login'); // Redirect to admin main
        }

        // Default redirect if no level matches
        return redirect()->route('login');
    }
}
