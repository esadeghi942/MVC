<?php
$title = 'کارتابل مشتری / '.$user->user_name;
include 'views/partials/header.php';
include 'views/admin/sidebar.php'; ?>
    <style>
        body {
            padding-right: 0 !important;
        }
        img{
            max-height:100%;
            max-width:100%;
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
                                <li class="nav-item"><a class="nav-link" href="#malis" data-toggle="tab">تراکنش های مالی</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="#documents" data-toggle="tab">مدارک ارسالی</a>
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
                                            <strong><i class="fa fa-clock-o mr-1"></i> تاریخ ثبت نام </strong>
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
                                            <strong><i class="fa fa-envelope-o mr-1"></i> آدرس ایمیل </strong>
                                            <p class="text-muted">
                                                <?php echo $user->user_email ?>
                                            </p>
                                            <hr>
                                        </div>
                                        <div class="col-md-6">
                                            <strong><i class="fa fa-map-marker mr-1"></i> آدرس </strong>
                                            <p class="text-muted">
                                                <?php echo $user->user_address ?>
                                            </p>
                                            <hr>
                                        </div>
                                        <div class="col-md-6">
                                            <strong><i class="fa fa-phone mr-1"></i> تلفن </strong>
                                            <p class="text-muted">
                                                <?php echo $user->user_fix_number ?>
                                            </p>
                                            <hr>
                                        </div>
                                        <?php
                                        foreach ($description as $k=>$desc){
                                            if(!empty($k))
                                                echo"<div class='col-md-6'>
                                        <strong><i class='fa fa-check-square mr-1'></i> $k</strong>
                                        <p class='text-muted'>$desc</p>
                                         <hr>
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
                                        <th>وضعیت پرداخت</th>
                                        <th>زمان ثبت</th>
                                        <th>نمایش</th>
                                    </tr>
                                    </thead>
                                    <tbody>";
                                                    foreach ($requsts as $request) {
                                                        if(!$request->request_karshenasi) {
                                                            $payment_class = 'warning';
                                                            $str = 'فاقد هزینه';
                                                        }
                                                        elseif($request->request_karshenasi && $request->request_payment_status){
                                                            $str = 'پرداخت شده';
                                                            $payment_class='success';
                                                        }
                                                        elseif($request->request_karshenasi && !$request->request_payment_status){
                                                            $str = 'پرداخت نشده';
                                                            $payment_class='danger';
                                                        }
                                                        $request->request_payment_status=$str;
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
                                                <td><span class='badge badge-$class'>$txt</span></td>
                                                <td><span class='badge badge-$payment_class'>$request->request_payment_status</span></td>
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
                                        <th>وضعیت</th>
                                        <th>هزینه</th>                       
                                        <th>وضعیت پرداخت</th>
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
                                                $status_payment='';
                                                if($bug->bug_payment_status==1) {
                                                    $bug->bug_payment_status = 'پرداخت شده';
                                                    $status_payment = 'success';
                                                }
                                                if($bug->bug_payment_status==0 && empty($bug->bug_payment)) {
                                                    $bug->bug_payment_status = 'فاقد هزینه';
                                                    $status_payment = 'warning';
                                                }
                                                if($bug->bug_payment_status==0 && !empty($bug->bug_payment)) {
                                                    $bug->bug_payment_status = 'پرداخت نشده';
                                                    $status_payment = 'danger';
                                                }
                                                echo "
                            <tr>
                                <td><span class='badge badge-$class'>$txt</span></td>
                                <td>".number_format($bug->bug_payment)."ریال</td>
                                <td><span class='badge badge-$status_payment'>$bug->bug_payment_status</span></td>
                                 <td class='ltr'>" . verta($bug->bug_create) . "</td>
                                <td>
                                    <div class='btn-group btn-group-sm'>
                                            <a href='adminBug?id=$bug->bug_id'
                                               class='btn btn-primary'><i class='fa fa-search'></i></a>  
                                    </div>
                                </td>
                                </tr>";
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
                                        <table class="table table-bordered">
                                            <tr>
                                                <th>نام مشتری</th>
                                                <th>عنوان تیکت</th>
                                                <th>تعداد پیام خوانده نشده</th>
                                                <th> تاریخ ایجاد</th>
                                                <th>عملیات</th>
                                            </tr>
                                            <?php
                                            foreach ($gcomments as $comment) {
                                                ?>
                                                <tr>
                                                    <td><a href="adminCustomer/?id=<?php echo $comment->user_id ?>"><?php echo $comment->user_name; ?></a></td>
                                                    <td><?php echo $comment->gcomment_label; ?></td>
                                                    <td><?php echo $comment->count_unread; ?></td>
                                                    <td class="ltr"><?php echo verta($comment->gcomment_create) ; ?></td>
                                                    <td>
                                                        <div class="btn-group btn-group-sm">
                                                            <a href="adminUserCommnet?gid=<?php echo $comment->gcomment_id ?>"
                                                               class="btn btn-primary">نمایش پیام ها</a>
                                                            <button type='submit' data-id='<?php echo $comment->gcomment_id ?>' class='deletegroupcomment btn btn-danger'>حذف</button>

                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </table>
                                    </div>
                                    <button type="submit" class="float-left btn btn-success btn-sm" data-toggle="modal"
                                            data-target="#send">ارسال تیکت جدید
                                    </button>
                                </div>
                                <div class="tab-pane" id="malis">
                                    <?php
                                    if (isset($malis[0])){
                                        echo ' <table class="table table-bordered">
                        <tr>
                         <th>وضعیت تراکنش</th>
                            <th>مبلغ (ریال)</th>
                            <th>نوع درخواست</th>
                            <th>کد درخواست</th>
                            <th>تاریخ ثبت</th>
                            <th>عملیات</th>
                        </tr>';
                                        foreach ($malis as $mali) {
                                            ?>
                                            <tr>
                                                <td><span class="badge badge-<?php echo $mali->status_class ?>"><?php echo $mali->mali_status ?></span></td>
                                                <td><?php echo number_format($mali->mali_amount) ?></td>
                                                <td><?php echo $mali->mali_model ?></td>
                                                <td><?php echo $mali->model_id ?></a></td>
                                                <td class="ltr"><?php echo verta($mali->mali_create) ?></td>
                                                <td>
                                                    <div class="btn-group btn-group-sm">
                                                        <a href="<?php echo $mali->link.$mali->model_id ?>"
                                                           class="btn btn-warning">جزییات درخواست</a>
                                                        <button type='submit' data-id='<?php echo $mali->mali_id ?>' class='deletemali btn btn-danger'>حذف</button>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php }
                                        echo "</table>";
                                    }
                                    else
                                        echo "<p>موردی وجود ندارد</p>"?>
                                </div>
                                <div class="tab-pane" id="documents">
                                    <?php
                                    if (isset($document[0])) {
                                        echo "<strong><i class='fa fa-book mr-1'></i>فایل های آپلود شده</strong>
                            <div id='prevfiles' class='row'>";
                                        foreach ($document as $file) {
                                            echo "<div class='mt-4 col-md-4 col-sm-12 ltr'>
                                                <label>عنوان: $file->file_title</label>
                                                <div class='form-control'>
                                                   <a class='float-right ml-2' target='_blank' href=$file->file_path><i class='fa fa-search-plus'></i></a>
                                                    <small class='float-left'><i class='fa fa-clock-o'></i>".verta($file->file_create)."</small>
                                                    ";
                                            if (in_array(pathinfo($file->file_path, PATHINFO_EXTENSION),['png','jpeg','jpg']))
                                                echo '<img src='.$file->file_path.'>';
                                            else echo "<a href='$file->file_path' target='_blank'>لینک فایل</a>";
                                            echo "
                                                </div>
            </div>";
                                        }
                                    }
                                    else
                                        echo "<p> موردی ارسال نشده است</p>";
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="send" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">افزودن</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>عنوان تیکت </label>
                            <input type="text" name="label" id="lebel" placeholder="عنوان" class="form-control" required>
                            <label class="ml mt-2" for="txt">تیکت خود را وارد کنید:</label>
                            <textarea name="comment_text" id="comment_text" class="form-control"
                                      rows="3"
                                      placeholder="متن تیکت..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left"
                                data-dismiss="modal">خروج
                        </button>
                        <button type="submit" class="btn btn-primary">ثبت</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="assets/js/bootstrap.bundle.min.js"></script>
<?php
include 'views/partials/footer.php';
?>