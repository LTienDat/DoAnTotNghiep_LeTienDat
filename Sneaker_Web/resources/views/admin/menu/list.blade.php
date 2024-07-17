@extends('admin.main')

@section('content')
<form action="{{ route('searchMenu') }}" method="post" style="display:flex">
    @csrf
    <input type="text" name="query" class="col-md-4 form-control" placeholder="Tìm kiếm" required>
    <button type="submit"><i class="fas fa-search fa-fw"></i></button>
</form>
    <table class="table">
        <thead>
            <tr>
                <th style="width:50px">ID:</th>
                <th>Tên</th>
                <th>Ảnh danh mục</th>
                <th>Hoạt động</th>
                <th>Cập nhật</th>
                <th style="width=5px">Sửa|Xóa</th>
            </tr>
        </thead>
        <tbody>
            {!!\app\Helpers\Helper::menu($menus)!!}
        </tbody>
    </table>
@endsection