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
                    <label for="menu">Tên nhà cung cấp</label>
                    <input type="text" name="name" value="{{old('name')}}" class="form-control" id="" placeholder="Nhập tên sản phẩm">
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="menu">Email</label>
                    <input type="text"  value="{{old('price')}}" name="email" class="form-control">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="menu">Số điện thoại</label>
                    <input type="text"  value="{{old('price_sale')}}" name="phone" class="form-control">
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="menu">Địa chỉ</label>
            <input type="text" name="address"  value="{{old('description')}}" id="" class="form-control">{{old('description')}}</input>
        </div>
        

    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Tạo danh mục</button>
    </div>
    
</form>
@endsection

@section('footer')
    <script>
        CKEDITOR.replace('editor')
    </script>
@endsection