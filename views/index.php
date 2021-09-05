<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <base href="../">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>فیبر نوری تهران | ورود به پنل</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="developer" content="الهام صادقی">
    <meta name="developer-phone" content="+989365439172">
    <meta name="developer-email" content="e.sadeghi.942@gmail.com">

    <link rel="stylesheet" href="assets/css/adminlte.min.css">
    <link rel="stylesheet" href="assets/css/custom-style.css">

    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
    <style>
        .login-box-body, .register-box-body {
            background: #fff;
            padding: 20px;
            border-top: 0;
            color: #666;
            border-radius: 10px !important;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        }
        .login-box{
            width: 500px;
        }
    </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <!-- /.login-logo -->
    <div class="login-box-body">
        <div class="login-logo">
            <img src="assets/img/loginlogo" alt="فیبر نوری تهران" width="200px">
        </div>
        <p class="login-box-msg">به تهران فیبر خوش آمدید</p>
        <center><a href="<?php echo \Models\User::redirect();?> " style="background-color: #0062cc;color: #fff" class="btn btn-vorod">ورود به پنل</a>
        <a href="register" style="background-color: #0062cc;color: #fff" class="btn btn-vorod">ثبت نام</a></center>

    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

</body>
</html>
