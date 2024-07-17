@extends('admin.main')

@section('content')
<table class="table">
    <thead>
        <tr>
            <th>Tên sản phẩm</th>
            <th>Ảnh sản phẩm</th>
            <th>Size</th>
            <th>Màu</th>
            <th>Số lượng</th>
            <th>Giá nhập</th>
            <th>Sửa|Xóa</th>
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ( $warehouseDetails as $key => $warehouseDetail )
        <tr>
            @if($warehouseDetail->product)
            <td>{{$warehouseDetail->product->name}}</td>
            <th><a href="{{$warehouseDetail->product->file}}" target="_blank"><img src="{{$warehouseDetail->product->file}}"
                        height="50px"></a></th>
            @endif
            <td>{{$warehouseDetail->size}}</td>
            <td>{{$warehouseDetail->color}}</td>
            <td>{{$warehouseDetail->quantity}}</td>
            <td>{{number_format($warehouseDetail->import_price)}}</td>
            <td>
                <a class="btn btn-primary btn-sm" href="/admin/warehouse/edit/{{$warehouseDetail->id}}"><i
                        class="fas fa-edit"></i></a>
                <a class="btn btn-danger btn-sm" href="#"
                    onclick="removeRow({{$warehouseDetail->id}},'/admin/warehouse/destroyDetail')">
                    <i class="fas fa-trash"></i></a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>




@endsection