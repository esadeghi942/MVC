<?php
$title = 'ویرایش کاربر';
include 'views/partials/header.php';
include 'views/admin/sidebar.php';
?>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">ویرایش کاربر</div>
                <div class="card-body">
                    <form method="POST">
                        <div class="row">
                            <div class="form-group col-md-10">
                                <label class="control-label">نام و نام خانوداگی</label>
                                <input placeholder="نام و نام خانوادگی" id="name" type="text"
                                       class="form-control"
                                       name="name" value="<?php echo $user['user_name'] ?>" required autofocus>
                            </div>
                            <div class="form-group col-md-10">
                                <label class="control-label">ایمیل</label>
                                <input placeholder="ایمیل" id="email" type="email"
                                       class="form-control"
                                       name="email" value="<?php echo $user['user_email'] ?>" required
                                       autofocus>
                            </div>
                            <div class="form-group col-md-10">
                                <label class="control-label">شماره موبایل</label>
                                <input placeholder="شماره موبایل" id="phone" type="text"
                                       class="form-control"
                                       name="phone" value="<?php echo $user['user_phone'] ?>" required
                                       autofocus>
                            </div>
                            <div class="form-group col-md-10">
                                <label class="control-label">رمز عبور</label>
                                <input placeholder="رمز عبور" id="password" type="password" class="form-control"
                                       name="password" autofocus>
                            </div>
                            <div class="form-group col-md-10">
                                <label class="control-label">تایید رمز عبور</label>
                                <input placeholder="تایید رمز عبور" id="confirmpassword" type="password"
                                       class="form-control"
                                       name="confirm-password" autofocus>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            ثبت اطلاعات
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
<?php
include 'views/partials/footer.php';
?>