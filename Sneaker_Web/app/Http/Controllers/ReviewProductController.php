<?php

namespace App\Http\Controllers;

use App\Models\Review_Product;
use App\Models\ReviewProduct_Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ReviewProductController extends Controller
{
    public function store(Request $request, $id){
        $validateData = $request->validate(['review' => 'required', 'star' => 'required', 'user_id' => '']);
        $validateData['user_id'] =  Auth::user()->id;
        dd(Auth::user());
        Review_Product::create($validateData);
        $review = Review_Product::where('review', $validateData['review'])->where('star', $validateData['star'])->where('user_id', $validateData['user_id'])->first();
        ReviewProduct_Product::create([
            'products_id' => $id,
            'reviewProduct_id' => $review->id
        ]);
        Session::flash('success','Đánh giá sản phẩm thành công');
        return redirect()->back();
    }
}
