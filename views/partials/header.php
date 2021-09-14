<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> فیبر نوری تهران - پنل کاربری </title>

    <meta name="developer" content="الهام صادقی">
    <meta name="developer-phone" content="+989365439172">
    <meta name="developer-email" content="e.sadeghi.942@gmail.com">

    <!-- Tell the browser to be responsive to screen width -->
    <base href="../">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="assets/css/font-awesome.css">
    <link rel="stylesheet" href="assets/css/adminlte.css">
    <link rel="stylesheet" href="assets/css/bootstrap-rtl.min.css">
    <link rel="stylesheet" href="assets/css/custom-style.css">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>

    <script type="text/javascript" src="assets/js/jquery.min.js"></script>
    <style>
        .content-wrapper{
            min-height: 570px !important;
        }
        #app-messages{
            display: inline-block;
            position: absolute;
            bottom: 200px;
            left: 15px;
            z-index: 9999;
        }
    </style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
            </li>
        </ul>
        <!-- Right navbar links -->
    </nav>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">خانه</a></li>
                            <li class="breadcrumb-item active"><?php echo isset($title) ? $title : ''; ?></li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>