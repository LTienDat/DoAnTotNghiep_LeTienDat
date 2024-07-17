@extends('main')

@section('content')
<form class="bg0 p-t-75 p-b-85" action="/carts" method="post">
    <div class="container">
        <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
            <a href="/index" class="stext-109 cl8 hov-cl1 trans-04">
                Trang chủ
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <span class="stext-109 cl4">
                Giỏ hàng
            </span>
        </div>
        <div class="row">
            <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
                <div class="m-l--60 m-r-60 m-lr-0-xl">
                    <?php $total = 0;?>
                    <div class="wrap-table-shopping-cart">

                        @if(count($products) != 0)
                        <table class="table-shopping-cart">
                            <tbody>
                                <tr class="table_head">
                                    <th class="column-1">Sản phẩm</th>
                                    <th class="column-2"> Tên Sản phẩm</th>
                                    <th class="column-2">Size</th>
                                    <th class="column-3">Màu</th>
                                    <th class="column-4">Giá</th>
                                    <th class="column-5">Số lượng</th>
                                    <th class="column-6">Total</th>
                                    <th class="column-7"></th>
                                </tr>
                                
                                @foreach ($products as $product)
                                @foreach ($keycarts as $keycart)
                                @if($product->id == intval(subStr(strval($keycart), 0, -2)))
                                <tr class="table_row">
                                    <td class="column-1">
                                        <div class="how-itemcart1">
                                            <a href="{{$product->file}}" target="_blank"><img src="{{$product->file}}" alt="IMG"></a>
                                        </div>
                                    </td>
                                    <td class="column-2">{{$product->name}}</td>

                                    <td class="column-2">{{$carts[$keycart]['size']}}</td>
                                    <td class="column-3">{{$carts[$keycart]['color']}}</td>
                                    <td class="column-4">{{number_format($product->price)}}</td>
                                    <td class="column-5">
                                        <div class="wrap-num-product flex-w m-l-auto m-r-0">
                                            <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                                <i class="fs-16 zmdi zmdi-minus"></i>
                                            </div>

                                            <input class="mtext-104 cl3 txt-center num-product" type="number" min="1"
                                                name="num_product" value="{{$carts[$keycart]['num_product']}}">

                                            <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                                <i class="fs-16 zmdi zmdi-plus"></i>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="column-6 subtotal"
                                        data-price="{{$product->price * $carts[$keycart]['num_product']}}">
                                        {{number_format($product->price * $carts[$keycart]['num_product'])}}</td>
                                    <td class="p-r-15"><a class="m-l-10" href="/carts/delete/{{$keycart}}">
                                        <i class="fas fa-trash"></i></a>
                                        </a></td>
                                </tr>
                                <?php $total += $product->price * $carts[$keycart]['num_product']?>
                                @endif
                                @endforeach
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <div class="text-center">
                            <h2>Giỏ hàng trống</h2>
                        </div>
                        @endif
                    </div>

                    <div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">
                        <div class="flex-w flex-m m-r-20 m-tb-5">
                            <input type="submit" value="Cập nhật giỏ hàng" formaction="/update-cart"
                                class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10">

                            <a href="/pay" value="Thanh toán"
                                class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10"
                                style="margin-left:330px;">Thanh toán</a>
                        </div>
                        @csrf

                    </div>
                </div>
            </div>
        </div>
    </div>
</form>


</form>
@endsection