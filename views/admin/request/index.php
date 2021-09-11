<?php
$title = 'لیست درخواست های فیبر نوری';
include 'views/partials/header.php';
include 'views/admin/sidebar.php'; ?>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">لیست درخواست های فیبر نوری</div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>نام مشتری</th>
                            <th>شماره تماس</th>
                            <th>درخواست کارشناسی</th>
                            <th>تلفن ثابت</th>
                            <th>وضعیت درخواست</th>
                            <th>عملیات</th>
                        </tr>
                        <?php
                        if (isset($requests))
                            foreach ($requests as $request) {
                                ?>
                                <tr>
                                    <td><?php echo $request->user_name; ?></td>
                                    <td><?php echo $request->user_phone; ?></td>
                                    <td><?php echo $request->request_karshenasi; ?></td>
                                    <td><?php echo $request->request_fix_number; ?></td>
                                    <td><?php echo $request->request_status; ?></td>
                                    <td>
                                        <div class="btn-group btn-group-xs">
                                            <div class="btn-group btn-group-xs">
                                                <a href="adminRequest?id=<?php echo $request->request_id; ?>"
                                                   class="btn btn-primary">نمایش</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                    </table>
                </div>
            </div>
        </div>
    </section>
<?php
include 'views/partials/footer.php';
?>