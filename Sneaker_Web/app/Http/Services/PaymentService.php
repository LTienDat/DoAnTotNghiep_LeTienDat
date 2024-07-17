<?php

namespace App\Http\Services;

use App\Events\OrderCreated;
use App\Helpers\Helper;
use App\Jobs\SendMail;
use App\Jobs\SendMailAdmin;
use App\Models\Cart;
use App\Models\Customer;
use App\Models\InfoCustomTemporary;
use App\Models\InfoOrder;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Statistacal;
use App\Models\WareHouse;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PaymentService
{
    public function getProduct()
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

        return Product::select('id', 'name', 'price', 'price_sale', 'file')
            ->where('active', 1)->whereIn('id', $keyProductId)->get();
    }

    public function pay($request)
    {
        try {
            
            DB::beginTransaction();
            $carts = Session::get('carts');
            
            if (is_null($carts)) {
                return false;
            }
            $customer = Customer::create([
                "name" => $request->input("name"),
                "email" => $request->input("email"),
                "phone" => $request->input("phone"),
                "address" => $request->input("address"),
                "note" => $request->input("note"),
                'payment' => $request->input('payment'),
            ]);
            
            
            $this->infoProduct($carts, $customer->id, $request);
  
            DB::commit();
            Session::flash("success", "Đặt hàng thành công");
            
            SendMail::dispatch($request->input("email"))->delay(now()->addSeconds(5));
            SendMailAdmin::dispatch('datletien.18012002@gmail.com')->delay(now()->addSeconds(5));
            InfoCustomTemporary::truncate();
            Session::forget('carts');
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Đặt hàng không thành công: ' . $e->getMessage());
            Session::flash("error", "Đặt hàng không thành công, vui lòng thử lại sau");
            return false;
        }
        return true;
    }

    protected function infoProduct($carts, $customer_id, $request)
    {
        // Lấy ra các ID sản phẩm từ mảng $carts
        $keyProductId = [];
        $productIds = array_keys($carts);
        // Truy vấn các sản phẩm từ cơ sở dữ liệu dựa trên các ID đã lấy
        foreach($productIds as $productId) {
            $keyProductId[] = intval(subStr(strval($productId), 0, -2));
        }
        
        $products = Product::select('id', 'name', 'price', 'price_sale', 'file')
            ->where('active', 1)
            ->whereIn('id', $keyProductId)
            ->get();

        // Chuẩn bị mảng dữ liệu để chèn vào cơ sở dữ liệu
        $data = [];
        $data2 = [];
        foreach ($products as $product) {
            foreach($productIds as $productId){
            // Kiểm tra xem ID sản phẩm hiện tại có tồn tại trong $carts không
            if (isset($carts[$productId]) && $product->id == intval(subStr(strval($productId), 0, -2))) {
                $data[] = [
                    'customer_id' => $customer_id,
                    'product_id' => $product->id,
                    'quantity' => $carts[$productId]['num_product'], // Lấy số lượng từ $carts
                    'size' => isset($carts[$productId]['size']) ? $carts[$productId]['size'] : null,
                    'color' => isset($carts[$productId]['color']) ? $carts[$productId]['color'] : null,
                    'price' => Helper::price($product->price, $product->price_sale),
                    'created_at' => Carbon::now()
                ];
                
                $warehouses = Warehouse::where('product_id', $product->id)->where('size', $carts[$productId]['size'])->first();   
                $warehouses->quantity -= $carts[$productId]['num_product'];
                $warehouses->save();
                $data2 = [
                    'quantity' => $carts[$productId]['num_product'],
                    'total_order' => '1',
                    'sales' => Helper::price($product->price, $product->price_sale),
                    'orderDate' => Carbon::now()->format('Y-m-d'),
                    'profit' => Helper::price($product->price, $product->price_sale)*$carts[$productId]['num_product'] - $warehouses->import_price*$carts[$productId]['num_product'], 
                ];
                Statistacal::create($data2);
            }
        }
        }


        // Truy xuất tất cả các bản ghi Warehouse tương ứng với danh sách sản phẩm
        // Chèn dữ liệu vào cơ sở dữ liệu sử dụng model Cart

        return Cart::insert($data); 
        
    }



    public function VNPReturn($request){
        $VNP_data = $request->all();
        Session::put('VNPPayment',  $VNP_data);
        $VNPPayment = Session::get('VNPPayment');
        
        
        if(isset($VNPPayment)){
            if($VNPPayment['vnp_TransactionStatus'] == "00"){
        $data = [
            'order_id'=> $VNPPayment['vnp_TxnRef'],
            'price'=> $VNPPayment['vnp_Amount'],
            'note'=> $VNPPayment['vnp_OrderInfo'],
            'vnp_response_code'=> $VNPPayment['vnp_ResponseCode'],
            'code_vnpay'=> $VNPPayment['vnp_BankTranNo'],
            'code_bank'=> $VNPPayment['vnp_BankCode'],
            'transactionCode'=> $VNPPayment['vnp_TxnRef'],
            'created_at' => Carbon::now(),
            'updated_at'=> Carbon::now()
        ];
        }

        
    }
    Payment::insert($data);
    
    return Payment::where('order_id',  $VNPPayment['vnp_TxnRef'])->first();
    }

    public function VNPay($request){
        InfoCustomTemporary::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
            'note' => $request->input('note'),
            'amount' => $request->input('vnp') + 30000
        ]);
        $total = $request->input('vnp');
        $maxId = Cart::max('id');

        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://127.0.0.1:8000/vnpay-return";
        $vnp_TmnCode = "LSX7MU8C";//Mã website tại VNPAY 
        $vnp_HashSecret = "V8AF1H09UUY5FTW4X0DVB73M44MHI4JL"; //Chuỗi bí mật
        
        $vnp_TxnRef = $maxId + 1; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này 
        $vnp_OrderInfo = $request->input('note');
        $vnp_OrderType = "billPayment";
        $vnp_Amount = $total + 30000;
        $vnp_Locale = "VNĐ";
        $vnp_BankCode = "NCB";
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        //Add Params of 2.0.1 Version

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef

        );
        
        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }
        
        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }
        
        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array('code' => '00'
            , 'message' => 'success'
            , 'data' => $vnp_Url);
            if (isset($_POST['payment'])) {
                header('Location: ' . $vnp_Url);
                die();
            } else {
                echo json_encode($returnData);
            }
            // vui lòng tham khảo thêm tại code demo
    
    }
}