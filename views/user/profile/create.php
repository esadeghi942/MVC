<?php
$title = '‌پروفایل';
include 'views/partials/header.php';
include 'views/user/sidebar.php'; ?>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">تکمیل پروفایل</div>
                <div class="card-body">
                    <form method="post">
                        <!-- Small boxes (Stat box) -->
                        <div class="row">
                            <div class="form-group col-md-10">
                                <label class="control-label">نام شرکت</label>
                                <input placeholder="نام شرکت" id="cu_company" type="text"
                                       class="form-control"
                                       name="cu_company" value="" autofocus>
                            </div>
                            <div class="form-group col-md-10">
                                <label class="control-label">نام نماینده</label>
                                <input placeholder="نام نماینده" id="cu_namayande" type="text"
                                       class="form-control"
                                       name="cu_namayande" value="" autofocus>
                            </div>
                            <div class="form-group col-md-10">
                                <label class="control-label">تلفن ثابت</label>
                                <input placeholder="تلفن ثابت" id="cu_phone" type="text"
                                       class="form-control"
                                       name="cu_phone" value="" autofocus>
                            </div>
                            <div class="form-group col-md-10">
                                <label class="control-label">آدرس</label>
                                <textarea name="cu_addresss" class="form-control" rows="3"></textarea>
                            </div>
                            <!-- ./col -->
                        </div>
                        <button type="submit" class="btn btn-primary btn-flat mb-2">ثبت</button>
                    </form>
                </div>
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
<?php
include 'views/partials/footer.php';
?>