<?php
$title = 'داشبورد';
include 'views/partials/header.php';
include 'views/admin/sidebar.php'; ?>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-6 col-6">
                            <!-- small box -->
                            <div class="card card-widget widget-user">
                                <div class="widget-user-header bg-info-active">
                                    <h3 class="widget-user-username"><i class="fa fa-wifi"></i>درخواست فیبر نوری</h3>
                                </div>
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-sm-4 border-left">
                                            <a href="adminRequestIndex?status=0&karshenasi=0">
                                                <div class="description-block">
                                                    <h5 class="description-header"><?php echo $req[0] ?></h5>
                                                    <span class="description-text">جدید</span>
                                                </div>
                                            </a>
                                            <!-- /.description-block -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-sm-4 border-left">
                                            <a href="adminRequestIndex?status=1&karshenasi=0">
                                                <div class="description-block">
                                                    <h5 class="description-header"><?php echo $req[1] ?></h5>
                                                    <span class="description-text">در حال بررسی</span>
                                                </div>
                                            </a>
                                            <!-- /.description-block -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-sm-4">
                                            <a href="adminRequestIndex?status=2&karshenasi=0">
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
                        <div class="col-md-6 col-6">
                            <div class="card card-widget widget-user">
                                <div class="widget-user-header bg-info-active">
                                    <h3 class="widget-user-username"><i class="fa fa-home"></i> کارشناسی حضوری</h3>
                                </div>
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-sm-4 border-left">
                                            <a href="adminRequestIndex?status=0&karshenasi=1">
                                                <div class="description-block">
                                                    <h5 class="description-header"><?php echo $karsh[0] ?></h5>
                                                    <span class="description-text">جدید</span>
                                                </div>
                                            </a>
                                            <!-- /.description-block -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-sm-4 border-left">
                                            <a href="adminRequestIndex?status=1&karshenasi=1">
                                                <div class="description-block">
                                                    <h5 class="description-header"><?php echo $karsh[1] ?></h5>
                                                    <span class="description-text">در حال بررسی</span>
                                                </div>
                                            </a>
                                            <!-- /.description-block -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-sm-4">
                                            <a href="adminRequestIndex?status=2&karshenasi=1">
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
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header border-transparent">
                                    <h3 class="card-title">آخرین درخواست کارشناسی </h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-widget="collapse">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body p-0">
                                    <div class='table-responsive'>
                                        <?php
                                        if (isset($karshenasi)) {
                                            echo "<table class='table m-0'>
                                    <thead>
                                    <tr>
                                        <th>نام مشتری</th>
                                        <th>شماره تماس</th>
                                        <th>وضعیت درخواست</th>
                                        <th>زمان ثبت</th>
                                        <th>نمایش</th>
                                    </tr>
                                    </thead>
                                    <tbody>";
                                            foreach ($karshenasi as $request) {
                                                $class = '';
                                                $txt = '';
                                                if ($request->request_status == 0) {
                                                    $class = 'danger';
                                                    $txt = 'مشاهده نشده';
                                                } elseif ($request->request_status == 1) {
                                                    $txt = 'در حال بررسی';
                                                    $class = 'warning';
                                                } else {
                                                    $class = 'success';
                                                    $txt = 'اعلام نتیجه';
                                                }
                                                echo "
                                                <tr>
                                                <td><a href='adminCustomer?id=$request->user_id'>$request->user_name</a></td>
                                                <td>$request->user_phone </td>
                                                <td><span class='badge badge-$class'>$txt</span>
                                               <td class='ltr'>" . verta($request->request_create) . "</td>
                                                <td>
                                                    <div class='btn-group btn-group-xs'>
                                                        <div class='btn-group btn-group-xs'>
                                                            <a href='adminRequest?id=$request->request_id'
                                                               class='btn btn-primary'><i class='fa fa-search'></i></a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                     ";
                                            }
                                            echo " </tbody>
                                </table>";
                                        } else
                                            echo "<p>موردی وجود ندارد</p>";
                                        ?>
                                    </div>
                                </div>
                                <div class="card-footer clearfix">
                                    <a href="adminRequestIndex?karshenasi=1"
                                       class="btn btn-sm btn-secondary float-right">مشاهده
                                        همه</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header border-transparent">
                                    <h3 class="card-title">آخرین اعلام خرابی ها </h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-widget="collapse">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <?php
                                        if (isset($bugs)) {
                                            echo "<table class='table m-0'>
                                    <thead>
                                    <tr>
                                        <th>نام مشتری</th>
                                        <th>شماره تماس</th>
                                        <th>وضعیت </th>
                                        <th>تاریخ ثبت</th>
                                        <th>نمایش</th>
                                    </tr>
                                    </thead>
                                    <tbody>";
                                            foreach ($bugs as $bug) {
                                                $class = '';
                                                $txt = '';
                                                if ($bug->bug_status == 0) {
                                                    $class = 'danger';
                                                    $txt = 'مشاهده نشده';
                                                } elseif ($bug->bug_status == 1) {
                                                    $txt = 'در حال بررسی';
                                                    $class = 'warning';
                                                } else {
                                                    $class = 'success';
                                                    $txt = 'اعلام نتیجه';
                                                }
                                                echo "
<tr>
    <td><a href='adminCustomer?id=$bug->user_id'>$bug->user_name </a></td>
    <td>$bug->user_phone </td>
    <td><span class='badge badge-$class'>$txt</span></td>
     <td class='ltr'>" . verta($bug->bug_create) . "</td>
                                                <td>
                                                    <div class='btn-group btn-group-xs'>
                                                        <div class='btn-group btn-group-xs'>
                                                            <a href='adminBug?id=$bug->bug_id'
                                                               class='btn btn-primary'><i class='fa fa-search'></i></a>
                                                        </div>
                                                    </div>
                                                </td>
                                             
                                            </tr>
                                        
                                      ";
                                            }
                                            echo "</tbody>
                                </table>";
                                        } else
                                            echo "<p>موردی وجود ندارد</p>";
                                        ?>

                                    </div>
                                </div>
                                <div class="card-footer clearfix">
                                    <a href="adminBugIndex" class="btn btn-sm btn-secondary float-right">مشاهده
                                        همه</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-6">
                    <!-- small box -->
                    <div class="card card-widget widget-user">
                        <div class="widget-user-header bg-info-active">
                            <h3 class="widget-user-username"><i class="fa fa-wrench"></i> اعلام خرابی</h3>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-sm-4 border-left">
                                    <a href="adminBugIndex?status=0">
                                        <div class="description-block">
                                            <h5 class="description-header"><?php echo $cbug[0] ?></h5>
                                            <span class="description-text">جدید</span>
                                        </div>
                                    </a>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4 border-left">
                                    <a href="adminBugIndex?status=1">
                                        <div class="description-block">
                                            <h5 class="description-header"><?php echo $cbug[1] ?></h5>
                                            <span class="description-text">در حال بررسی</span>
                                        </div>
                                    </a>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4">
                                    <a href="adminBugIndex?status=2">
                                        <div class="description-block">
                                            <h5 class="description-header"><?php echo $cbug[2] ?></h5>
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
                    <!-- small box -->
                    <div class="card card-widget widget-user">
                        <div class="widget-user-header bg-info-active">
                            <h5 class="widget-user-username"><i class="fa fa-user-o"></i> کاربران سایت</h5>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-sm-4 border-left">
                                    <div class="description-block">
                                        <h5 class="description-header"><?php echo $user[0] ?></h5>
                                        <span class="description-text">مدیران</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4 border-left">
                                    <div class="description-block">
                                        <h5 class="description-header"><?php echo $user[1] ?></h5>
                                        <span class="description-text">مشتریان</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4">
                                    <div class="description-block">
                                        <h5 class="description-header"><?php echo $user[2] ?></h5>
                                        <span class="description-text">ثبت نامی</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                    </div>
                    <div class="card card-widget">
                        <div class="card-header">
                            <h6><i class="fa fa-comments-o"></i>  آخرین تیکت مشتریان</h6>
                            <!-- /.user-block -->
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <!-- /.card-body -->
                        <div class="card-footer card-comments">
                            <?php
                            if (isset($comments[0]))
                                foreach ($comments as $comment) { ?>
                                    <div class="card-comment">
                                        <div class="comment-text">
                        <span class="username">
                         <?php echo $comment->user_name; ?>
                          <span class="text-muted float-left ltr"><i class="fa fa-clock-o"></i><?php echo verta($comment->comment_create); ?></span>
                        </span>
                                            <?php echo $comment->comment_text ?>
                                        </div>
                                    </div>
                                <?php }
                            else
                                echo "<p>موردی وجود ندارد</p>";
                            ?>
                        </div>
                        <!-- /.card-footer -->
                        <!-- /.card-footer -->
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php
include 'views/partials/footer.php';
?>