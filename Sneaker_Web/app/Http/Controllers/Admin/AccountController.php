<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Menu\CreateFormRequest;
use App\Http\Services\UserService;
use App\Models\User;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    protected $userService;
    public function __construct(UserService $userService){
        $this->userService = $userService;
    }

    public function index(){
        return view("admin.account.list",[
            'title' => 'Danh sách tài khoản',
            'users'=> $this->userService->getAll(),
        ]);
    }
    
    public function search(Request $request){
        $users = $this->userService->searchAccount($request);

        return view("admin.account.list", [
            'title'=>'Danh sách tài khoản',
            'users'=>$users
        ]);
    }
    public function show($id){
        return view('admin.account.edit',[
            'title' => 'Chỉnh sửa tài khoản',
            'users' => $this->userService->getShow($id),
        ]);
    }

    public function updateAccount(CreateFormRequest $request, $id){
        $this->userService->update($id, $request);
        return redirect('admin/account/list');
    }

    public function destroy(Request $request)
    {
        $result = $this->userService->delete($request);
        if($result){
            return response()->json([
                'error'=> false,
                'message'=> 'Xóa thành công sản phẩm'
            ]);
        }
        return response()->json([
            'error'=> true,
            'message'=> 'Xóa thành sản phẩm thất bại'
        ]);
    }
}
