function login() {
    var name = $('#txt_log_username').val();
    var pwd = $('#txt_log_pwd').val();


    if (name == "") {
        layer.msg("请输入用户名", { icon: 0 });
        $('#txt_log_username').focus();
        return false;
    }
    if (pwd == "") {

        layer.msg("请输入密码", { icon: 0 });
        $('#txt_log_pwd').focus();
        return false;
    }

    /*var zd = $("input[type='checkbox']").is(':checked');*/

    $.ajax({
        type: 'POST',
        //URL方式为POST
        url: '/ajax/to_login.aspx', //这里是指向登录验证的页面 
        data: {
            "username": name,
            // "qq": qq,
            "pwd": pwd,
           /* "zd":zd,*/
            "t": Math.random()
        },
        dataType: "json",
        //把要验证的参数传过去 
        //数据类型为JSON格式的验证 
        //在发送数据之前要运行的函数
        //        beforeSend: function () {
        //            $('#confirm').html('登录中.........');
        //        },
        success: function (json) {
            //这是个重点，根据验证页面（login.aspx）输出的JSON格式数据判断是否登录成功 
            //这里我用1表示的 
            //sta就是那个输出到客户端的标示 
            if (json.sta == 1) {
                //   alert("提交成功,请等候管理员联系");
                //location.href = "userPersonalr.aspx";
                window.location.reload();
            }
            else {
                layer.msg(json.info, {icon:0});
            }
        }
    });

}

function toexite() {

    $.ajax({
        type: 'POST',
        //URL方式为POST
        url: '/ajax/to_exit.aspx', //这里是指向登录验证的页面 
        data: {
          
            "t": Math.random()
        },
        dataType: "json",
        //把要验证的参数传过去 
        //数据类型为JSON格式的验证 
        //在发送数据之前要运行的函数
        //        beforeSend: function () {
        //            $('#confirm').html('登录中.........');
        //        },
        success: function (json) {
            //这是个重点，根据验证页面（login.aspx）输出的JSON格式数据判断是否登录成功 
            //这里我用1表示的 
            //sta就是那个输出到客户端的标示 
            if (json.sta == 1) {
                //   alert("提交成功,请等候管理员联系");
                location.href = "index.aspx";
            }
            else {
                layer.msg(json.info,2);
            }
        }
    });
}