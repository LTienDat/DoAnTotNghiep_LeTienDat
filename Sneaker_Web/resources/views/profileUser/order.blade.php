@extends('main')

@section('content')

<div class="card card-primary card-outline profile-order m-t-150 w-60%">
    <div class="card-body box-profile">
    <table class="table">
        <thead>
            <tr>
                <th>STT</th>
                <th>Tên sản phẩm</th>
                <th>Ảnh sản phẩm</th>
                <th>Size</th>
                <th>Số lượng</th>
                <th>Giá</th>
                <th>Phương thức thanh toán</th>
                <th>Ngày giờ đặt hàng</th>
                <th>Trạng thái đơn hàng</th>
            </tr>
        </thead>
        <tbody>
            <?php $index = 0;?>
            @foreach ( $customers as $key => $customer )
            <tr>
                <?php $index++?>
                <td>{{$index}}</td>
                <td class="product">
                    <div class="dropdown">
                        <button class="btn  dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            sản phẩm
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        @foreach ($carts as $cart)
                            <span class="dropdown-item">Actionsdddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd</span>
                            @endforeach
                        </div>
                    </div>
                </td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>{{$cart->payment == 0 ? "Thanh toán khi nhận hàng" : "Thanh toán online"}}</td>
                <td>{{$cart->created_at}}</td>
                <td>{{$cart->status}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>

</div>
@endsection