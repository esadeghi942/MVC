<?php
if(\Systems\Url::get('karshenasi') !==null && \Systems\Url::get('karshenasi')==1)
    $title='لیست درخواست کارشناسی';
else
    $title = 'لیست درخواست های فیبر نوری';
include 'views/partials/header.php';
include 'views/admin/sidebar.php'; ?>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header"><?php echo $title; ?></div>
                <div class="card-body">
                        <?php
                        if (isset($requests[0])){
                            echo ' <table class="table table-bordered">
                        <tr>
                            <th>کد درخواست</th>
                            <th>نام مشتری</th>
                            <th>شماره تماس</th>
                            <th>درخواست کارشناسی</th>
                            <th>وضعیت پرداخت</th>
                            <th>تاریخ ثبت</th>
                            <th>وضعیت درخواست</th>
                            <th>عملیات</th>
                        </tr>';
                            foreach ($requests as $request) {
                                ?>
                                <tr style="background-color: <?php echo $request->color ?>">
                                    <td><?php echo $request->request_id; ?></td>
                                    <td><a href="adminCustomer/?id=<?php echo $request->user_id ?>"><?php echo $request->user_name ?></a></td>
                                    <td><?php echo $request->user_phone; ?></td>
                                    <td><span class="badge badge-<?php echo $request->karsh_class ?>"><?php echo $request->request_karshenasi ?></span></td>
                                    <td><span class="badge badge-<?php echo $request->request_payment_class ?>"><?php echo $request->request_payment_status ?></span></td>
                                    <td class="ltr"><?php echo verta($request->request_create) ?></td>
                                    <td><span class="badge badge-<?php echo $request->status_class ?>"><?php echo $request->request_status ?></span></td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                                <a href="adminRequest?id=<?php echo $request->request_id ?>"
                                                   class="btn btn-primary">نمایش</a>
                                            <button type='submit' data-id="<?php echo $request->request_id ?>"  class='deleterequest btn btn-danger'>حذف</button>
                                        </div>
                                    </td>
                                </tr>
                            <?php }
                            echo "</table>";
                        }
                        else
                            echo "<p>موردی وجود ندارد</p>"?>
                </div>
            </div>
        </div>
    </section>
<?php
include 'views/partials/footer.php';
?>