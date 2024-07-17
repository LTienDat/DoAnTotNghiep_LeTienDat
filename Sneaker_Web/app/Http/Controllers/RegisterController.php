<?php

namespace App\Http\Controllers;

use App\Http\Services\UserService;
use Illuminate\Http\Request;

class RegisterController extends Controller
{

    protected $userService;

    public function __construct(UserService $userService){
        $this->userService = $userService;
    }
    public function index(){
        return view("admin.register", [
            'title' => 'Đăng ký tài khoản'
        ]);
    }

    public function create(Request $request){
        $this->userService->create($request->input());
        return redirect()->back('login');
    }
}
