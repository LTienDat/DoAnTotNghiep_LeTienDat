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
                    <label for="productName">Tên sản phẩm</label>
                    <input class="form-control" id="productName" name="name" value="{{$product->product->name}}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="productId">ID sản phẩm</label>
                    <input type="text" class="form-control" name="product_id" id="productId" value="{{$product->product->id}}" readonly>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="menu">Ảnh sản phẩm</label>
            <input type="file" name="file_1" id="upload" class="form-control">
            <div id="image_show">
                <a href="{{$product->file_1}}" target="_blank">
                    <img src="{{$product->file_1}}" width="200px" alt="">
                </a>
            </div>
            <input type="hidden" value="{{$product->file_1}}" name="file_1" id="file">
        </div>


        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Cập nhật danh mục</button>
        </div>
        @csrf
</form>
@endsection

@section('footer')
<script>
CKEDITOR.replace('editor')
</script>
@endsection