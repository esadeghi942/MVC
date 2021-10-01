<?php
$title = 'لیست تیکت های مشتریان';
include 'views/partials/header.php';
include 'views/admin/sidebar.php'; ?>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">لیست تیکت های مشتریان</div>
                <div class="card-body">
                    <?php
                         if (isset($gcomments[0])){  ?>
                    <table class="table table-bordered">
                        <tr>
                            <th>فعال بودن تیکت</th>
                            <th>نام مشتری</th>
                            <th>عنوان تیکت</th>
                            <th>تعداد پیام خوانده نشده</th>
                            <th> تاریخ ایجاد</th>
                            <th>عملیات</th>
                        </tr>
                        <?php
                            foreach ($gcomments as $comment) {
                                ?>
                                <tr>
                                    <td><?php echo $comment->gcomment_active? '<span class="badge badge-success">باز</span>' : '<span class="badge badge-danger">بسته</span>' ?></td>
                                    <td><a href="adminCustomer/?id=<?php echo $comment->user_id ?>"><?php echo $comment->user_name; ?></a></td>
                                    <td><?php echo $comment->gcomment_label; ?></td>
                                    <td><?php echo $comment->count_unread; ?></td>
                                    <td class="ltr"><?php echo verta($comment->gcomment_create) ; ?></td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                                <a href="adminUserCommnet?gid=<?php echo $comment->gcomment_id ?>"
                                                   class="btn btn-primary">نمایش پیام ها</a>
                                            <button type='submit' data-id='<?php echo $comment->gcomment_id ?>' class='deletegroupcomment btn btn-danger'>حذف</button>
                                            <a href="groupCommentTClose?id=<?php echo $comment->gcomment_id ?>"
                                               class="btn btn-warning"><?php echo $comment->gcomment_active ? 'بستن تیکت':'فعال کردن ' ?></a>

                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                    </table>
                             <?php
                         }
                         else {
                             echo "<p>موردی وجود ندارد</p>";
                         }
                         ?>
                </div>
            </div>
        </div>
    </section>
<?php
include 'views/partials/footer.php';
?>