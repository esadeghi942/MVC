<?php
$title = 'ویرایش هزینه کارشناسی';
include 'views/partials/header.php';
include 'views/admin/sidebar.php';
?>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">ویرایش هزینه کارشناسی</div>
                <div class="card-body">
                    <form method="POST">
                        <div class="row">
                            <div class="form-group col-md-10">
                                <label class="control-label"><small>(ریال)</small>هزینه کارشناسی</label>
                                <input id="payment_amount" type="text"
                                       class="form-control"
                                       name="payment_amount" value="<?php echo payment_amount ?>" required autofocus>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            ثبت
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
<?php
include 'views/partials/footer.php';
?>