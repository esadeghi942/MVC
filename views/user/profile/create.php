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
                        <div class="form-group col-md-6">
                            <div class="form-check">
                                <input name="user_type_customer" class="form-check-input" type="radio"
                                       value="0" checked>
                                <label class="form-check-label">مشتری حقیقی</label>
                            </div>
                            <div class="form-check">
                                <input name="user_type_customer" class="form-check-input" type="radio" value="1">
                                <label class="form-check-label">مشتری حقوقی</label>
                            </div>
                        </div>
                        <div id="hoghooghy"
                             style='display: none'>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="control-label">نام شرکت <small class="text-danger">*</small></label>
                                    <input placeholder="نام شرکت" id="company" type="text"
                                           class="form-control" autofocus  name="company" value="">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label">نام نماینده <small class="text-danger">*</small></label>
                                    <input placeholder="نام نماینده" id="namayande" type="text"
                                           class="form-control" autofocus name="namayande" value="">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label">شماره ثبت</label>
                                    <input placeholder="شماره ثبت" id="sabt_number" type="text"
                                           class="form-control" autofocus name="sabt_number" value="">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label">شماره اقتصادی</label>
                                    <input placeholder="شماره اقتصادی" id="ecomonic_number" type="text"
                                           class="form-control" autofocus name="ecomonic_number" value="">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label">شماره ملی</label>
                                    <input placeholder="شماره ملی" id="nathnal_code" type="text"
                                           class="form-control" autofocus name="nathnal_code" value="">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label">موبایل نماینده <small class="text-danger">*</small></label>
                                    <input placeholder="موبایل نماینده" id="phone_namayande" type="text"
                                           class="form-control" autofocus name="phone_namayande" value="">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label">زمینه فعالیت <small class="text-danger">*</small></label>
                                    <input placeholder="زمینه فعالیت" id="activity" type="text"
                                           class="form-control" autofocus name="activity" value="">
                                </div>
                            </div>
                        </div>
                        <div id="haghigy">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="control-label">کد ملی <small class="text-danger">*</small></label>
                                    <input placeholder="کد ملی" id="national_code" type="text"
                                           class="form-control" name="national_code"
                                           value="" autofocus>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label">شغل</label>
                                    <input placeholder="شغل" id="job" type="text"
                                           class="form-control" name="job" value="" autofocus>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label">نحوه آشنایی</label>
                                    <input placeholder="نحوه آشنایی" id="familarity" type="text"
                                           class="form-control" name="familarity" value="" autofocus>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label class="control-label">تلفن ثابت<small class="text-danger">*</small></label>
                                <input placeholder="تلفن ثابت" id="user_fix_number" type="text"
                                       class="form-control"
                                       name="user_fix_number" value="" autofocus>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="control-label">آدرس<small class="text-danger">*</small></label>
                                <textarea name="user_address" class="form-control" rows="3"></textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-flat mb-2">ثبت</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <script>
        $('input[name=user_type_customer]').on('change', function () {
            if ($(this).val() == 0) {
                $('#hoghooghy').hide();
                $('#haghigy').show();
            } else {
                $('#hoghooghy').show();
                $('#haghigy').hide();
            }
        });
    </script>
<?php
include 'views/partials/footer.php';
?>