<?php
$title = 'لیست درخواست های فیبر نوری';
include 'views/partials/header.php';
include 'views/admin/sidebar.php'; ?>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">لیست درخواست های فیبر نوری</div>
                <div class="card-body">
                        <?php
                        if (isset($requests[0])){
                            echo ' <table class="table table-bordered">
                        <tr>
                            <th>نام مشتری</th>
                            <th>شماره تماس</th>
                            <th>درخواست کارشناسی</th>
                            <th>تاریخ ثبت</th>
                            <th>وضعیت درخواست</th>
                            <th>عملیات</th>
                        </tr>';
                            foreach ($requests as $request) {
                                ?>
                                <tr>
                                    <td><?php echo $request->user_name; ?></td>
                                    <td><?php echo $request->user_phone; ?></td>
                                    <td><?php echo $request->request_karshenasi; ?></td>
                                    <td class="ltr"><?php echo verta($request->request_create); ?></td>
                                    <td><span class="badge badge-<?php echo $request->status_class; ?>"><?php echo $request->request_status; ?></span></td>
                                    <td>
                                        <div class="btn-group btn-group-xs">
                                            <div class="btn-group btn-group-xs">
                                                <a href="adminRequest?id=<?php echo $request->request_id; ?>"
                                                   class="btn btn-primary">نمایش</a>
                                            </div>
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