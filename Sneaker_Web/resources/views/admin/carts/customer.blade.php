@extends('admin.main')

@section('content')
<form action="{{ route('searchOrder') }}" method="post" style="display:flex">
    @csrf
    <input type="text" name="query" class="col-md-4 form-control" placeholder="Tìm kiếm" required>
    <button type="submit"><i class="fas fa-search"></i></button>
</form>
    <table class="table">
        <thead>
            <tr>
                <!-- <th style="width:50px">ID Đơn hàng:</th> -->
                <th style="width:50px">ID:</th>
                <th>Tên Khách hàng</th>
                <th>Số điện thoại</th>
                <th>email</th>
                <th>Ngày đặt hàng</th>
                <th style="width=5px">Sửa|Xóa</th>
            </tr>
        </thead>
        <tbody>
            @foreach ( $customers as $key => $customer )
            <tr>
                
  
                <td>{{$customer->id}}</td>
                <td>{{$customer->name}}</td>
                <td>{{$customer->phone}}</td>
                <th>{{$customer->email}}</a></th>
                <td>{{$customer->updated_at}}</td>
                <td>
                    <a class="btn btn-primary btn-sm" href="/admin/customer/view/{{$customer->id}}"><i class="fas fa-eye"></i></a>
                    <a class="btn btn-danger btn-sm" href="#"
                    onclick="removeRow({{$customer->id}},'/admin/customer/destroy')">
                    <i class="fas fa-trash"></i></a>
                </td>             
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="card-footer clearfix">
            {{ $customers->links('pagination::bootstrap-4') }}
	</div>

    
@endsection