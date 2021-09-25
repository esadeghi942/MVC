<?php
$title = 'پروفایل';
include 'views/partials/header.php';
include 'views/user/sidebar.php'; ?>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">پروفایل
                    <a class="btn btn-success float-left" href="userProfileUpdate">ویرایش</a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class='col-md-6'>
                            <strong><i class='fa fa-book mr-1'></i>نام و و نام خانوادگی</strong>
                            <p class='text-muted'><?php echo $user['user_name']?></p>
                            <hr>
                        </div>
                        <div class='col-md-6'>
                            <strong><i class='fa fa-book mr-1'></i>شماره موبایل</strong>
                            <p class='text-muted'><?php echo $user['user_phone']?></p>
                            <hr>
                        </div>
                        <div class='col-md-6'>
                            <strong><i class='fa fa-book mr-1'></i>آدرس</strong>
                            <p class='text-muted'><?php echo $user['user_phone']?></p>
                            <hr>
                        </div>
                        <div class='col-md-6'>
                            <strong><i class='fa fa-book mr-1'></i>تلفن ثابت</strong>
                            <p class='text-muted'><?php echo $user['user_phone']?></p>
                            <hr>
                        </div>
                        <div class='col-md-6'>
                            <strong><i class='fa fa-book mr-1'></i>ایمیل</strong>
                            <p class='text-muted'><?php echo $user['user_phone']?></p>
                            <hr>
                        </div>
                        <div class='col-md-6'>
                            <strong><i class='fa fa-book mr-1'></i>تاریخ ثبت نام</strong>
                            <p class='text-muted'><?php echo $user['user_phone']?></p>
                            <hr>
                        </div>
                        <?php
                        foreach ($description as $k=>$desc){
                            if(!empty($k))
                                echo"<div class='col-md-6'>
                                    <strong><i class='fa fa-book mr-1'></i>$k</strong>
                                    <p class='text-muted'>$desc</p>
                                </div>";
                        }
                    if (isset($files[0])) {
                        echo "<strong><i class='fa fa-book mr-1'></i>فایل های آپلود شده</strong>
                              <div id='prevfiles' class='row'>";
                        foreach ($files as $file) {
                            echo "<div class='item mt-2 col-md-3 col-sm-12'>
                                        <div class='form-control'>
                                            <a target='_blank' href=$file->file_path
                                            class='ltr'>$file->file_title</a>
                                        </div>
                                    </div>";
                        }
                        echo "</div>";
                    } ?>
                </div>
            </div>
        </div>
        </div>
    </section>
<?php
include 'views/partials/footer.php';
?>