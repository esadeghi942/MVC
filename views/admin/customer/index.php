<?php
$title = 'لیست مشتریان';
include 'views/partials/header.php';
include 'views/admin/sidebar.php'; ?>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">لیست مشتریان</div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>نام مشتری</th>
                            <th>شماره موبایل</th>
                            <th>تلفن ثابت</th>
                            <th>تاریخ ثبت</th>
                            <th>عملیات</th>
                        </tr>
                        <?php
                        if (!isset($customers))
                            echo "<div>.هیچ مشتری یافت نشد</div>";
                            foreach ($customers as $customer) {
                                ?>
                                <tr>
                                    <td><a href="adminCustomer?id=<?php echo $customer->user_id; ?>">
                                        <?php echo $customer->user_name; ?></a></td>
                                    <td><?php echo $customer->user_phone; ?></td>
                                    <td><?php echo $customer->user_fix_number; ?></td>
                                    <td class="ltr"><?php echo verta($customer->user_create); ?></td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <button type="submit" data-id="<?php echo $customer->user_id ?>"
                                                    class="deletecustomer btn btn-danger">حذف
                                            </button>
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