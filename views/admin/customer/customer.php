<?php
$title = 'لیست درخواست های فیبر نوری';
include 'views/partials/header.php';
include 'views/admin/sidebar.php'; ?>
    <style>
        body {
            padding-right: 0 !important;
        }
    </style>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#prfile" data-toggle="tab">مشخصات
                                        مشتری</a></li>
                                <li class="nav-item"><a class="nav-link show" href="#requests" data-toggle="tab">لیست
                                        درخواست ها</a></li>
                                <li class="nav-item"><a class="nav-link show" href="#bugs" data-toggle="tab">لیست خرابی
                                        ها</a></li>
                                <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">تیکت ها</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane active show" id="prfile">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <strong><i class="fa fa-id-card-o mr-1"></i> نام مشتری </strong>
                                            <p class="text-muted">
                                                <?php echo $user->user_name ?>
                                            </p>
                                            <hr>
                                        </div>
                                        <div class="col-md-6">
                                            <strong><i class="fa fa-id-card-o mr-1"></i> تاریخ ثبت نام </strong>
                                            <p class="text-muted ltr">
                                                <?php echo verta($user->user_create) ?>
                                            </p>
                                            <hr>
                                        </div>
                                        <div class="col-md-6"><strong><i class="fa fa-phone mr-1"></i> شماره موبایل
                                                مشتری </strong>
                                            <p class="text-muted">
                                                <?php echo $user->user_phone ?>
                                            </p>
                                            <hr>
                                        </div>
                                        <div class="col-md-6">
                                            <strong><i class="fa fa-phone mr-1"></i> آدرس ایمیل </strong>
                                            <p class="text-muted">
                                                <?php echo $user->user_email ?>
                                            </p>
                                            <hr>
                                        </div>
                                        <div class="col-md-6">
                                            <strong><i class="fa fa-building mr-1"></i> نام شرکت </strong>
                                            <p class="text-muted">
                                                <?php echo $user->cu_company ?>
                                            </p>
                                            <hr>
                                        </div>
                                        <div class="col-md-6"><strong><i
                                                        class="fa fa-user-secret mr-1"></i> نماینده </strong>
                                            <p class="text-muted">
                                                <?php echo $user->cu_namayande ?>
                                            </p>
                                            <hr>
                                        </div>
                                        <div class="col-md-6">
                                            <strong><i class="fa fa-map-marker mr-1"></i>آدرس </strong>
                                            <p class="text-muted">
                                                <?php echo $user->cu_addresss ?>
                                            </p>
                                            <hr>
                                        </div>
                                        <div class="col-md-6">
                                            <strong><i class="fa fa-phone mr-1"></i> تلفن </strong>
                                            <p class="text-muted">
                                                <?php echo $user->cu_phone ?>
                                            </p>
                                            <hr>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="requests">
                                    <div id="requests">
                                        <div class="card-header border-transparent">
                                            <h3 class="card-title"> درخواست ها </h3>
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body p-0">
                                            <div class='table-bordered'>
                                                <?php
                                                if (isset($requsts)) {
                                                    echo "<table class='table m-0'>
                                    <thead>
                                    <tr>
                                        <th>درخواست کارشناسی</th>
                                        <th>وضعیت درخواست</th>
                                        <th>زمان ثبت</th>
                                        <th>نمایش</th>
                                    </tr>
                                    </thead>
                                    <tbody>";
                                                    foreach ($requsts as $request) {
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
                                                        $request->request_karshenasi=$request->request_karshenasi?'بله':'خیر';
                                                        echo "
                                                <tr>
                                                <td>$request->request_karshenasi</td>
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

                                    </div>
                                </div>
                                <div class="tab-pane" id="bugs">
                                    <div class="table-bordered">
                                        <?php
                                        if (isset($bugs)) {
                                            echo "<table class='table m-0'>
                                    <thead>
                                    <tr>
                                        <th>توضیحات خرابی </th>
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
    <td class='w50'>$bug->bug_description</td>
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
                                <div class="tab-pane" id="timeline">
                                    <!-- The timeline -->
                                    <div id="comment">
                                        <ul class="timeline timeline-inverse">
                                            <!-- timeline item -->
                                            <?php
                                            if (!isset($comments[0]))
                                                echo '<div class="pr-3">هنوز تیکتی وجود ندارد.</div>';
                                            foreach ($comments as $comment) { ?>
                                                <li>
                                                    <i class="fa fa-comments bg-yellow"></i>
                                                    <div class="timeline-item <?php echo $comment->user_type != \Models\User::customer ? '' : 'float-left' ?>">
                                                <span class="time"><i
                                                            class="fa fa-clock-o"></i><?php echo verta($comment->comment_create)->format('Y-m-d H:i:s') ?></span>

                                                        <h3 class="timeline-header"><span class="text-green"
                                                                                          href="#"><?php echo $comment->user_name; ?></span>
                                                            :</h3>

                                                        <i class="fa float-left pt-3 <?php echo $comment->comment_readed == 1 ? 'fa-check-circle' : 'fa-check-circle-o' ?>"></i>
                                                        <div class="timeline-body"><?php echo $comment->comment_text ?></div>
                                                        <?php if ($comment->comment_readed == 0 && $comment->user_id == \Systems\Auth::id()) { ?>
                                                            <div class="timeline-footer">
                                                                <button type="submit"
                                                                        data-id="<?php echo $comment->comment_id; ?>"
                                                                        class="deletecomment btn btn-danger btn-flat btn-xs">
                                                                    حذف
                                                                </button>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                </li>

                                            <?php } ?>
                                            <!-- END timeline item -->
                                        </ul>
                                    </div>
                                    <form method="post">
                                        <div class="form-group">
                                            <label class="ml"
                                                   for="txt"><?php echo \Systems\Auth::user()['user_name']; ?>
                                                عزیز
                                                تیکت خود را وارد کنید:</label>
                                            <textarea name="comment_text" id="comment_text" class="form-control"
                                                      rows="3"
                                                      placeholder="متن تیکت..."></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-sm btn-success btn-flat pull-left">ارسال
                                            تیکت
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script type="text/javascript" src="assets/js/bootstrap.bundle.min.js"></script>
<?php
include 'views/partials/footer.php';
?>