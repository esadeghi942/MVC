<?php
$title = 'ویرایش پروفایل';
include 'views/partials/header.php';
include 'views/user/sidebar.php'; ?>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">ویرایش پروفایل</div>
                <div class="card-body">
                    <form method="post">
                        <div class="form-group col-md-6">
                            <div class="form-check">
                                <input name="user_type_customer" class="form-check-input" type="radio"
                                       value="0" <?php echo $description['user_type_customer'] == 0 ? 'checked="checked"' : '' ?> >
                                <label class="form-check-label">مشتری حقیقی</label>
                            </div>
                            <div class="form-check">
                                <input name="user_type_customer" <?php echo $description['user_type_customer'] == 1 ? 'checked="checked"' : '' ?>
                                       class="form-check-input" type="radio" value="1">
                                <label class="form-check-label">مشتری حقوقی</label>
                            </div>
                        </div>
                        <div id="hoghooghy"
                             style='<?php echo $description['user_type_customer'] ? '' : "display: none" ?>'>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="control-label">نام شرکت <small class="text-danger">*</small></label>
                                    <input placeholder="نام شرکت" id="company" type="text"
                                           class="form-control" autofocus
                                           name="company"
                                           value="<?php echo isset($description['company']) ? $description['company'] : ''; ?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label">نام نماینده <small class="text-danger">*</small></label>
                                    <input placeholder="نام نماینده" id="namayande" type="text"
                                           class="form-control" autofocus
                                           name="namayande"
                                           value="<?php echo isset($description['namayande']) ? $description['namayande'] : ''; ?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label">شماره ثبت</label>
                                    <input placeholder="شماره ثبت" id="sabt_number" type="text"
                                           class="form-control" autofocus
                                           name="sabt_number"
                                           value="<?php echo isset($description['sabt_number']) ? $description['sabt_number'] : ''; ?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label">شماره اقتصادی</label>
                                    <input placeholder="شماره اقتصادی" id="ecomonic_number" type="text"
                                           class="form-control" autofocus
                                           name="ecomonic_number"
                                           value="<?php echo isset($description['ecomonic_number']) ? $description['ecomonic_number'] : ''; ?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label">شماره ملی</label>
                                    <input placeholder="شماره ملی" id="nathnal_code" type="text"
                                           class="form-control" autofocus
                                           name="nathnal_code"
                                           value="<?php echo isset($description['nathnal_code']) ? $description['nathnal_code'] : ''; ?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label">موبایل نماینده <small class="text-danger">*</small></label>
                                    <input placeholder="موبایل نماینده" id="phone_namayande" type="text"
                                           class="form-control" autofocus
                                           name="phone_namayande"
                                           value="<?php echo isset($description['phone_namayande']) ? $description['phone_namayande'] : ''; ?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label">زمینه فعالیت <small class="text-danger">*</small></label>
                                    <input placeholder="زمینه فعالیت" id="activity" type="text"
                                           class="form-control" autofocus
                                           name="activity"
                                           value="<?php echo isset($description['activity']) ? $description['activity'] : ''; ?>">
                                </div>
                            </div>
                        </div>
                        <div id="haghigy"
                             style='<?php echo !$description['user_type_customer'] ? '' : "display: none" ?>'>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="control-label">کد ملی <small class="text-danger">*</small></label>
                                    <input placeholder="کد ملی" id="national_code" type="text"
                                           class="form-control"
                                           name="national_code"
                                           value="<?php echo isset($description['national_code']) ? $description['national_code'] : ''; ?>"
                                           autofocus>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label">شغل</label>
                                    <input placeholder="شغل" id="job" type="text"
                                           class="form-control"
                                           name="job"
                                           value="<?php echo isset($description['job']) ? $description['job'] : ''; ?>"
                                           autofocus>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label">نحوه آشنایی</label>
                                    <input placeholder="نحوه آشنایی" id="familarity" type="text"
                                           class="form-control"
                                           name="familarity"
                                           value="<?php echo isset($description['familarity']) ? $description['familarity'] : ''; ?>"
                                           autofocus>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label class="control-label">تلفن ثابت <small class="text-danger">*</small></label>
                                <input placeholder="تلفن ثابت" id="user_fix_number" type="text"
                                       class="form-control" required
                                       name="user_fix_number" value="<?php echo $user['user_fix_number']; ?>" autofocus>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="control-label">آدرس <small class="text-danger">*</small></label>
                                <textarea name="user_address" class="form-control" required
                                          rows="3"><?php echo $user['user_address'] ?></textarea>
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