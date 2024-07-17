@extends('admin.main')

@section('content')

<div class="row m-t-20">
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <p>Đơn hàng trong tháng</p>
                <h3>{{isset($sales) ? $sales->total_order : '0'}}</h3>

            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <!-- <a href="customer" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
                <p>Doanh thu</p>
                <h3>{{ isset($sales) ? number_format($sales->sales) . ' VNĐ' : '0 VNĐ' }}</h3>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
            <div class="inner">
                <p>Lợi nhuận</p>
                <h3>{{isset($sales) ? number_format($sales->profit). 'VNĐ' : "0 VNĐ"}}</h3>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
            <div class="inner">
                <p>số lượng bán được trong tháng</p>
                <h3>{{isset($sales) ? $sales->quantity : 0}}</h3>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
        </div>
    </div>
    <!-- ./col -->
</div>


<div class="row">
    <p class="Thống kê doanh số"></p>
    <form action="" class="statistical">
        @csrf
        <div class="col-md-4">
            <label>Từ ngày:</label> 
            <input style="width:200px" type="date" id="datepicker" name="datepicker" class="form-control">
            <input type="button" id="btn-dashboard-filter" class="btn btn-primary btn-sm" value="Lọc kết quả" >
        </div>
        <div class="col-md-4">
            <label>Đến ngày:</label> 
            <input style="width:200px" type="date" id="datepicker2" name="datepicker2" class="form-control">
        </div>
    </form>
    <div class="col-md-12">
        <div id="myfirstchart" style="height: 250px;"></div>
    </div>
</div>
@endsection