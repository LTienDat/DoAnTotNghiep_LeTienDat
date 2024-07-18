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
                    <th>Tổng tiền( + ship)</th>
                    <th>Phương thức thanh toán</th>
                    <th>Ngày giờ đặt hàng</th>
                    <th>Trạng thái đơn hàng</th>
                </tr>
            </thead>
            <tbody>
                
                @foreach ($customers as $index => $customer)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        @if ($customerIdCounts[$customer->id] >= 2)
                        <?php $totalPrice = 0?>
                            <td colspan="5">
                                <div class="dropdown">
                                    <button style="width: 450px;" class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Sản phẩm
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <div class="dropdown-item">
                                            <div>
                                                <span style="margin-right:215px; font-weight: bold;">Tên sản phẩm</span>
                                                <span style="margin-right:20px; font-weight: bold;">Ảnh sản phẩm</span>
                                                <span style="margin-right:20px; font-weight: bold;">Size</span>
                                                <span style="margin-right:30px; font-weight: bold;">Số lượng</span>
                                                <span style="margin-right:5px; font-weight: bold;">Giá</span>
                                                <?php $totalPrice +=  $cart->price?>
                                            </div>
                                            <hr>
                                            
                                            @foreach ($carts->where('customer_id', $customer->id) as $cart)
                                                <div style="margin-bottom: 10px">
                                                    <span style="display: inline-block; width: 200px; margin-right: 130px;">{{ $cart->product->name }}</span>
                                                    <span style="margin-right: 50px;"><img style="width: 65px; height:65px;" src="{{ $cart->product->file }}" alt=""></span>
                                                    <span style="margin-right: 50px;">{{ $cart->size }}</span>
                                                    <span style="margin-right: 50px;">{{ $cart->quantity }}</span>
                                                    <span>{{ $cart->price }}</span>
                                                    <?php $totalPrice +=  $cart->price ?>
                                                </div>
                                                <hr>
                                            @endforeach
                                            </div>
                                    </div>
                                    <span style="margin-left: 222px">{{number_format($totalPrice +30000) }} VNĐ</span>
                                    <?php $totalPrice = 0?>
                                </div>
                            </td>
                        @else
                            @foreach ($carts->where('customer_id', $customer->id) as $cart)
                                <td>{{ $cart->product->name }}</td>
                                <td><img style="width: 65px; height:65px" src="{{ $cart->product->file }}" alt=""></td>
                                <td>{{ $cart->size }}</td>
                                <td>{{ $cart->quantity }}</td>
                                <td>{{ number_format($cart->price + 30000)}} VNĐ</td>
                            @endforeach
                        @endif
                        <td>{{ $customer->payment == 0 ? 'Thanh toán khi nhận hàng' : 'Thanh toán online' }}</td>
                        <td>{{ $customer->created_at }}</td>
                        <td>{{ $customer->status_order }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div style="margin-bottom:50px"></div>
@endsection


