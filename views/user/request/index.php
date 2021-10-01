<?php
$title = 'لیست درخواست های فیبر نوری';
include 'views/partials/header.php';
include 'views/user/sidebar.php'; ?>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">لیست درخواست های فیبر نوری</div>
                <div class="card-body">
                    <?php if(isset($requests[0])) {?>
                    <table class="table table-bordered">
                        <tr>
                            <th>کد درخواست</th>
                            <th>درخواست کارشناسی</th>
                            <th>وضعیت</th>
                            <th>تاریخ ثبت</th>
                            <th>عملیات</th>
                        </tr>
                        <?php
                            foreach ($requests as $request) {
                                ?>
                                <tr>
                                    <td><?php echo $request->request_id; ?></td>
                                    <td><span class='badge badge-<?php echo $request->karsh_class;?>'><?php echo $request->request_karshenasi; ?></span></td>
                                    <td><span class='badge badge-<?php echo $request->status_class;?>'><?php echo $request->request_status; ?></span></td>
                                    <td class="ltr"><?php echo verta($request->request_create); ?></td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a href="userRequestUpdate?id=<?php echo $request->request_id; ?>"
                                               class="btn btn-success">ویرایش</a>
                                            <a href="userRequest?id=<?php echo $request->request_id; ?>"
                                               class="btn btn-primary">نمایش</a>
                                            <?php
                                            if($request->request_status == 'مشاهده نشده')
                                                echo "<button type='submit' data-id='$request->request_id' class='deleterequest btn btn-danger'>حذف</button>";
                                            if($request->request_karshenasi== 'بله' && $request-> request_payment_status ==0)
                                                echo "<a href='payment?request_id=$request->request_id' class='btn btn-warning'>پرداخت هزینه کارشناسی<small>(به مبلغ ".number_format($payment). " ریال) <a/></small>";
                                             ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php }
                            echo "</table>";
                        }
                        else
                            echo "<p>موردی وجود ندارد</p>";
                            ?>
                </div>
            </div>
        </div>
    </section>
<?php
include 'views/partials/footer.php';
?>