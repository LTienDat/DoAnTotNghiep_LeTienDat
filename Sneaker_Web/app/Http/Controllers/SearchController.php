<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');
        $Products = Product::where('name', 'like', '%' . $query . '%')
                   ->orderBy('price', 'desc')
                   ->get();

        return view('search.result',[
            'searchs'=> $Products,
            'title' => "tim kiem"
        ]);
    }
}
