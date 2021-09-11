<?php
$title = 'لیست اعلام خرابی ها';
include 'views/partials/header.php';
include 'views/admin/sidebar.php'; ?>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">لیست اعلام خرابی ها</div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>نام مشتری</th>
                            <th>شماره تماس</th>
                            <th>شماره مجازی</th>
                            <th>توضیحات خرابی</th>
                            <th>وضعیت</th>
                            <th>عملیات</th>
                        </tr>
                        <?php
                        if (isset($bugs))
                            foreach ($bugs as $bug) {
                                ?>
                                <tr>
                                    <td><?php echo $bug->user_name; ?></td>
                                    <td><?php echo $bug->user_phone; ?></td>
                                    <td><?php echo $bug->bug_virtual_number; ?></td>
                                    <td><?php echo $bug->bug_description; ?></td>
                                    <td><?php echo $bug->bug_status; ?></td>
                                    <td>
                                        <div class="btn-group btn-group-xs">
                                            <div class="btn-group btn-group-xs">
                                                <a href="adminBug?id=<?php echo $bug->bug_id; ?>"
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