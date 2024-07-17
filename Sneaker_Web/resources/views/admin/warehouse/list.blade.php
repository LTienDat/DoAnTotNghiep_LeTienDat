@extends('admin.main')

@section('content')
<form action="{{ route('searchWarehouse') }}" method="post" style="display:flex">
    @csrf
    <input type="text" name="query" class="col-md-4 form-control" placeholder="Tìm kiếm" required>
    <button type="submit"><i class="fas fa-search"></i></button>
</form>
<table class="table">
    <thead>
        <tr>
            <th style="width:50px">ID kho hàng:</th>
            <th style="width:50px">ID Sản phẩm:</th>
            <th>Tên sản phẩm</th>
            <th>Ảnh sản phẩm</th>
            <th style="width:20px">Cho tiết|Xóa</th>
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ( $warehouses as $key => $warehouse )
        <tr>
            <td>{{$warehouse->id}}</td>
            @if($warehouse->product)
            <td>{{$warehouse->product->id}}</td>
            <td>{{$warehouse->product->name}}</td>
            <th><a href="{{$warehouse->product->file}}" target="_blank"><img src="{{$warehouse->product->file}}"
                        height="50px"></a></th>
                        <td>
                            <a class="btn btn-primary btn-sm" href="/admin/warehouse/detail/{{$warehouse->product->id}}"><i
                            class="fas fa-eye"></i></a>
                            <a class="btn btn-danger btn-sm" href="#"
                            onclick="removeRow({{$warehouse->product->id}},'/admin/warehouse/destroy')">
                            <i class="fas fa-trash"></i></a>
                        </td>
            @endif
        </tr>
        @endforeach
    </tbody>
</table>




@endsection