@extends('admin.main')
@section('head')
<script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
@endsection
@section('content')

<form action="" method="post">

    <div class="card-body">

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="menu">ID sản phẩm</label>
                    <input type="text" value="{{$warehouses->product->id}}" name="product_id" class="form-control" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="menu">ID Nhà cung cấp</label>
                    <input type="text" value="{{$warehouses->supplier_id}}" name="supplier_id" class="form-control" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="menu">Size</label>
                    <input type="text" value="{{$warehouses->size}}" name="size" class="form-control">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="menu">Màu</label>
                    <input type="text" value="{{$warehouses->color}}" name="color" class="form-control">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="menu">Số lượng</label>
                    <input type="text" name="quantity" value="{{$warehouses->quantity}}" id="" class="form-control">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="menu">Giá nhập</label>
                    <input type="text" name="import_price" value="{{$warehouses->import_price}}" id="" class="form-control">
                </div>
                </div>
        </div>


        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Cập nhật sản phẩm</button>
            @csrf
        </div>

</form>
@endsection

@section('footer')

@endsection