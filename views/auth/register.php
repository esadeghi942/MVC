<?php
$titlepage = 'فیبر نوری تهران -  ثبت نام';
$titlecard = 'ثبت نام';
include 'views/auth/header.php';
?>
<form method="POST">
    <div class="d-flex justify-content-center">
        <div class="form-group col-md-10">
            <label class="control-label">نام و نام خانوداگی</label>
            <input placeholder="نام و نام خانوادگی" id="name" type="text"
                   class="form-control"
                   name="name" value="" required autofocus>
        </div>
        <div class="form-group col-md-10">
            <label class="control-label">ایمیل</label>
            <input placeholder="ایمیل" id="email" type="email"
                   class="form-control"
                   name="email" value="" required
                   autofocus>
        </div>
        <div class="form-group col-md-10">
            <label class="control-label">شماره موبایل</label>
            <input placeholder="شماره موبایل" id="phone" type="text"
                   class="form-control"
                   name="phone" value="" required
                   autofocus>
        </div>
        <div class="form-group col-md-10">
            <label class="control-label">رمز عبور</label>
            <input placeholder="رمز عبور" id="password" type="password" class="form-control"
                   name="password" required autofocus>
        </div>
        <div class="form-group col-md-10">
            <label class="control-label">تایید رمز عبور</label>
            <input placeholder="تایید رمز عبور" id="confirmpassword" type="password"
                   class="form-control"
                   name="confirm-password" required autofocus>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">
                ثبت نام
            </button>
        </div>
    </div>
</form>
</div>
</div>
</div>
</div>
</div>
</body>
</html>