@extends('admin.main')

@section('content')
    
    <h1>{{$title}}</h1>

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
            @if(isset($searchs))
            @foreach ( $searchs as $key => $search )
            <tr>
                <td>{{$search->id}}</td>
                <td>{{$search->name}}</td>
                <td>{{optional($search->menu)->name}}</td>
                <th><a href="{{$search->file}}" target="_blank"><img src="{{$search->file}}" height="50px"></a></th>
                <td>{{$search->price}}</td>
                <td>{{$search->price_sale}}</td>
                <td>{!! \App\Helpers\Helper::active($search->active) !!}</td>
                <td>{{$search->updated_at}}</td>
                <td>
                    <a class="btn btn-primary btn-sm" href="/admin/product/edit/{{$search->id}}"><i class="fas fa-edit"></i></a>
                    <a class="btn btn-danger btn-sm" href="#"
                    onclick="removeRow({{$search->id}},'/admin/product/destroy')">
                    <i class="fas fa-trash"></i></a>
                </td>             
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>


@endsection
