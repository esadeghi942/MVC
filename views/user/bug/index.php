<?php
$title = 'لیست اعلام خرابی ها';
include 'views/partials/header.php';
include 'views/user/sidebar.php'; ?>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">لیست اعلام خرابی ها</div>
                <div class="card-body">
                    <?php if (isset($bugs[0])){ ?>
                    <table class="table table-bordered">
                        <tr>
                            <th>کداعلام خرابی</th>
                            <th>شماره مجازی</th>
                            <th>زمان ثبت</th>
                            <th>وضعیت</th>
                            <th>هزینه</th>
                            <th>عملیات</th>
                        </tr>
                        <?php
                        foreach ($bugs as $bug) {
                            ?>
                            <tr>
                                <td><?php echo $bug->bug_id; ?></td>
                                <td><?php echo $bug->bug_virtual_number; ?></td>
                                <td class="ltr"><?php echo verta($bug->bug_create); ?></td>
                                <td>
                                    <span class='badge badge-<?php echo $bug->status_class; ?>'><?php echo $bug->bug_status; ?></span>
                                </td>
                                <td><?php echo isset($bug->bug_payment) ? number_format($bug->bug_payment) .' ریال' : "<span class='badge badge-warning'>اعلام نشده</span>"?></td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="userBugUpdate?id=<?php echo $bug->bug_id; ?>"
                                           class="btn btn-success">ویرایش</a>
                                        <a href="userBug?id=<?php echo $bug->bug_id; ?>"
                                           class="btn btn-primary">نمایش</a>
                                        <button type="submit" data-id="<?php echo $bug->bug_id; ?>"
                                                class="deletebug btn btn-danger">حذف
                                        </button>
                                        <?php
                                        if($bug->bug_payment !== null && !intval($bug->bug_payment_status))
                                            echo "<a href='payment?bug_id=$bug->bug_id'
                                               class='btn btn-warning'>پرداخت هزینه</a>";
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