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
                                       value="0">
                                <label class="form-check-label">مشتری حقیقی</label>
                            </div>
                            <div class="form-check">
                                <input name="user_type_customer" class="form-check-input" type="radio" value="1">
                                <label class="form-check-label">مشتری حقوقی</label>
                            </div>
                        </div>
                        <div id="hoghooghy" style="display: none">
                            <div class="row">
                                <div class="form-group col-md-10">
                                    <label class="control-label">نام شرکت</label>
                                    <input placeholder="نام شرکت" id="company" type="text"
                                           class="form-control"
                                           name="company" value="" autofocus>
                                </div>
                                <div class="form-group col-md-10">
                                    <label class="control-label">نام نماینده</label>
                                    <input placeholder="نام نماینده" id="namayande" type="text"
                                           class="form-control"
                                           name="namayande" value="" autofocus>
                                </div>
                            </div>
                        </div>
                        <div id="haghigy" style="display: none">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="control-label">شغل</label>
                                    <input placeholder="شغل" id="job" type="text"
                                           class="form-control"
                                           name="job" value="" autofocus>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label">نحوه آشنایی</label>
                                    <input placeholder="نحوه آشنایی" id="familarity" type="text"
                                           class="form-control"
                                           name="familarity" value="" autofocus>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label class="control-label">تلفن ثابت</label>
                                <input placeholder="تلفن ثابت" id="user_fix_number" type="text"
                                       class="form-control"
                                       name="user_fix_number" value="" autofocus>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="control-label">آدرس</label>
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