<!DOCTYPE html>
<html>
<meta charset="utf-8">

<head>
    <title>后台管理系统</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link href="https://cdn.staticfile.org/twitter-bootstrap/5.1.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.staticfile.org/twitter-bootstrap/5.1.1/js/bootstrap.bundle.min.js"></script> -->
    <?php include(__DIR__ . '/../public/admin/css_meta.php') ?>
    <?php include(__DIR__ . '/../public/admin/js_footer.php') ?>
</head>

<body>
    <div class="wrapper">
        <!-- 页头 -->
        <?php include(__DIR__ . '/../public/admin/header.php') ?>
        <!-- 侧边栏 -->
        <?php include(__DIR__ . '/../public/admin/navigation.php') ?>

        <div class="content-wrapper">
            <div class="container-fluid p-5 text-black text-center">
                <h1>后台管理系统首页</h1><br><br>
                <button class="btn btn-primary" onclick="to_logout()" value="">退出登录</button></br></br>
                <!-- <button class="btn btn-primary" onclick="to_personal()" value="">个人中心</button></br></br> -->
            </div>
        </div>

        <!-- 页脚 -->
        <?php include(__DIR__ . '/../public/admin/footer.php') ?>

    </div>

</body>

<script>
function to_logout() {
    alert("是否确认退出登录？");
    window.location.href = '<?= base_url() . "login/logout" ?>';
};

/* function to_personal() {
  //判断为普通用户
  window.location.href = '<?= base_url() . "login/user" ?>';
  //判断为管理员
  window.location.href = '<?= base_url() . "login/admin" ?>';
} */
</script>

</html>