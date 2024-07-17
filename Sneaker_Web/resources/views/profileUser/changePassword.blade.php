@extends('main')

@section('content')
<div class="card card-primary card-outline card-profile m-t-150 w-60%">
    <div class="card-body box-profile">
        <form action="" method="post">
            @csrf
            <ul class="list-group list-group-unbordered mb-3">
                <li class="m-t-15">
                    <label  class="m-b-0" for="">Mật khẩu hiện tại</label>
                    <input type="password" name="password" class="form-control" value="">
                </li>
                <li class="m-t-15">
                    <label  class="m-b-0">Mật khẩu mới</label>
                    <input type="password" name="new_password" class="form-control" value="">
                </li>
                <li class="m-t-15">
                    <label  class="m-b-0">Xác nhận mật khẩu mới</label>
                    <input type="password" name="confirm_new_password" class="form-control" value="">
                </li>
            </ul>
            <div class="row">
                <button type="submit" class="btn btn-primary btn-block"><b>Đổi mật khẩu</b></button>          
            </div>
        </form>
    </div>

</div>
@endsection