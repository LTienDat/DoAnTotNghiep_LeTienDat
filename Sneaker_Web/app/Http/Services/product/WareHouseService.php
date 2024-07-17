<?php

namespace App\Http\Services\Product;

use App\Models\Product;
use App\Models\Product_attributes;
use App\Models\ProductAttribute;
use App\Models\Supplier;
use App\Models\WareHouse;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class WareHouseService
{
    public function getAll()
    {
        return WareHouse::select('product_id')->distinct('foreign_key_column')->with('product')->get();
    }

    public function getDetail($product_id){
        return WareHouse::with('product')->where('product_id', $product_id)->get();
    }

    public function insertOrUpdate($request)
    {
        try {
            // Tìm hoặc tạo mới bản ghi dựa trên  và 'size'

            $productAttribute = WareHouse::updateOrCreate(
                [
                    'product_id' => $request->input('product_id'),
                    'size' =>  $request->input('size'), 'color' => $request->input('color'),
                    'import_price' => $request->input('import_price')
                ],
                [
                    'quantity' => DB::raw('quantity + ' .  $request->input('quantity')),
                    'supplier_id' => $request->input('supplier_id')
                ]
            );

            if ($productAttribute->wasRecentlyCreated) {
                Session::flash('success', 'Thêm thành công');
            } else {
                Session::flash('success', 'Cập nhật thành công');
            }
        } catch (\Exception $e) {
            Session::flash('error', 'Thêm/Cập nhật thất bại');
            Log::error($e->getMessage());
            return false;
        }
    }

    public function getProduct()
    {
        return Product::get();
    }
    public function getSupplier()
    {
        return Supplier::get();
    }

    public function getWarehouse($id)
    {
        return WareHouse::find($id);
    }

    public function edit($warehouse, $request)
    {
        // dd($request->input());
        try {
            $warehouse->fill($request->input());
            $warehouse->save();
            Session::flash('success', 'Cập nhật thành công');
        } catch (\Exception $e) {
            Session::flash('error', 'Cập nhật thất bại');
            Log::info($e->getMessage());
            return false;
        }
        return true;
    }

    public function delete($request){
        $warehouse = WareHouse::where('product_id',$request->input('id'))->get();
        if ($warehouse) {
            foreach ($warehouse as $key => $value) {
                $value->delete();
            }
            return true;
        }
        return false;
    }
    public function deleteDetail($request)
    {
        $warehouse = WareHouse::where('id', $request->input('id'))->first();
        if ($warehouse) {
            $warehouse->delete();
            return true;
        }
        return false;
    }
    public function searchWarehouse($request)
    {
        $key = $request->input('query');

        // Sử dụng paginate trước khi get() để lấy dữ liệu đã phân trang
        return WareHouse::whereHas('product', function ($query) use ($key) {
            $query->where('name', 'like', '%' . $key . '%');
        })->paginate(15); // Phân trang với mỗi trang 15 sản phẩm
    }
}