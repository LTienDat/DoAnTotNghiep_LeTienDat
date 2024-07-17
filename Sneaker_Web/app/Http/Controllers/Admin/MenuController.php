<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Menu\CreateFormRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\services\Menu\MenuService;
use App\Models\Menu;

class MenuController extends Controller
{
    protected $menuService;

    public function __construct(MenuService $menuService){
        $this->menuService = $menuService;
    }
    public function index(Request $request){
        return view("admin.menu.list",[
            'title'=> 'Danh sách danh mục',
            'menus' => $this->menuService->getAll()
        ]);
    }
    public function search(Request $request){
        $menus = $this->menuService->searchMenu($request);

        return view("admin.menu.list", [
            'title'=>'Danh sách danh mục',
            'menus'=>$menus
        ]);
    }
    public function create(){
        return view("admin.menu.add", [
            "title"=> "Thêm Danh mục mới",
            'menus'=> $this->menuService->getParent(),
        ]);
    }
    public function store(CreateFormRequest $request){
       $this->menuService->create($request);
       return redirect()->back();
    }
    public function destroy(Request $request){
        $result = $this->menuService->destroy($request);
        if($result){
            return response()->json([
                'error' => false,
                'message' => 'xóa thành công danh mục'
            ]);
        }

        return response()->json([
            'error' => true,
            'message' => 'Không thấy mục tiêu cần xóa'
        ]);
    }

    public function show(Menu $menu){
        return view("admin.menu.edit",[
            'title'=> 'Chỉnh sửa danh mục'. $menu->name,
            'menu' => $menu,
            'menus'=> $this->menuService->getParent()
        ]);
    }

    public function update(Menu $menu, CreateFormRequest $request){
        $this->menuService->update($menu, $request);

        return redirect('admin/menus/list');
    }

}
