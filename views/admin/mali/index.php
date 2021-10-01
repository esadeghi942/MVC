<?php
$title = 'لیست تراکنش ها';
include 'views/partials/header.php';
include 'views/admin/sidebar.php'; ?>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header"><?php echo $title; ?></div>
                <div class="card-body">
                    <?php
                    if (isset($malis[0])){
                        echo ' <table class="table table-bordered">
                        <tr>
                            <th>نام مشتری</th>
                            <th>شماره تماس</th>
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
                                <td><a href="adminCustomer/?id=<?php echo $mali->user_id ?>"><?php echo $mali->user_name ?></a></td>
                                <td><?php echo $mali->user_phone ?></td>
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
            </div>
        </div>
    </section>
<?php
include 'views/partials/footer.php';
?>