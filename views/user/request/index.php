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
                                    <td><?php echo $request->request_karshenasi; ?></td>
                                    <td><span class='badge badge-<?php echo $request->status_class;?>'><?php echo $request->request_status; ?></span></td>
                                    <td class="ltr"><?php echo verta($request->request_create); ?></td>
                                    <td>
                                        <div class="btn-group btn-group-xs">
                                            <div class="btn-group btn-group-xs">
                                                <a href="userRequestUpdate?id=<?php echo $request->request_id; ?>"
                                                   class="btn btn-info">ویرایش</a>
                                                <a href="userRequest?id=<?php echo $request->request_id; ?>"
                                                   class="btn btn-primary">نمایش</a>
                                                <button type="submit" data-id="<?php echo $request->request_id; ?>" class="deleterequest btn btn-danger">حذف</button>
                                            </div>
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