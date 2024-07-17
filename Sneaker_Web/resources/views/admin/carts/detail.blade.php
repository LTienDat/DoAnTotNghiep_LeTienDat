@extends('admin.main')

@section('content')

<div class="customer mt-3">
    <div style="display: flex;">
        <ul>
            <li>Tên khách hàng: <strong>{{$customers->name}}</strong></li>
            <li>Số điện thoại: <strong>{{$customers->phone}}</strong></li>
            <li>Email: <strong>{{$customers->email}}</strong></li>
            <li>Địa chỉ: <strong>{{$customers->address}}</strong></li>
            <li>Ghi chú: <strong>{{$customers->note}}</strong></li>
        </ul>
        <div style="margin-left:40%">
            <input type="hidden" id="customer_id" value="{{$customers->id}}">
            <select class="form-control" name="status" id="statusOrder">
                    <option value=""></option>
                    <hr>
                    <option value="chờ xác nhận" {{ $customers->status_order == 'chờ xác nhận' ? 'selected' : '' }}>chờ xác nhận</option>
                    <option value="đã xác nhận" {{ $customers->status_order == 'đã xác nhận' ? 'selected' : '' }}>đã xác nhận</option>
                    <option value="đang vận chuyển" {{ $customers->status_order == 'đang vận chuyển' ? 'selected' : '' }}>đang vận chuyển</option>
                    <option value="đã giao hàng" {{ $customers->status_order == 'đã giao hàng' ? 'selected' : '' }}>đã giao hàng</option>
            </select>
            <span style="margin-top: 10px;" class="column-4">{{$customers->payment == 0 ? "Phước thức thanh toán: Thanh toán khi nhận hàng" : "Phước thức thanh toán: Thanh toán VNP"}}</span><br>
            <span style="margin-top: 10px;" class="column-4">Tổng tiền: {{number_format($total)}} VNĐ</span>
        </div>
    </div>
</div>

<div class="carts">
    <?php $total = 0?>
    @if(isset($customers) && !is_null($customers))
    <table class="table">
        <tbody>
            <tr class="table_head">
                <th class="column-1">Tên sản phẩm</th>
                <th class="column-2">Ảnh sản phẩm</th>
                <th class="column-2">Size</th>
                <th class="column-2">Màu</th>
                <th class="column-3">Số lượng</th>
                <th class="column-4">Giá</th>
                <th class="column-6"></th>
            </tr>

            @foreach ($carts as $cart)
            <tr class="table_row">
                <td class="column-1">{{$cart->product->name}}</td> 
                <td class="column-2">
                    <div class="how-itemcart1">
                        <img src="{{$cart->product->file}}" width="50px" alt="IMG">
                    </div>
                </td>
                <td class="column-3">{{$cart->size}}</td>
                <td class="column-3">{{$cart->color}}</td>
                <td class="column-3">{{$cart->quantity}}</td>
                <td class="column-4">{{number_format($cart->price)}}</td>
                <td><a class="btn btn-danger btn-sm" href="#"
                    onclick="removeRow({{$cart->id}},'/admin/order_product/destroy')">
                    <i class="fas fa-trash"></i></a></td>
                    <!-- <form action="/admin/order_product/destroy" method="POST" class="delete-form">
                        <input type="hidden" name="product_id" value="{{$cart->id}}">
                        <input type="hidden" name="customer_id" value="{{$customers->id}}">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này khỏi giỏ hàng')" class="btn btn-danger delete-button"><i class="fas fa-trash"></i></a></button>
            </form> -->
            </tr>
            <?php $total += $cart->price * $cart->quantity?>
            @endforeach
        </tbody>
    </table>
    @endif

</div>
<script>
        $(document).ready(function() {
            $('.delete-button').on('click', function(e) {
                e.preventDefault(); // Ngăn chặn form được submit ngay lập tức

                var form = $(this).closest('form');
                var confirmed = confirm('Bạn có chắc chắn muốn xóa sản pha này không?');

                if (confirmed) {
                    form.submit(); // Nếu người dùng xác nhận, submit form
                }
            });
        });
    </script>


@endsection