<?php
$title = 'باقی مانده اعتبار پیامک';
include 'views/partials/header.php';
include 'views/admin/sidebar.php';
?>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">باقی مانده اعتبار پیامک</div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label class="control-label">باقی مانده اعتبار پیامک شما به مبلغ <?php echo $amount ?>
                                <small>(ریال)</small> است.</label>
                        </div>

                        <div class="form-group col-md-12">
                            <label class="control-label"><a target="_blank" href="http://sms.tehranftth.ir/?module=WebServices">شارژ اعتبار پیامک </a>
                               </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php
include 'views/partials/footer.php';
?>