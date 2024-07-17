<?php 
namespace App\Http\Services;
use App\Models\Cart;
use App\Models\Statistacal;
use Carbon\Carbon;

class AdminMainService{
    public function getTotalOrder($request){
        if($request->input('form_date') && $request->input('to_date')){
            $startDate = $request->input('form_date');
            $endDate = $request->input('to_date');
        }else{
            $month = $request->input('month', Carbon::now()->month);
            $year = $request->input('year', Carbon::now()->year);
            // Định nghĩa ngày bắt đầu và ngày kết thúc của tháng
            $startDate = Carbon::createFromDate($year, $month, 1)->startOfMonth();
            $endDate = Carbon::createFromDate($year, $month, 1)->endOfMonth();
        }

        // Truy vấn và tính tổng đơn hàng trong tháng
        return Cart::selectRaw('DATE(created_at) as date, COUNT(*) as count')
        ->whereBetween('created_at', [$startDate, $endDate])
        ->groupBy('date')
        ->orderBy('date', 'ASC')
        ->first();
    }
    public function getSales($request){
        if($request->input('form_date') && $request->input('to_date')){
            $startDate = $request->input('form_date');
            $endDate = $request->input('to_date');
        }else{
            $month = $request->input('month', Carbon::now()->month);
            $year = $request->input('year', Carbon::now()->year);
            // Định nghĩa ngày bắt đầu và ngày kết thúc của tháng
            $startDate = Carbon::createFromDate($year, $month, 1)->startOfMonth();
            $endDate = Carbon::createFromDate($year, $month, 1)->endOfMonth();
        }


        return Statistacal::selectRaw('DATE(orderDate) as orderDate, SUM(total_order) as total_order, SUM(sales) as sales, SUM(profit) as profit, SUM(quantity) as quantity')
        ->whereBetween('orderDate', [$startDate, $endDate])
        ->groupBy('orderDate')
        ->orderBy('orderDate', 'ASC')
        ->first();
    }
}
?>