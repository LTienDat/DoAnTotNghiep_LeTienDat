@extends('main')

@section('content')
<form class="bg0 p-t-75 p-b-85" action="/pay" method="get">
    <div class="container">
        <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
            <h1>Thông tin giao dịch</h1>
        </div>
        <div class="row m-t-30">
            <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
                <div class="m-l--60 m-r-60 m-lr-0-xl">
                    <div class="wrap-table-shopping-cart">
                        <div class="form-group">
                            <label for="">Mã đơn hàng: {{$infoPayment->order_id}}</label>
                        </div>
                        <div class="form-group">
                            <label for="">Mã Giao dịch VNP: {{$infoPayment->code_vnpay}}</label>
                        </div>
                        <div class="form-group">
                            <label for="">Ngân hàng: {{$infoPayment->code_bank}}</label>
                        </div>
                        <div class="form-group">
                            <label for="">Gía tiền: {{$infoPayment->price}}</label>
                        </div>
                        <div class="form-group">
                            <label for="">Ghi chú giao dịch: {{$infoPayment->note}}</label>
                        </div>
                        <div class="form-group">
                            <label for="">Thời gian giao dịch: {{$infoPayment->created_at}}</label>
                        </div>
                        <div class="form-group">
                            <label for="">Giao dịch thành công</label>
                        </div>
                        <button type="submit" value="Đặt hàng" 
                                class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10"> Quay lại</button>
                            @csrf
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>


</form>
@endsection