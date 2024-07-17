@extends('admin.main')

@section('content')
<form action="{{ route('searchAccount') }}" method="post" style="display:flex">
    @csrf
    <input type="text" name="query" class="col-md-4 form-control" placeholder="Tìm kiếm" required>
    <button type="submit"><i class="fas fa-search"></i></button>
</form>
    <table class="table">
        <thead>
            <tr>
                <th style="width:50px">ID:</th>
                <th>Tên khách hàng</th>
                <th>Email</th>
                <th>Mật khẩu</th>
                <th>Cấp độ</th>
                <th>Hoạt động</th>
                <th>Ngày tạo tài khoản</th>
                <th style="width=5px">Sửa|Xóa</th>
            </tr>
        </thead>
        <tbody>
            @foreach ( $users as $key => $user )
            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->password}}</td>
                <td>{{$user->level}}</td>
                <td >{!! \App\Helpers\Helper::active($user->active) !!}</td>
                <td>{{$user->updated_at}}</td>
                <td>
                    <a class="btn btn-primary btn-sm" href="/admin/account/edit/{{$user->id}}"><i class="fas fa-edit"></i></a>
                    <a class="btn btn-danger btn-sm" href="#"
                    onclick="removeRow({{$user->id}},'/admin/account/destroy')">
                    <i class="fas fa-trash"></i></a>
                </td>             
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="card-footer clearfix">
            {{ $users->links('pagination::bootstrap-4') }}
	</div>

    
@endsection