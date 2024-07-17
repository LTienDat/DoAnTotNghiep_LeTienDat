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
                    <label for="menu">Tên sản phẩm</label>
                    <input type="text" name="name" value="{{old('name')}}" class="form-control" id="" placeholder="Nhập tên sản phẩm">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="menu">Sản phẩm</label>
                    <select class="form-control" name="menu_id" id="">
                        @foreach ($menus as $menu)
                            <option value="{{$menu->id}}">{{$menu->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="menu">Giá gốc</label>
                    <input type="number"  value="{{old('price')}}" name="price" class="form-control">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="menu">Giá Giảm</label>
                    <input type="number"  value="{{old('price_sale')}}" name="price_sale" class="form-control">
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="menu">Mô tả</label>
            <textarea name="description"  value="{{old('description')}}" id="" class="form-control">{{old('description')}}</textarea>
        </div>
        <div class="form-group">
            <label for="menu">Nội dung Sản phẩm</label>
            <textarea name="content"   id="editor" class="form-control">{{old('content')}}</textarea>
        </div>
        <div class="form-group">
            <label for="menu">Ảnh sản phẩm</label>
            <input type="file" id="upload" class="form-control">
            <div id="image_show">
            </div>
            <input type="hidden" name="file"  id="file" value="">
        </div>

        <div class="form-group">
            <label for="">Kích hoạt</label>
            <div class="custom-control custom-radio">
                <input class="custom-control-input" type="radio" id="active" name="active" value="1">
                <label for="active" class="custom-control-label">Có</label>
            </div>
            <div class="custom-control custom-radio">
                <input class="custom-control-input" type="radio" id="no_active" name="active" value="0">
                <label for="no_active" class="custom-control-label">Không</label>
            </div>
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