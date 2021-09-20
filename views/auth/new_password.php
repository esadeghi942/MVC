<?php
$titlepage = 'فیبر نوری تهران -  بازیابی رمز عبور';
$titlecard = 'بازیابی رمز عبور';
include 'views/auth/header.php';
?>
<form method="POST">
    <div class="form-group justify-content-center">
        <input type="hidden" id="token" name="token" value="">
    </div>
    <div class="form-group justify-content-center">
        <input placeholder="رمز عبور" id="password" type="password" class="form-control"
               name="password" required>
    </div>
    <div class="form-group justify-content-center">
        <input placeholder="تایید رمز عبور" id="confirm-password" type="password" class="form-control"
               name="confirm-password" required>
    </div>
    <div class="form-group row mb-0 justify-content-center">
        <button type="submit" class="btn btn-primary">
            تغییر رمز عبور
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