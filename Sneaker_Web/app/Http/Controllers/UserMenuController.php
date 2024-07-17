<?php

namespace App\Http\Controllers;

use App\Http\Services\Menu\MenuService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class UserMenuController extends Controller
{
    protected $menuService;

    public function __construct(MenuService $menuService){
        $this->menuService = $menuService;
    }

    public function index(Request $request, $id, $slug)
    {

        $menu = $this->menuService->getId($id);
        $products = $this->menuService->getProduct($menu, $request);
        return view('menu',[
            'title' => $menu->name,
            'products' => $products,
            'menus' => $menu,
            'request' => $request
        ]);
    }

    public function search(Request $request, $id, $slug){
        $menu = $this->menuService->getId($id);
        $products = $this->menuService->searchProduct($menu, $request);

        return view("menu", [
            'title' => $menu->name,
            'products'=>$products,
            'menus' => $menu,
            'request' => $request
        ]);
    }

    
}
