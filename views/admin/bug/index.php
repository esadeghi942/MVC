<?php
$title = 'لیست اعلام خرابی ها';
include 'views/partials/header.php';
include 'views/admin/sidebar.php'; ?>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">لیست اعلام خرابی ها</div>
                <div class="card-body">
                    <?php
                    if (isset($bugs[0])){
                        echo ' <table class="table table-bordered">
                        <tr>
                            <th>کد خرابی</th>
                            <th>نام مشتری</th>
                            <th>شماره تماس</th>
                            <th>هزینه</th>
                            <th>وضعیت</th>
                            <th>وضعیت پرداخت</th>
                            <th>تاریخ ثبت</th>
                            <th>عملیات</th>
                        </tr>';
                    foreach ($bugs as $bug) {
                        ?>
                        <tr>
                            <td><?php echo $bug->bug_id ?></td>
                            <td><a href="adminCustomer/?id=<?php echo $bug->user_id ?>"><?php echo $bug->user_name ?></a></td>
                            <td><?php echo $bug->user_phone ?></td>
                            <td><?php echo number_format($bug->bug_payment) ?> ریال </td>
                            <td><span class="badge badge-<?php echo $bug->status_class; ?>"><?php echo $bug->bug_status; ?></span></td>
                            <td><span class="badge badge-<?php echo $bug->status_payment; ?>"><?php echo $bug->bug_payment_status; ?></span></td>
                            <td class="ltr"><?php echo verta($bug->bug_create); ?></td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="adminBug?id=<?php echo $bug->bug_id?>"
                                       class="btn btn-primary">نمایش</a>
                                    <button type="submit" data-id="<?php echo $bug->bug_id; ?>"
                                            class="deletebug btn btn-danger">حذف
                                    </button>
                                </div>
                            </td>
                        </tr>
                    <?php }
                    echo '</table>';
                    }
                    else echo "<p>موردی وجود ندارد</p>";
                        ?>
                </div>
            </div>
        </div>
    </section>
<?php
include 'views/partials/footer.php';
?>