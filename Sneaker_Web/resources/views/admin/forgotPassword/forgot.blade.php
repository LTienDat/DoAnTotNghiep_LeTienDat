<!DOCTYPE html>
<html lang="en">
@include('admin.head')
<body class="login-page" style="min-height: 332.781px;">
<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html"><b>Quên mật khẩu</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">
      Bạn quên mật khẩu? Tại đây bạn có thể dễ dàng lấy lại mật khẩu mới.</p>

      <form action="/resetPassword" method="get">
        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Cài lại mật khẩu mới</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <div style="display:flex">
        <p class="mt-3 mb-1">
          <a href="/login">Đăng nhập</a>
        </p>
        <p style="margin-left: 180px; margin-top:15px">
          <a href="adminregister" class="text-center">Đăng ký</a>
        </p>
      </div>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->




</body>

</html>