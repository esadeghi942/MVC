<?php
$title = 'لیست درخواست های فیبر نوری';
include 'views/partials/header.php';
include 'views/user/sidebar.php'; ?>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">لیست درخواست های فیبر نوری</div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>کد درخواست</th>
                            <th>وضعیت درخواست</th>
                            <th>درخواست کارشناسی</th>
                            <th>تلفن ثابت</th>
                            <th>عملیات</th>
                        </tr>
                        <?php
                        if (isset($requests))
                            foreach ($requests as $request) {
                                ?>
                                <tr>
                                    <td><?php echo $request->request_id; ?></td>
                                    <td><?php echo $request->request_status; ?></td>
                                    <td><?php echo $request->request_karshenasi; ?></td>
                                    <td><?php echo $request->request_fix_number; ?></td>
                                    <td>
                                        <div class="btn-group btn-group-xs">
                                            <div class="btn-group btn-group-xs">
                                                <a href="userRequestUpdate?id=<?php echo $request->request_id; ?>"
                                                   class="btn btn-primary">ویرایش</a>
                                                <button type="submit" data-id="<?php echo $request->request_id; ?>" class="deleterequest btn btn-danger">حذف</button>
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