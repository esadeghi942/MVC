<?php
$title = 'لیست مدیران سایت';
include 'views/partials/header.php';
include 'views/admin/sidebar.php'; ?>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">لیست مدیران سایت</div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>نام </th>
                            <th>مسيولیت</th>
                            <th>شماره تماس</th>
                            <th>تاریخ ثبت</th>
                            <th>عملیات</th>
                        </tr>
                        <?php
                        if (isset($users))
                            foreach ($users as $user) {
                                ?>
                                <tr>
                                    <td><?php echo $user->user_name; ?></td>
                                    <td><?php echo $user->user_type; ?></td>
                                    <td><?php echo $user->user_phone; ?></td>
                                    <td><?php echo verta($user->user_create) ; ?></td>
                                    <td>
                                        <div class="btn-group btn-group-xs">
                                            <div class="btn-group btn-group-xs">
                                                <a href="adminUserEdit?id=<?php echo $user->user_id; ?>"
                                                   class="btn btn-primary">ویرایش</a>
                                                <button type="submit"
                                                        data-id="<?php echo $user->user_id; ?>"
                                                        class="deleteuser btn btn-danger btn-flat btn-xs">
                                                    حذف
                                                </button>
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
<script type="text/javascript" src="assets/js/admin.js"></script>
<?php
include 'views/partials/footer.php';
?>