<?php 
namespace App\Http\Services;
use App\Models\Cart;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class ProfileService{
    
    public function updateUser($request){
        try{
            $user = auth()->user();
            $data = [
                $user->name = $request->input('name'),
                $user->email = $request->input('email'),
                $user->file = $request->input('file'),
            ];
            
            $user->fill($data);
            $user->save();

            Session::flash('success', 'Cập nhật thành công');
        }catch (\Exception $e){
            Log::info($e->getMessage());
        }
    }

    public function checkEmail($request){
        $users = User::select('email')->get();
        foreach ($users as $user) { 
            if($user->email == $request->input('email')){
                return true;
            }
        }
        return false;
    }

    public function forgotPassword($request){
        try{
            $validatePassword = $request->validate(['password' => 'required|string|min:5|max:255']);
            $user = User::where('email', $request->input('email'))->first();
            if($validatePassword){
                if($request->input('password') === $request->input('confirm_password')){
                    $user->password = Hash::make($request->input('password'));
                    $user->save();
                    Session::flash('success','Lấy lại mật khẩu thành công');
                }
            }
        }catch (\Exception $e){
            Log::info($e->getMessage());
            Session::flash('error', 'Lấy lại mật khẩu thất bại, vui lòng thử lại sau');
            return false;
        }
        return true;
        
    }

    public function updatePassword($request){

        try{
            $validatePassword = $request->validate(['new_password' => 'required|string|min:5|max:255']);
            $user = auth()->user();
            if(Hash::check($request->input('password'), $user->password)){
                if($validatePassword){
                    if( $request->input('new_password') === $request->input('confirm_new_password')){
                        $user->password = Hash::make($request->input('new_password'));
                        $user->save();
                        Session::flash('success','Đổi mật khẩu thành công');
                        return true;
                    }
                    else{
                        Session::flash('error','Xác nhận mật khẩu không chính xác, vui lòng thử lại');
                    }
                }else{
                    Session::flash('error','Mật khẩu phải lớn hơn 5 kí tự');
                }
            }else{
                Session::flash('error','Mật khẩu hiện tại không khớp với mật khẩu trong hệ thống');
            }

            


        }catch (\Exception $e){
            Log::info($e->getMessage());
            Session::flash('error', 'Đổi mật khẩu thất bại, vui lòng thử lại sau');
            return false;
        }
        return false;
    }

    public function showOrder()
{
    // $email = Auth::user()->email;
    // $customers = Customer::where('email', $email)->get();
    // $ids = [];
    // foreach($customers as $customer){
    //     $ids[] = $customer->id;
    // }
    // $order = Cart::whereIn('customer_id', $ids)->get();
    // $productId = $order->pluck('product_id')->toArray();
    // dd($productId);
    // Lấy tất cả các cart của người dùng hiện tại cùng với thông tin customer
    $carts = Cart::with('customer')->whereHas('customer', function($query) {
        $query->where('email', auth()->user()->email);
    })->get();

    // Lấy danh sách product_id từ carts
    $productId = $carts->pluck('product_id')->toArray();

    // Truy vấn để lấy các orders với product_id đã lấy trước đó, và lấy thông tin từ bảng product
    return Cart::with(['product', 'customer'])
        ->whereHas('product', function($query) use ($productId) {
            $query->whereIn('id', $productId);
        })
        ->whereHas('customer', function($query) {
            $query->where('email', auth()->user()->email);
        })
        ->get();

    // Hiển thị kết quả
    
}
public function customer(){
    $email = Auth::user()->email;
    return Customer::where('email', $email)->get();
}

}
?>