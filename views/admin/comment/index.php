<?php
$title = 'لیست تیکت های مشتریان';
include 'views/partials/header.php';
include 'views/admin/sidebar.php'; ?>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">لیست تیکت های مشتریان</div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>نام مشتری</th>
                            <th>آخرین تاریخ کامنت</th>
                            <th>آخرین متن کامنت</th>
                            <th>تعداد پیام خوانده نشده</th>
                            <th>عملیات</th>
                        </tr>
                        <?php
                        if (isset($comments))
                            foreach ($comments as $comment) {
                                ?>
                                <tr>
                                    <td><?php echo $comment->user_name; ?></td>
                                    <td><?php echo verta($comment->comment_create) ; ?></td>
                                    <td><?php echo $comment->comment_text; ?></td>
                                    <td><?php echo $comment->count_unread; ?></td>
                                    <td>
                                        <div class="btn-group btn-group-xs">
                                            <div class="btn-group btn-group-xs">
                                                <a href="adminUserCommnet?id=<?php echo $comment->user_id; ?>"
                                                   class="btn btn-primary">ارسال پاسخ</a>
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