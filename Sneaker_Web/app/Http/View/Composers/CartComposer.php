<?php 
namespace App\Http\View\Composers;

use App\Models\Menu;
use App\Models\Product;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
class CartComposer{

    protected $users;
    public function __construct()
    {

    }
    public function compose(View $view)
    {
        $keyProductId = [];
        $carts = Session::get('carts');
        if(is_null($carts)){
            return [];
        }
        $productIds = array_keys($carts);
        foreach( $productIds as $productId ) {
            $keyProductId[] = intval(subStr(strval($productId), 0, -2));
            
        }
        // $products = Product::select('id', 'name', 'price', 'price_sale', 'file')
        // ->where('active', 1)->whereIn('id', $keyProductId)->get();
        $results = Product::select('id', 'name', 'price', 'price_sale', 'file')
        ->where('active', 1)
        ->whereIn('id', $keyProductId)
        ->get();

    // Tạo một mảng kết quả rỗng
    $products = [];

    // Đếm số lần xuất hiện của từng ID trong $keyProductId
    $idCounts = array_count_values($keyProductId);

    // Duyệt qua các sản phẩm đã truy xuất
    foreach ($results as $result) {
        // Lấy số lần xuất hiện của sản phẩm hiện tại
        $count = $idCounts[$result->id] ?? 0;
        // Sao chép sản phẩm vào mảng kết quả với số lần tương ứng
        for ($i = 0; $i < $count; $i++) {
            $products[] = $result;
        }
    }

        $view->with('productCart', $products);
    }
}