@extends('admin.main')
@section('head')
<script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
@endsection
@section('content')

<form action="" method="post">
    <div class="card-body">
        <div class="form-group">
            <label for="menu">Tên Khách hàng</label>
            <input type="text" name="name" value="{{$users->name}}" class="form-control" id=""
                placeholder="Nhập tên khách hàng">
        </div>
        <div class="form-group">
            <label for="menu">Email</label>
            <input name="email" id="" class="form-control" value="{{$users->email}}" disabled></input>
        </div>
        <div class="form-group">
            <label for="menu">Mật khẩu</label>
            <input name="password" class="form-control" value="{{$users->password}}" disabled></input>
        </div>

        <div class="form-group">
            <label for="menu">Cấp độ</label>
            <select class="form-control" name="level" id="parent_id">
                <option value="USER" {{ $users->level === 'USER' ? 'selected' : '' }}>USER</option>
                <option value="ADMIN" {{ $users->level === 'ADMIN' ? 'selected' : '' }}>ADMIN</option>
            </select>
        </div>

        <div class="form-group">
            <label for="">Kích hoạt</label>
            <div class="custom-control custom-radio">
                <input class="custom-control-input" type="radio" id="active" name="active" value="1"
                    {{$users->active == 1 ? 'checked=""' : ''}}
                >
                <label for="active" class="custom-control-label">Có</label>
            </div>
            <div class="custom-control custom-radio">
                <input class="custom-control-input" type="radio" id="no_active" name="active" value="0"
                {{$users->active == 0 ? 'checked=""' : ''}}
                >
                <label for="no_active" class="custom-control-label">Không</label>
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Cập nhật tài khoản</button>
        </div>
        @csrf
</form>
@endsection

@section('footer')
<script>
CKEDITOR.replace('editor')
</script>
@endsection