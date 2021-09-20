<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php  echo $titlepage;?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <base href="../">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="developer" content="الهام صادقی">
    <meta name="developer-phone" content="+989365439172">
    <meta name="developer-email" content="e.sadeghi.942@gmail.com">

    <link rel="stylesheet" href="assets/css/adminlte.css">
    <link rel="stylesheet" href="assets/css/custom-style.css">

    <script type="text/javascript" src="assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/custom.js"></script>

    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
    <style>
        body {
            direction: rtl !important;
            text-align: right;
            padding: 5em 0;
            background-color: #f5f8fa;
        }
        body {
            direction: rtl !important;
            text-align: right;
            padding: 0.5em 0;
            background-color: #f5f8fa;
        }

        form > div {
            flex-direction: column;
            align-items: center;
        }
        .form-check-input {
            margin-left: 0;
            margin-right: -1.25rem;
        }
        .form-check{
            padding-right: 1.25rem;
        }

        .checkbox {
            margin-right: 1.25rem;
        }

        .form-check-label, .form-check-input {
            margin-left: 0;
            margin-right: 0.3rem;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="d-flex justify-content-center">
                <img src="assets/img/loginlogo.png" alt="فیبر نوری تهران" class="logologin" width="200px">
            </div>
            <div class="card">
                <div class="card-header"><?php echo $titlecard;?></div>
                <div class="card-body">
                    <section class="content"></section>
                  <!--  --><?php
/*                    if (isset($errors))
                        if (isset($errors) && count($errors) > 0) {
                            echo "<div class='alert alert-danger alert-dismissible'>
                              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                              <h5><i class='icon fa fa-ban'></i></h5>";
                            foreach ($errors as $error)
                                echo "<pre>$error</pre>";
                            echo "</div>";
                        }
                    */?>
