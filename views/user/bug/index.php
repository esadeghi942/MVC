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
                            <th>پاسخ ارسالی</th>
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
                                <td><?php echo $bug->bug_answer; ?></td>
                                <td>
                                    <div class="btn-group btn-group-xs">
                                        <div class="btn-group btn-group-xs">
                                            <a href="userBugUpdate?id=<?php echo $bug->bug_id; ?>"
                                               class="btn btn-primary">ویرایش</a>
                                            <a href="userBug?id=<?php echo $bug->bug_id; ?>"
                                               class="btn btn-info">نمایش</a>
                                            <button type="submit" data-id="<?php echo $bug->bug_id; ?>"
                                                    class="deletebug btn btn-danger">حذف
                                            </button>
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