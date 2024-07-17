@extends('main')

@section('content')
<div class="container p-t-80">
    <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
        <a href="/index" class="stext-109 cl8 hov-cl1 trans-04">
            Trang chủ
            <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
        </a>

        <a href="/danh-muc/{{$products->menu->id}}-{{Str::slug($products->menu->name)}}.html"
            class="stext-109 cl8 hov-cl1 trans-04">
            {{$products->menu->name}}
            <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
        </a>

        <span class="stext-109 cl4">
            {{$title}}
        </span>
    </div>
</div>

<section class="sec-product-detail bg0 p-t-65 p-b-60">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-lg-7 p-b-30">
                <div class="p-l-25 p-r-30 p-lr-0-lg">
                    <div class="wrap-slick3 flex-sb flex-w">
                        <div class="wrap-slick3-dots">
                            <ul class="slick3-dots" role="tablist" style="">
                                <li class="slick-active" role="presentation"><img src="{{$products->file}}">
                                    <div class="slick3-dot-overlay"></div>
                                </li>
                                @foreach ($productImages as $productImage)
                                <li role="presentation"><img src="{{$productImage->file_1}}">
                                    <div class="slick3-dot-overlay"></div>
                                </li>
                                @endforeach

                            </ul>
                        </div>
                        <!-- <div class="wrap-slick3-arrows flex-sb-m flex-w"><button class="arrow-slick3 prev-slick3 slick-arrow" style=""><i class="fa fa-angle-left" aria-hidden="true"></i></button><button class="arrow-slick3 next-slick3 slick-arrow" style=""><i class="fa fa-angle-right" aria-hidden="true"></i></button></div> -->

                        <div class="slick3 gallery-lb slick-initialized slick-slider slick-dotted">
                            <div class="slick-list draggable">
                                <div class="slick-track" style="opacity: 1; width: 600px;">
                                    <div class="item-slick3 slick-slide slick-current slick-active" data-slick-index="0"
                                        aria-hidden="false" tabindex="0" role="tabpanel" id="slick-slide10"
                                        aria-describedby="slick-slide-control10"
                                        style="width: 600px; position: relative; left: 0px; top: 0px; z-index: 999; opacity: 1;">
                                        <section class="section-slide">
                                            <div class="wrap-slick1">
                                                <div class="slick1">
                                                    <div class="item-slick1 product-image"
                                                        style="background-image: url({{$products->file}});">
                                                    </div>
                                                    @foreach ($productImages as $productImage)
                                                    <div class="item-slick1 product-image"
                                                        style="background-image: url({{$productImage->file_1}});">
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </section>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-5 p-b-30">
                <div class="p-r-50 p-t-5 p-lr-0-lg">
                    <h4 class="mtext-105 cl2 js-name-detail p-b-14">
                        {{$products->name}}
                    </h4>

                    <span class="mtext-106 cl2">
                        {!! number_format(\App\Helpers\Helper::price($products->price, $products->price_sale)) !!} VNĐ
                    </span>

                    <p class="stext-102 cl3 p-t-23">
                        {!! $products->description !!}
                    </p>

                    <!--  -->
                    <div class="p-t-33">
                        <div class="flex-w flex-r-m p-b-10">
                            <div class="size-203 flex-c-m respon6">
                                Size
                            </div>

                            <div class="size-204 respon6-next">
                                <form action="{{route('addcart')}}" method="post">
                                    @if($products !== null)
                                    <div class="rs1-select2 bor8 bg0">
                                        <select class="js-select2 select2-hidden-accessible" type="number" name="size"
                                            tabindex="-1" aria-hidden="true">
                                            <option>Chọn Size</option>
                                            @foreach ($productAttributes as $productAttribute)
                                            <option value="{{$productAttribute->size}}">{{$productAttribute->size}}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div class="dropDownSelect2"></div>
                                    </div>
                            </div>
                        </div>




                        <div class="flex-w flex-r-m p-b-10">
                            <div class="size-204 flex-w flex-m respon6-next">
                                <div class="wrap-num-product flex-w m-r-20 m-tb-10">
                                    <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                        <i class="fs-16 zmdi zmdi-minus"></i>
                                    </div>

                                    <input class="mtext-104 cl3 txt-center num-product" type="number" name="num_product"
                                        value="1">

                                    <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                        <i class="fs-16 zmdi zmdi-plus"></i>
                                    </div>
                                </div>
                                <button
                                    class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail">
                                    Thêm vào giỏ hàng
                                </button>
                                <input type="hidden" name="product_id" value="{{$products->id}}">
                                @endif
                                @csrf
                                </form>
                            </div>
                        </div>
                    </div>




                    <!--  -->
                </div>
            </div>
        </div>

        <div class="bor10 m-t-50 p-t-43 p-b-40">
            <!-- Tab01 -->
            <div class="tab01">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item p-b-10">
                        <a class="nav-link active" data-toggle="tab" href="#description" role="tab"
                            aria-expanded="true">thông tin sản phẩm</a>
                    </li>

                    <!-- <li class="nav-item p-b-10">
                        <a class="nav-link" data-toggle="tab" href="#information" role="tab" aria-expanded="false">Thông
                            tin</a>
                    </li> -->

                    <li class="nav-item p-b-10">
                        <a class="nav-link" data-toggle="tab" href="#reviews" role="tab" aria-expanded="false">Đánh
                            giá</a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content p-t-43">
                    <!-- - -->
                    <div class="tab-pane fade active show" id="description" role="tabpanel" aria-expanded="true">
                        <div class="how-pos2 p-lr-15-md">
                            <p class="stext-102 cl6" style="font-size: 12px">
                                {!!$products->content!!}
                            </p>
                        </div>
                    </div>

                    <!-- - -->


                    <div class="tab-pane fade" id="reviews" role="tabpanel" aria-expanded="false">
                        <div class="row">
                            <div class="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
                                <div class="p-b-20 m-lr-15-sm">
                                    <!-- Review -->
                                    @foreach ($reviews as $review)
                                    <div class="flex-w flex-t p-b-50">
                                        <div class="wrap-pic-s size-109 bor0 of-hidden m-r-18 m-t-6">
                                            <img src="{{$review->user->file}}"
                                                style=" height: 60px; width:60px; border-radius:50%; border: 1px solid black"
                                                alt="">
                                        </div>

                                        <div class="size-207">
                                            <div class="flex-w flex-sb-m p-b-5">
                                                <span class="mtext-107 cl2 p-r-20">
                                                    {{$review->user->name}}
                                                </span>

                                                <span class="fs-18 cl11">

                                                    @for($i = 0; $i < $review->star; $i++)
                                                        <i class="zmdi zmdi-star"></i>
                                                        @endfor
                                                </span>
                                            </div>

                                            <p class="stext-102 cl6">
                                                {{$review->review}}
                                            </p>
                                        </div>
                                    </div>
                                    @endforeach

                                    <!-- Add review -->
                                    <form method="post" action="/review/{{$products->id}}">
                                        <div class="flex-w flex-m p-t-50 p-b-23">
                                            <span class="stext-102 cl3 m-r-16">
                                                Số sao đánh giá
                                            </span>

                                            <span class="wrap-rating fs-18 cl11 pointer">
                                                <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                                                <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                                                <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                                                <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                                                <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                                                <input class="dis-none" type="number" name="star">
                                            </span>
                                        </div>

                                        <div class="row p-b-25">
                                            <div class="col-12 p-b-5">
                                                <label class="stext-102 cl3" for="review">Đánh giá của bạn</label>
                                                <textarea class="size-110 bor8 stext-102 cl2 p-lr-20 p-tb-10"
                                                    id="review" name="review"></textarea>
                                            </div>

                                            <!-- <div class="col-sm-6 p-b-5">
                                                <label class="stext-102 cl3" for="name">Name</label>
                                                <input class="size-111 bor8 stext-102 cl2 p-lr-20" id="name" type="text"
                                                    name="name">
                                            </div>

                                            <div class="col-sm-6 p-b-5">
                                                <label class="stext-102 cl3" for="email">Email</label>
                                                <input class="size-111 bor8 stext-102 cl2 p-lr-20" id="email"
                                                    type="text" name="email">
                                            </div> -->
                                        </div>

                                        <button type="submit"
                                            class="flex-c-m stext-101 cl0 size-112 bg7 bor11 hov-btn3 p-lr-15 trans-04 m-b-10">
                                            Đánh giá sản phẩm
                                        </button>
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bg6 flex-c-m flex-w size-302 m-t-73 p-tb-15">
        <span class="stext-107 cl6 p-lr-25">
            Categories: {{$products->menu->name}}
        </span>
    </div>
</section>


@endsection