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
                            <th>نام مشتری</th>
                            <th>شماره تماس</th>
                            <th>توضیحات خرابی</th>
                            <th>وضعیت</th>
                            <th>تاریخ ثبت</th>
                            <th>عملیات</th>
                        </tr>';
                    foreach ($bugs as $bug) {
                        ?>
                        <tr>
                            <td><?php echo $bug->user_name; ?></td>
                            <td><?php echo $bug->user_phone; ?></td>
                            <td class="w-50"><?php echo $bug->bug_description; ?></td>
                            <td><span class="badge badge-<?php echo $bug->status_class; ?>"><?php echo $bug->bug_status; ?></span></td>
                            <td class="ltr"><?php echo verta($bug->bug_create); ?></td>
                            <td>
                                <div class="btn-group btn-group-xs">
                                    <div class="btn-group btn-group-xs">
                                        <a href="adminBug?id=<?php echo $bug->bug_id; ?>"
                                           class="btn btn-primary">نمایش</a>
                                    </div>
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