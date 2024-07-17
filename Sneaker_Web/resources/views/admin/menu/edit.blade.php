@extends('admin.main')
@section('head')
    <script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
@endsection
@section('content')

<form action="" method="post">
    <div class="card-body">
        <div class="form-group">
            <label for="menu">Tên Danh mục</label>
            <input type="text" name="name" value="{{$menu->name}}" class="form-control" id="" placeholder="Nhập tên danh mục">
        </div>
        <div class="form-group">
            <label for="menu">Danh mục</label>
            <select class="form-controll" name="parent_id" id="">
                <option value="0"  {{$menu->parent_id == 0 ? 'selected' : ''}}>Danh mục cha</option>
                @foreach($menus as $menuParent)
                <option value="{{$menu->id}},{{$menu->parent_id ==$menuParent->id ? 'selected' : ''}}">
                    {{$menuParent->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="menu">Mô tả</label>
            <textarea name="description" id="" class="form-control">{{$menu ->description}}</textarea>
        </div>
        <div class="form-group">
            <label for="menu">Nội dung danh mục</label>
            <textarea name="content" id="editor" class="form-control">{{$menu->content}}</textarea>
        </div>

        <div class="form-group">
            <label for="menu">Ảnh danh mục</label>
            <input type="file" name="file" id="upload" class="form-control">
            <div id="image_show">
                <a href="{{$menu->file}}" target="_blank">
                    <img src="{{$menu->file}}" width="200px" alt="">
                </a>
            </div>  
            <input type="hidden" value="{{$menu->file}}"  name="file" id="file">
        </div>

        <div class="form-group">
            <label for="">Kích hoạt</label>
            <div class="custom-control custom-radio">
                <input class="custom-control-input" type="radio" id="active" name="active" 
                value="1" {{$menu->active == 1 ? 'checked=""' : ''}}>
                <label for="active" class="custom-control-label">Có</label>
            </div>
            <div class="custom-control custom-radio">
                <input class="custom-control-input" type="radio" id="no_active" name="active" 
                value="0"  {{$menu->active == 0 ? 'checked=""' : ''}}>
                <label for="no_active" class="custom-control-label">Không</label>
            </div>
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