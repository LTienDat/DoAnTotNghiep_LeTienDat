@extends('admin.main')

@section('content')
<form action="{{ route('searchProduct') }}" method="post" style="display:flex">
    @csrf
    <input type="text" name="query" class="col-md-4 form-control" placeholder="Tìm kiếm" required>
    <button type="submit"><i class="fas fa-search fa-fw"></i></button>
</form>

    <table class="table">
        <thead>
            <tr>
                <th style="width:50px">ID:</th>
                <th>Tên Sản phẩm</th>
                <th>Danh mục</th>
                <th>Ảnh sản phẩm</th>
                <th>Giá gốc</th>
                <th>Giá khuyến mãi</th>
                <th>Hoạt động</th>
                <th>Cập nhật</th>
                <th style="width=5px">Sửa|Xóa</th>
            </tr>
        </thead>
        <tbody>
            @foreach ( $products as $key => $product )
            <tr>
                <td>{{$product->id}}</td>
                <td>{{$product->name}}</td>
                <td>{{optional($product->menu)->name}}</td>
                <th><a href="{{$product->file}}" target="_blank"><img src="{{$product->file}}" height="50px"></a></th>
                <td>{{$product->price}}</td>
                <td>{{$product->price_sale}}</td>
                <td>{!! \App\Helpers\Helper::active($product->active) !!}</td>
                <td>{{$product->updated_at}}</td>
                <td>
                    <a class="btn btn-primary btn-sm" href="/admin/product/edit/{{$product->id}}"><i class="fas fa-edit"></i></a>
                    <a class="btn btn-danger btn-sm" href="#"
                    onclick="removeRow({{$product->id}},'/admin/product/destroy')">
                    <i class="fas fa-trash"></i></a>
                </td>             
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="card-footer clearfix">
            {{ $products->links('pagination::bootstrap-4') }}
	</div>

    
@endsection