<?php
$title = 'لیست اعلام خرابی ها';
include 'views/partials/header.php';
include 'views/user/sidebar.php'; ?>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">لیست اعلام خرابی ها</div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>کد اعلام خرابی</th>
                            <th>وضعیت </th>
                            <th>شماره مجازی</th>
                            <th>پاسخ ارسالی</th>
                            <th>عملیات</th>
                        </tr>
                        <?php
                        if (isset($bugs))
                            foreach ($bugs as $bug) {
                                ?>
                                <tr>
                                    <td><?php echo $bug->bug_id; ?></td>
                                    <td><?php echo $bug->bug_status; ?></td>
                                    <td><?php echo $bug->bug_virtual_number; ?></td>
                                    <td><?php echo $bug-> bug_answer ; ?></td>
                                    <td>
                                        <div class="btn-group btn-group-xs">
                                            <div class="btn-group btn-group-xs">
                                                <a href="userBugUpdate?id=<?php echo $bug->bug_id; ?>"
                                                   class="btn btn-primary">ویرایش</a>
                                                <button type="submit" data-id="<?php echo $bug->bug_id; ?>" class="deletebug btn btn-danger">حذف</button>
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