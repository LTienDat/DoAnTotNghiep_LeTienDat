@extends('admin.main')
@section('head')
    <script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
@endsection
@section('content')

<form action="" method="post">
    <div class="card-body">
        <div class="form-group">
            <label for="menu">Tên Danh mục</label>
            <input type="text" name="name" class="form-control" id="" placeholder="Nhập tên danh mục">
        </div>
        <div class="form-group">
            <label for="menu">Danh mục</label>
            <select class="form-control" name="parent_id" id="">
                <option value="0">Danh mục cha</option>
                @foreach($menus as $menu)
                <option value="{{$menu->id}}">{{$menu->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="menu">Mô tả</label>
            <textarea name="description" id="" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label for="menu">Nội dung danh mục</label>
            <textarea name="content" id="editor" class="form-control"></textarea>
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
    @csrf
</form>
@endsection

@section('footer')
    <script>
        CKEDITOR.replace('editor')
    </script>
@endsection