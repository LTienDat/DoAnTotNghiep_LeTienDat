@extends('main')

@section('content')
<div class="card card-primary card-outline card-profile m-t-150 w-60%">
    <div class="card-body box-profile">
        <div class="text-center">
            <img class="profile-user-img img-fluid img-circle profile-img" src="{{auth()->user()->file}}"
                alt="User profile picture">
        </div>
        <h3 class="profile-username text-center">{{auth()->user()->name}}</h3>
        <!-- <p class="text-muted text-center">Software Engineer</p> -->
        <form action="" method="post">
            @csrf
            <ul class="list-group list-group-unbordered mb-3">
                <li class="m-t-15">
                    <label  class="m-b-0" for="">Tên</label>
                    <input type="text" name="name" class="form-control" value="{{auth()->user()->name}}">
                </li>
                <li class="m-t-15">
                    <label  class="m-b-0">Email</label>
                    <input type="text" name="email" class="form-control" value="{{auth()->user()->email}}">
                </li>
                <!-- <li class="m-t-15">
                    <label  class="m-b-0">Mật khẩu</label>
                    <input type="password" name="password" class="form-control" value="{{auth()->user()->password}}">
                </li> -->
                <li class="m-t-15"> 
                    <div class="form-group">
                        <label  class="m-b-0">Ảnh sản phẩm</label>
                        <input type="file" id="uploadU" class="form-control">
                        <div id="image_show"></div>
                        <input type="hidden" name="file"  id="file" value="">
                    </div>
                </li>
            </ul>
            <div class="row">
                <button type="submit" class="btn btn-primary btn-block col-md-4 m-l-20"><b>Cập nhật</b></button>
                <a href="/changePassword" style="color: white; align-items: center; " class="btn btn-primary btn-block col-md-4 p-t-5 m-l-180" ><b>Đổi mật khẩu</b></a>          
            </div>
        </form>
    </div>

</div>
@endsection