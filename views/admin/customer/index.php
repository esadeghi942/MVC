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
                            <th>نام شرکت</th>
                            <th>نام نماینده</th>
                            <th>آدرس</th>
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
                                    <td><?php echo $customer->cu_company; ?></td>
                                    <td><?php echo $customer->cu_namayande; ?></td>
                                    <td><?php echo $customer->cu_addresss; ?></td>
                                    <td><?php echo verta($customer->cu_create); ?></td>
                                    <td>
                                        <div class="btn-group btn-group-xs">
                                            <div class="btn-group btn-group-xs">
                                                <a href="adminDeleteCustomer?id=<?php echo $customer->user_id; ?>"
                                                   class="btn btn-primary">حذف</a>
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