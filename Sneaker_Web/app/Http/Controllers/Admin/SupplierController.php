<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Menu\CreateFormRequest;
use App\Http\Services\SupplierService;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{


    protected $supplier;
    public function __construct(SupplierService $supplier){
        $this->supplier = $supplier;
    }
    public function index(){
        $suppliers = $this->supplier->show();
        return view("admin.supplier.listSupplier",[
            "title"=> 'Nhà cung cấp',
            'suppliers'=> $suppliers
        ]);
    }

    
    public function search(Request $request){
        $suppliers = $this->supplier->searchSupplier($request);

        return view("admin.supplier.listSupplier", [
            'title'=>'Danh sách sản phẩm',
            'suppliers'=>$suppliers
        ]);
    }
    public function create(){
       return view('admin.supplier.addSupplier',[
            'title'=> 'Thêm nhà cung cấp'
       ]);
    }

    public function store(Request $request){
         $this->supplier->insert($request);
        return redirect()->back();
    }

    public function show($id){
        $supplier = $this->supplier->get($id);
        return view('admin.supplier.editSupplier',[
            'title'=> 'Sửa nhà cung cấp',
            'supplier'=> $supplier
        ]);
    }

    public function update(Supplier $supplier, CreateFormRequest $request){
        $this->supplier->edit($supplier,$request);
        return redirect('admin/supplier/list');

    }

    public function destroy(Request $request){
        $result = $this->supplier->delete($request);
        if($result){
            return response()->json([
                'error'=> false,
                'message'=> 'Xóa thành công sản phẩm'
            ]);
        }
        return response()->json([
            'error'=> true,
            'message'=> 'Xóa thành sản phẩm thất bại'
        ]);
    }
}
