@extends('admin.main')
@section('head')
    <script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
@endsection
@section('content')

<form action="" method="post">
@csrf
    <div class="card-body">
        <div class="row">
        <div class="col-md-6">
                <div class="form-group">
                    <label for="productName">Tên sản phẩm</label>
                    <select class="form-control" id="productName" name="name">
                        <option value="">Chọn sản phẩm</option>
                        @foreach ($products as $product)
                        <option value="{{$product->id}}">{{$product->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="productId">ID sản phẩm</label>
                    <input type="text" class="form-control" name="product_id" id="productId" readonly>
                </div>
            </div>
        </div>


        <div class="form-group">
            <label for="menu">Ảnh sản phẩm</label>
            <input type="file" id="upload" class="form-control">
            <div id="image_show">
            </div>
            <input type="hidden" name="file_1"  id="file" value="">
        </div>



    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Thêm sảnh sản phẩm</button>
    </div>
    
</form>
@endsection

@section('footer')
    <script>
        CKEDITOR.replace('editor')
    </script>
@endsection