<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\AdminMainService;
use App\Models\Cart;
use App\Models\Statistacal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MainController extends Controller
{
    protected $adminMainService;
    
    public function __construct(AdminMainService $adminMainService ){
        $this->adminMainService = $adminMainService;
    }

    public function index(Request $request)
    {
        $quantity =0;
        $sale = 0;
        $profit = 0;
        $totalOrder = 0;
        $total_order = $this->adminMainService->getTotalOrder($request);
        foreach ($total_order as $key => $value) {
            $totalOrder += $value->count;
        }
        $sales = $this->adminMainService->getSales($request);
        foreach ($sales as $key => $value) {
            $sale += $value->sales;
            $quantity += $value->quantity;
            $profit += $value->profit;
        }

        return view("admin.home",[
            "title"=> "Trang quản trị admin",
            "total_order" => $totalOrder,
            "sales" => $sale,
            'quantity' => $quantity,
            'profit' => $profit
        ]);
}

// Assuming Statistical is your model name
public function filterByDate(Request $request)
{
    $this->index($request);
    // dd($request->input());
    $from_date = $request->input('form_date'); // Correct the input name from 'form_date' to 'from_date'
    $to_date = $request->input('to_date');

    $statistics = Statistacal::selectRaw('DATE(orderDate) as orderDate, SUM(total_order) as total_order, SUM(sales) as sales, SUM(profit) as profit, SUM(quantity) as quantity')
        ->whereBetween('orderDate', [$from_date, $to_date])
        ->groupBy('orderDate')
        ->orderBy('orderDate', 'ASC')
        ->get();


    $chart_data = [];
    foreach ($statistics as $value) {
        $chart_data[] = [
            'orderDate' => $value->orderDate,
            'order' => $value->total_order,
            'sales' => $value->sales,
            'profit' => $value->profit,
            'quantity' => $value->quantity,
        ];
    }

    return response()->json($chart_data);
}
}