<?php 
namespace App\Http\Services\Menu;

use App\Models\Product;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use App\Models\Menu;

class MenuService {

    public function getParent(){
        return Menu::where('parent_id',0)->get();
    
    }

    public function show(){
        return Menu::select('name', 'id', 'file')
        ->where('parent_id',0)->orderByDesc('id')->get();   
    }
    public function getAll(){
        return Menu::orderByDesc('id')->paginate(10);
    }
    public function create($request) {
    try {

            Menu::create([
                'name' => (string)$request->input('name'),
                'parent_id' => (int) $request->input('parent_id'),
                'description' => (string)$request->input('description'),
                'content' =>(string) $request->input('content'),
                'active' =>(int) $request->input('active'),
                'file' =>(string) $request->input('file'),
                'slug' => Str::slug($request->input('name')),
                
            ]);
            

            Session::flash('success', 'Tạo danh mục thành công');
        } catch (\Exception $e) {
            Session::flash('error', 'Đã xảy ra lỗi: ' . $e->getMessage()); // Thêm tin nhắn "Đã xảy ra lỗi: "
            return false;
        }
        return true;
    }

    public function destroy($request){
        $id = (int) $request->input('id');
        $menu = Menu::Where('id', $id)->first();
        if($menu){
            return Menu::Where('id', $id)->orWhere('parent_id', $id)->delete();
        }
        return false;   
    }

    public function update($menu ,$request){
        try{
            $menu -> fill($request->input());
            $menu -> save();
            Session::flash('success','Cập nhật thành công');
        }catch(\Exception $e){
            Session::flash('error','Cập nhật thất bại');
            \Log::info($e->getMessage());
            return false;
        }
        return true;    
    }

    public function getId($id){
        // Menu::where(function($query) use ($id){
        //     $query->where('id', $id)->orWhere('parent_id', $id)->
        // });
        return Menu::where('id', $id)->orwhere('parent_id', $id)->where("active", 1)->firstOrFail();
    }

    public function getProduct($menu, $request){

        $query =  $menu->products()->select('id', 'name', 'price', 'file')
        ->where('active', 1);
        if($request->input('price')){
            $query->orderBy('price', $request->input('price'));
        }

        return $query->orderByDesc('id')->paginate(12)->appends($request->except('page'));
    }

    public function searchMenu($request)
    {
        $key = $request->input('query');

        // Sử dụng paginate trước khi get() để lấy dữ liệu đã phân trang
        return Menu::where(function ($query) use ($key) {
            $query->where('name', 'like', '%' . $key . '%')
                ->orWhere('id', $key);
        })->paginate(15); // Phân trang với mỗi trang 15 sản phẩm
    }
    public function searchProduct($menu ,$request)
    {
        $key = $request->input('search');

        // Sử dụng paginate trước khi get() để lấy dữ liệu đã phân trang
        return Product::where(function ($query) use ($key) {
            $query->where('name', 'like', '%' . $key . '%')
                ->orWhere('price', $key);
        })->paginate(15); // Phân trang với mỗi trang 15 sản phẩm
    }
}
?>
