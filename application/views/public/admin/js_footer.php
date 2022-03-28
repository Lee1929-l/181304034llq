<!-- jQuery -->
<script src="<?php echo base_url(); ?>static/admin/plugins/jquery/jquery.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url(); ?>static/admin/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- tableExport -->
<script src="<?php echo base_url(); ?>static/admin/plugins/tableExport/tableExport.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
$.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url(); ?>static/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- boostrap-switch -->
<script src="<?php echo base_url(); ?>static/admin/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>

<!-- <script src="<?php echo base_url(); ?>static/admin/plugins/bootstrap/js/bootstrap.js"></script> -->
<!-- ChartJS -->
<script src="<?php echo base_url(); ?>static/admin/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="<?php echo base_url(); ?>static/admin/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<!--<script src="static/plugins/jqvmap/jquery.vmap.min.js"></script>-->
<!--<script src="static/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>-->
<!-- jQuery Knob Chart -->
<!--<script src="static/plugins/jquery-knob/jquery.knob.min.js"></script>-->
<!-- daterangepicker -->
<script src="<?php echo base_url(); ?>static/admin/plugins/moment/moment.min.js"></script>
<script src="<?php echo base_url(); ?>static/admin/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script
    src="<?php echo base_url(); ?>static/admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js">
</script>
<!-- Summernote -->
<script src="<?php echo base_url(); ?>static/admin/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?php echo base_url(); ?>static/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js">
</script>
<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>static/admin/dist/js/adminlte.js"></script>
<!--bootstrap_table-->
<script src="<?php echo base_url(); ?>static/admin/bootstrap_table/dist/bootstrap-table.min.js"></script>
<script src="<?php echo base_url(); ?>static/admin/bootstrap_table/dist/locale/bootstrap-table-zh-CN.js"></script>
<script src="<?php echo base_url(); ?>static/admin/bootstrap_table/src/extensions/export/bootstrap-table-export.js">
</script>

<!--<script src="--><?php //echo base_url();
                    ?>
<!--static/bootstrap_table1153/bootstrap-table.min.js"></script>-->

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!--<script src="static/dist/js/pages/dashboard.js"></script>-->
<!-- AdminLTE for demo purposes -->
<!--<script src="static/dist/js/demo.js"></script>-->

<!-- CodeMirror -->
<script src="<?php echo base_url(); ?>static/admin/plugins/codemirror/codemirror.js"></script>
<script src="<?php echo base_url(); ?>static/admin/plugins/codemirror/mode/css/css.js"></script>
<script src="<?php echo base_url(); ?>static/admin/plugins/codemirror/mode/xml/xml.js"></script>
<script src="<?php echo base_url(); ?>static/admin/plugins/codemirror/mode/htmlmixed/htmlmixed.js"></script>

<!--jq-cookie-->
<script src="<?php echo base_url() . 'static/admin/'; ?>dist/js/jquery.cookie.min.js"></script>

<!-- sweetalert2 -->
<script src="<?php echo base_url(); ?>static/admin/plugins/sweetalert2/sweetalert2.min.js"></script>

<!--Toastr-->
<script src="<?php echo base_url(); ?>static/admin/plugins/toastr/toastr.min.js"></script>
<!-- autocomplete -->
<script src="<?php echo base_url() . 'static/admin/'; ?>plugins/autocomplete/autocomplete.js"></script>
<!-- select2 -->
<script src="<?php echo base_url() . 'static/admin/'; ?>plugins/select2/select2.full.min.js"></script>
<script src="<?php echo base_url() . 'static/admin/'; ?>plugins/select2/select2.min.js"></script>
<!-- stepper -->
<script src="<?php echo base_url() . 'static/admin/'; ?>plugins/bs-stepper/js/bs-stepper.min.js"></script>

<!-- img-zoom -->
<script src="<?php echo base_url() . 'static/admin/'; ?>dist/js/newmap.js"></script>

<!-- Select -->
<script src="<?php echo base_url(); ?>static/admin/js/bootstrap-select.min.js"></script>
<script src="<?php echo base_url(); ?>static/admin/js/bootstrap-select.js"></script>

<script>
//建立一個可存取到该file的url  
function getObjectURL(file) {
    var url = null;
    if (window.createObjectURL != undefined) { // basic  
        url = window.createObjectURL(file);
    } else if (window.URL != undefined) { // mozilla(firefox)  
        url = window.URL.createObjectURL(file);
    } else if (window.webkitURL != undefined) { // webkit or chrome  
        url = window.webkitURL.createObjectURL(file);
    }
    return url;
}

function getCookie(name) {
    var arr = document.cookie.match(new RegExp("(^| )" + name + "=([^;]*)(;|$)"));
    if (arr != null) return unescape(arr[2]);
    return null;
}

function check_telephone(phone_number) {
    // var phone_reg = /(^1[3|4|5|7|8]\d{9}$)|(^09\d{8}$)/;
    // if (!phone_reg.test(phone_number)) {
    //     return false;
    // }
    return true;
}

function check_email(email) {
    var reg = /^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/;
    if (!reg.test(email)) {
        return false;
    }
    return true;
}

function check_id_number(value) {
    var arrExp = [7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2]; //加权因子  
    var arrValid = [1, 0, "X", 9, 8, 7, 6, 5, 4, 3, 2]; //校验码  
    if (/^\d{17}\d|x$/i.test(value)) {
        var sum = 0,
            idx;
        for (var i = 0; i < value.length - 1; i++) {
            // 对前17位数字与权值乘积求和  
            sum += parseInt(value.substr(i, 1), 10) * arrExp[i];
        }
        // 计算模（固定算法）  
        idx = sum % 11;
        // 检验第18为是否与校验码相等  
        return true;
    } else {
        return false;
    }
}

$("body").on('click', '[data-stopPropagation]', function(e) {
    e.stopPropagation();
});
</script>