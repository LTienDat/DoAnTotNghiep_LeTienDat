<?php 
 namespace App\Http\Services;
 use App\Helpers\Helper;
 use App\Jobs\SendMail;
 use App\Models\Cart;
 use App\Models\Customer;
 use App\Models\Product;
 use App\Models\WareHouse;

 use Illuminate\Support\Facades\Auth;

 use Illuminate\Support\Facades\Session;

 class CartService{
    
public function create( $request)
{
    if (Auth::check()) {
        $num = (int)$request->input('num_product');
        $product_id = (int)$request->input('product_id');
        $size = (int)$request->input('size');
        $color = $request->input('color');
        $warehouseQuantity = WareHouse::select('quantity')->where('product_id', $product_id)->first();

        if ($num <= 0 || $product_id <= 0 || empty($size) || $size == "Chọn size") {
            Session::flash('error', 'thông tin, số lượng đặt hàng không chính xác');
            return false;
        }elseif($num > $warehouseQuantity->quantity){
            Session::flash('error',"Số lượng trong kho hàng không đủ, trong kho hàng chỉ còn $warehouseQuantity->quantity sản phẩm ");
            return false;
        }
 
        
        $productId = 0;
        // Lấy giỏ hàng từ session
        $carts = Session::get('carts', []);
        $keycarts = $product_id . $size;
        $productId = intval($keycarts);


        
        $exists = false;
        if(is_array($carts)){
        foreach ($carts as $key => $item) {      
            if ($key == $productId && $item['size'] == $size && $item['color'] == $color) {
                // Nếu sản phẩm đã tồn tại với cùng $product_id, $size, và $color, cập nhật số lượng
                $carts[$key]['num_product'] += $num;
                $exists = true;
                break;
            }
        }}
        if (!$exists) {
            // Nếu sản phẩm chưa tồn tại với $product_id, $size, và $color, thêm mới vào giỏ hàng
            $carts[$productId] = [
                'num_product' => $num,
                'color' => $color,
                'size' => $size,
            ];
        }
        // Lưu lại giỏ hàng vào session
        Session::put('carts', $carts);
        Session::flash('susscess', 'Sản phẩm đã được thêm vào giỏ hàng');
        return response()->json(['message' => 'Sản phẩm đã được thêm vào giỏ hàng'], 200);
    } else {
        return response()->json(['message' => 'Bạn cần phải đăng nhập để thêm sản phẩm vào giỏ hàng'], 401);
    }
}

    public function getProduct(){
        $keyProductId = [];
        $carts = Session::get('carts');
        if(is_null($carts)){
            return [];
        }
        $productIds = array_keys($carts);
        foreach( $productIds as $productId ) {
            $keyProductId[] = intval(subStr(strval($productId), 0, -2));
            
        }

        return Product::select('id', 'name', 'price', 'price_sale', 'file')
            ->where('active', 1)->whereIn('id', $keyProductId)->get();

    }


    public function update($request) {
        // Lấy ra giá trị hiện tại của session carts nếu có
        $carts = session('carts', []);
        // Lặp qua từng sản phẩm trong session carts
        foreach ($carts as $productId => $cart) {
            // Lấy giá trị mới của num_product từ request
            $newQuantity = $request->input('num_product');
            // Cập nhật lại giá trị num_product cho sản phẩm hiện tại
            $carts[$productId]['num_product'] = $newQuantity;
        }
        // Lưu lại session sau khi đã cập nhật
        session(['carts' => $carts]);
        return true;
    }
    

    public function remove($id){
        $carts = Session::get('carts');
        unset($carts[$id]);
        Session::put('carts', $carts);
        return true;
    }
 }