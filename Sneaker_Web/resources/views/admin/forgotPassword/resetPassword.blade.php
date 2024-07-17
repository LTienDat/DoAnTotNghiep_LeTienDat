<!DOCTYPE html>
<html lang="en">
@include('admin.head')
<body class="login-page" style="min-height: 386.781px;">
<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html"><b>Cài lại mật khẩu</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">
      Bạn chỉ còn một bước nữa là có được mật khẩu mới, hãy khôi phục mật khẩu ngay bây giờ.</p>

      <form action="" method="post">
        @csrf
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Mật khẩu mới">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="confirm_password" class="form-control" placeholder="Xác nhận mật khẩu mới">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Cập nhật mật khẩu</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mt-3 mb-1">
        <a href="/login">Đăng nhập</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->
</body>

</html>