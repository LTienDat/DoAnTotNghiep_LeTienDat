<!-- jQuery -->
<script src="/template/admin/plugins/jquery/jquery.min.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap 4 -->
<script src="/template/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="/template/admin/dist/js/adminlte.min.js"></script>

<script src="/template/admin/js/main.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
  
<script>
    $(document).ready(function(){
        $('#datepicker').datepicker({
            format: 'yyyy-mm-dd', // Định dạng ngày tháng (VD: 2024-06-24)
            autoclose: true, // Tự động đóng datepicker sau khi chọn ngày
            todayHighlight: true // Làm nổi bật ngày hiện tại
        });
    });

    $(document).ready(function(){
        $('#datepicker2').datepicker({
            format: 'yyyy-mm-dd', // Định dạng ngày tháng (VD: 2024-06-24)
            autoclose: true, // Tự động đóng datepicker sau khi chọn ngày
            todayHighlight: true // Làm nổi bật ngày hiện tại
        });
    });
</script>


@yield('footer')
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
$(document).ready(function() {
    $('#productName').change(function() {
        var productId = $(this).val();
        $('#productId').val(productId);
    });
});
</script>
<script>
$(document).ready(function() {
    $('#supplierName').change(function() {
        var productId = $(this).val();
        $('#supplierId').val(productId);
    });
});

</script>