<?php

namespace App\Http\Controllers;

use App\Http\Services\ProfileService;
use App\Http\Services\UserService;
use Illuminate\Http\Request;

class Forgotcontroller extends Controller
{
    protected $ProfileService;
    public function __construct(ProfileService $ProfileService){
        $this->ProfileService = $ProfileService;
    }
    public function index(){
        return view("admin.forgotpassword.forgot",[
            'title' => 'Quên mật khẩu'
        ]);
    }

    public function resetPassword(Request $request){
        $email = $this->ProfileService->checkEmail($request);
        if($email){
            return view('admin.forgotPassword.resetPassword',[
                'title'=> 'Cài đặt lại mật khẩu'
            ]);
        }else{
            echo "<script>
                var confirmLogin = confirm('Email không chính xác, Chúng tôi không tìm thất email này trong hệ thống');
                if (confirmLogin) {
                    window.history.back();
                } else {
                    window.history.back();
                }
            </script>";
        }
    }


    public function update(Request $request){
        $resetPassword = $this->ProfileService->forgotPassword($request);
        if($resetPassword){
            return redirect()->route("login");
        }else{
            return redirect()->back();
        }
    }

    public function changePassword(){
        return view("profileUser.changePassword",[
            'title' => 'Đổi mật khẩu'
        ]);
    }

    public function updateChangePassword(Request $request){
        $updatePassword = $this->ProfileService->updatePassword($request);
        if($updatePassword){
            return redirect('/profileUser/profile');
        }else{
            return redirect('/changePassword');
        }
    }
}
