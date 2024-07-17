@extends('admin.main')

@section('content')
<form action="{{ route('searchSupplier') }}" method="post" style="display:flex">
    @csrf
    <input type="text" name="query" class="col-md-4 form-control" placeholder="Tìm kiếm" required>
    <button type="submit"><i class="fas fa-search"></i></button>
</form>
    <table class="table">
        <thead>
            <tr>
                <th style="width:50px">ID:</th>
                <th>Tên nhà cung cấp</th>
                <th>Email</th>
                <th>số điện thoại</th>
                <th>Địa chỉ</th>
                <th style="width=5px">Sửa|Xóa</th>
            </tr>
        </thead>
        <tbody>
            @foreach ( $suppliers as $key => $supplier )
            <tr>
                <td>{{$supplier->id}}</td>
                <td>{{$supplier->name}}</td>
                <td>{{$supplier->email}}</td>
                <td>{{$supplier->phone}}</td>
                <td>{{$supplier->address}}</td>

                <td>
                    <a class="btn btn-primary btn-sm" href="/admin/supplier/edit/{{$supplier->id}}"><i class="fas fa-edit"></i></a>
                    <a class="btn btn-danger btn-sm" href="#"
                    onclick="removeRow({{$supplier->id}},'/admin/supplier/destroy')">
                    <i class="fas fa-trash"></i></a>
                </td>             
            </tr>
            @endforeach
        </tbody>
    </table>



    
@endsection