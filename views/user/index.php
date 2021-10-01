<?php
$title = 'داشبورد';
include 'views/partials/header.php';
include 'views/user/sidebar.php'; ?>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4 col-sm-12">
                    <!-- small box -->
                    <div class="card card-widget widget-user">
                        <div class="widget-user-header bg-info-active">
                            <h3 class="widget-user-username"><i class="fa fa-wifi"></i>درخواست فیبر نوری</h3>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-sm-4 border-left">
                                    <a href="userRequestIndex?status=0&karshenasi=0">
                                        <div class="description-block">
                                            <h5 class="description-header"><?php echo $req[0] ?></h5>
                                            <span class="description-text">مشاهده نشده</span>
                                        </div>
                                    </a>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4 border-left">
                                    <a href="userRequestIndex?status=1&karshenasi=0">
                                        <div class="description-block">
                                            <h5 class="description-header"><?php echo $req[1] ?></h5>
                                            <span class="description-text">در حال بررسی</span>
                                        </div>
                                    </a>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4">
                                    <a href="userRequestIndex?status=2&karshenasi=0">
                                        <div class="description-block">
                                            <h5 class="description-header"><?php echo $req[2] ?></h5>
                                            <span class="description-text">اعلام نتیجه</span>
                                        </div>
                                    </a>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="card card-widget widget-user">
                        <div class="widget-user-header bg-info-active">
                            <h3 class="widget-user-username"><i class="fa fa-home"></i> کارشناسی حضوری</h3>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-sm-4 border-left">
                                    <a href="userRequestIndex?status=0&karshenasi=1">
                                        <div class="description-block">
                                            <h5 class="description-header"><?php echo $karsh[0] ?></h5>
                                            <span class="description-text">مشاهده نشده</span>
                                        </div>
                                    </a>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4 border-left">
                                    <a href="userRequestIndex?status=1&karshenasi=1">
                                        <div class="description-block">
                                            <h5 class="description-header"><?php echo $karsh[1] ?></h5>
                                            <span class="description-text">در حال بررسی</span>
                                        </div>
                                    </a>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4">
                                    <a href="userRequestIndex?status=2&karshenasi=1">
                                        <div class="description-block">
                                            <h5 class="description-header"><?php echo $karsh[2] ?></h5>
                                            <span class="description-text">اعلام نتیجه</span>
                                        </div>
                                    </a>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <!-- small box -->
                    <div class="card card-widget widget-user">
                        <div class="widget-user-header bg-info-active">
                            <h3 class="widget-user-username"><i class="fa fa-wrench"></i> اعلام خرابی</h3>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-sm-4 border-left">
                                    <a href="userBugIndex?status=0">
                                        <div class="description-block">
                                            <h5 class="description-header"><?php echo $cbug[0] ?></h5>
                                            <span class="description-text">مشاهده نشده</span>
                                        </div>
                                    </a>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4 border-left">
                                    <a href="userBugIndex?status=1">
                                        <div class="description-block">
                                            <h5 class="description-header"><?php echo $cbug[1] ?></h5>
                                            <span class="description-text">در حال بررسی</span>
                                        </div>
                                    </a>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4">
                                    <a href="userBugIndex?status=2">
                                        <div class="description-block">
                                            <h5 class="description-header"><?php echo $cbug[2] ?></h5>
                                            <span class="description-text">اعلام نتیجه</span>
                                        </div>
                                    </a>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                            </div
                                    <!-- /.row -->
                        </div>
                    </div>

                </div>
                <div class="col-md-8 col-sm-12">
                    <div class="card card-widget">
                        <div class="card-header">
                            <h6 class="float-right"><i class="fa fa-comments-o"></i> آخرین تیکت ها</h6>
                            <a href="userGroupComment" class="float-left btn btn-success btn-sm mt-2">
                                تیکت ها
                            </a>
                        </div>
                                <?php
                                if (isset($gcomments[0])){  ?>
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>فعال بودن تیکت</th>
                                            <th>عنوان تیکت</th>
                                            <th>تعداد پیام خوانده نشده</th>
                                            <th>عملیات</th>
                                        </tr>
                                        <?php
                                        foreach ($gcomments as $comment) {
                                            ?>
                                            <tr>
                                                <td><?php echo $comment->gcomment_active? '<span class="badge badge-success">باز</span>' : '<span class="badge badge-danger">بسته</span>' ?></td>
                                                <td><?php echo $comment->gcomment_label; ?></td>
                                                <td><?php echo $comment->count_unread; ?></td>
                                                <td>
                                                    <div class="btn-group btn-group-sm">
                                                        <a href="userComment?gid=<?php echo $comment->gcomment_id ?>"
                                                           class="btn btn-primary">نمایش پیام ها</a>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </table>
                                    <?php
                                }
                                else {
                                    echo "<p class='mr-2'>موردی وجود ندارد</p>";
                                }
                                ?>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="card card-dark">
                        <div class="card-header">
                            <h3 class="card-title">پروفایل</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <strong><i class="fa fa-id-card-o mr-1"></i> نام : </strong>
                            <p class="text-muted">
                                <?php echo $user->user_name ?>
                            </p>
                            <hr>
                            <strong><i class="fa fa-clock-o mr-1"></i> تاریخ ثبت نام: </strong>
                            <p class="text-muted ltr">
                                <?php echo verta($user->user_create) ?>
                            </p>
                            <hr>
                            <strong><i class="fa fa-phone mr-1"></i> شماره موبایل : </strong>
                            <p class="text-muted">
                                <?php echo $user->user_phone ?>
                            </p>
                            <hr>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php
include 'views/partials/footer.php';
?>