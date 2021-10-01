<?php
$title = 'لیست تیکت ها';
include 'views/partials/header.php';
include 'views/user/sidebar.php'; ?>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">لیست تیکت ها</div>
                <div class="card-body">
                    <?php
                    if (isset($gcomments[0])){  ?>
                        <table class="table table-bordered">
                            <tr>
                                <th>فعال بودن تیکت</th>
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
                                    <td><?php echo $comment->gcomment_label; ?></td>
                                    <td><?php echo $comment->count_unread; ?></td>
                                    <td class="ltr"><?php echo verta($comment->gcomment_create) ; ?></td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a href="userComment?gid=<?php echo $comment->gcomment_id ?>"
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
                    <button type="submit" class="float-left btn btn-success btn-sm mt-2" data-toggle="modal"
                            data-target="#send">ارسال تیکت جدید
                    </button>
                </div>

            </div>
        </div>
    </section>
    <div class="modal fade" id="send" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">افزودن</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>عنوان تیکت </label>
                            <input type="text" name="label" id="lebel" placeholder="عنوان" class="form-control" required>
                            <label class="ml mt-2" for="txt">تیکت خود را وارد کنید:</label>
                            <textarea name="comment_text" id="comment_text" class="form-control"
                                      rows="3"
                                      placeholder="متن تیکت..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left"
                                data-dismiss="modal">خروج
                        </button>
                        <button type="submit" class="btn btn-primary">ثبت</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php
include 'views/partials/footer.php';
?>