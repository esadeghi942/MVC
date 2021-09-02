<?php
$titlepage = 'فیبر نوری تهران - ورود';
$titlecard = 'ورود';
include 'views/auth/header.php';
?>
<form method="POST">
    <div class="form-group justify-content-center">
        <input placeholder="شماره تلفن" id="phone" type="text"
               class="form-control"
               name="phone" value="" required autofocus>
    </div>
    <div class="form-group justify-content-center">
        <input placeholder="رمز عبور" id="password" type="password" class="form-control"
               name="password" required>
    </div>
    <div class="form-group justify-content-center">
        <div class="row">
            <div class="col-md-6 ltr">
                <div class="checkbox">
                    <lable class="form-check-label">مرا به خاطر بسپار</lable>
                    <input class="form-check-input" type="checkbox" checked="checked"
                           name="remember">
                </div>
            </div>
            <div class="col-md-6">
                <a href="forget" class="link-primary">فراموشی رمز عبور</a>
            </div>
        </div>
    </div>

    <div class="form-group row mb-0 justify-content-center">
        <button type="submit" class="btn btn-primary">
            ورود به پنل
        </button>
    </div>
</form>
</div>
</div>
</div>
</div>
</div>

</body>
</html>