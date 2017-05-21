<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="cn">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>登录页面 - <?php echo ($module_name); ?></title>
    <link rel="stylesheet" href="__PUBLIC__/css/bootstrap.css">
    <link rel="stylesheet" href="__PUBLIC__/css/login.css">
</head>

<body>
    <div class="site-wrapper">
        <div class="site-wrapper-inner">
            <div class="cover-container">
                <div class="masthead clearfix">
                    <div class="inner">
                        <h3 class="masthead-brand"><?php echo ($module_name); ?></h3>
                        <nav>
                            <ul class="nav masthead-nav">
                                <li id="loginPanel" class="active"><a href="#">登录</a></li>
                                <li id="registerPanel" class=""><a href="#">注册</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="inner cover">
                    <form class="form-signin" action="<?php echo U('login');?>" method="post">
                        <h2 class="form-signin-heading">请输入您的教师信息以便登录系统</h2>
                        <label for="username1" class="sr-only">用户名</label>
                        <input type="text" id="username1" name="username" class="form-control" placeholder="用户名" required autofocus>
                        <br>
                        <label for="password1" class="sr-only">密码</label>
                        <input type="password" id="password1" name="password" class="form-control" placeholder="密码" required>
                        <br>
                        <button class="btn btn-lg btn-primary btn-block" name="login" type="submit" value="1">登录</button>
                    </form>
                    <form class="form-register" style="display:none;" action="<?php echo U('register');?>" method="post">
                        <h2 class="form-signin-heading">请输入您的教师信息以便注册账户</h2>
                        <label for="username2" class="sr-only">用户名</label>
                        <input type="text" id="username2" name="username" class="form-control" placeholder="用户名" required autofocus>
                        <br>
                        <label for="password2" class="sr-only">密码</label>
                        <input type="password" id="password2" name="password" class="form-control" placeholder="密码" required>
                        <br>
                        <button class="btn btn-lg btn-primary btn-block" name="register" type="submit" value="1">注册</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="__PUBLIC__/js/jquery-3.2.1.min.js"></script>
    <script>
        $("#loginPanel").click(function(){
            $("#registerPanel").removeClass("active");
            $("#loginPanel").addClass("active");
            $("form").stop(true);
            $("form.form-register").fadeOut(function(){
                $("form.form-signin").fadeIn();
            });
        })
        $("#registerPanel").click(function(){
            $("#registerPanel").addClass("active");
            $("#loginPanel").removeClass("active");
            $("form").stop(true);
            $("form.form-signin").fadeOut(function(){
                $("form.form-register").fadeIn();
            });
        })
    </script>
</body>

</html>