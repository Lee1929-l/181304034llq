<!DOCTYPE html>
<html lang="en">

<head>
    <title>用户登录</title>
    <meta charset="utf-8">
    <meta name="register" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php include(__DIR__ . '/../public/html/css_meta.php') ?>
</head>

<body>

    <?php include(__DIR__ . '/../public/html/header.php') ?>
    <!-- END nav -->

    <div class="hero-wrap hero-wrap-2" style="background-image: url('static/image/bg_1.jpg');"
        data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-end justify-content-start">
                <div class="col-md-12 ftco-animate text-center mb-5">
                    <p class="breadcrumbs mb-0"><span class="mr-3"><a href="<?= base_url("home/index") ?>">首页 <i
                                    class="ion-ios-arrow-forward"></i></a></span><span>登录</span></p>
                    <h1 class="mb-3 bread">登录</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="ftco-section bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-2 mb-5">
                </div>

                <div class="col-md-12 col-lg-8 mb-5">

                    <form class="p-5 bg-white">

                        <div class="row form-group">
                            <div class="col-md-12 mb-3 mb-md-0">
                                <label class="font-weight-bold" for="user_name">用户名</label>
                                <input type="text" id="user_name" class="form-control" placeholder="请输入用户名">
                                <span id="name_tip" style="color:red"></span></br>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-12 mb-3 mb-md-0">
                                <label class="font-weight-bold" for="user_pwd">密码</label>
                                <input type="password" id="user_pwd" class="form-control" placeholder="请输入密码">
                                <span id="pwd_tip" style="color:red"></span></br>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-12">
                                <input id="sub" type="button" class="btn btn-primary  py-2 px-5" value="登录">
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </section>

    <?php include(__DIR__ . '/../public/html/footer.php') ?>

    <?php include(__DIR__ . '/../public/html/js_footer.php') ?>


    <script type="text/javascript">
    $(function() {
        var global_error_state = false;

        $('#user_pwd').blur(function() {
            var pass_val = $(this).val();
            var patt = /^((?=.*[0-9])(?=.*[a-zA-Z]).{8,30})/;
            if (!(patt.test(pass_val))) {
                global_error_state = true;
                $("#pwd_tip").text('密码必须包含字母和数字且不小于8位！');
            } else {
                global_error_state = false;
                $("#pwd_tip").text('');
            }
        })

        $('#user_name').blur(function() {
            if ($(this).val() == '') {
                global_error_state = true;
                $("#name_tip").text('用户名不能为空！');
            } else {
                global_error_state = false;
                $("#name_tip").text('');
            }
        })

        $('#sub').click(function() {
            if (global_error_state == true) {
                return false;
                tmp_error_content.push('登录信息错误');
            }

            //获取数据
            var user_pwd = $('#user_pwd').val();
            var user_name = $('#user_name').val();

            var tmp_error_content = []; //错误内容
            //执行判断语句
            if (user_name.length = 0) {
                tmp_error_content.push('用户名不能为空');
            } else if (user_pwd.length < 8) {
                tmp_error_content.push('密码不能小于8位');
            }

            //是否存在错误信息
            if (tmp_error_content.length > 0) {
                alert(tmp_error_content.join(','));
                return false;
            }
            var data = {
                "user_pwd": user_pwd,
                "user_name": user_name,
            };

            $.ajax({
                type: "POST",
                url: "<?= base_url('home/login_fun') ?>",
                data: data,
                dataType: "json",
                success: function(res) {
                    // console.log(res);
                    if (res['code'] == 1) {
                        alert(res['msg']);
                        window.location.href =
                            '<?= base_url() . "home/index" ?>';
                    } else {
                        alert(res['msg']);
                        return false;
                    }
                },
                error: function(ret) {
                    alert('请求失败');
                    console.log(ret);
                }
            });
        });
    })
    </script>

</body>

</html>