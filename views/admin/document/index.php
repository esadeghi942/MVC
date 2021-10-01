<?php
$title = 'لیست مدارک ارسالی';
include 'views/partials/header.php';
include 'views/admin/sidebar.php'; ?>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header"><?php echo $title; ?></div>
                <div class="card-body">
                    <?php
                    if (isset($documents[0])){
                        echo ' <table class="table table-bordered">
                        <tr>
                            <th>نام مشتری</th>
                            <th>شماره تماس</th>
                            <th>تعداد مدارک</th>
                            <th>تاریخ ثبت</th>
                            <th>عملیات</th>
                        </tr>';
                        foreach ($documents as $document) {
                            ?>
                            <tr>
                                <td><a href="adminCustomer/?id=<?php echo $document->user_id ?>"><?php echo $document->user_name ?></a></td>
                                <td><?php echo $document->user_phone; ?></td>
                                <td><?php echo $document->count ?></td>
                                <td class="ltr"><?php echo verta($document->file_create) ?></td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="adminDocument?id=<?php echo $document->user_id ?>"
                                           class="btn btn-primary">نمایش</a>
                                        <button type='submit' data-id='<?php echo $document->user_id ?>' class='deletedocument btn btn-danger'>حذف</button>
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