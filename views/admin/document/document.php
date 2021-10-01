<?php
$title = 'لیست مدارک ارسال شده';
include 'views/partials/header.php';
include 'views/admin/sidebar.php'; ?>
<style>
    img{
        max-width: 100%;
        max-height: 100%;
    }
</style>
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">مدارک ارسال شده</div>
            <div class="card-body">
                <?php
                if (isset($document[0])) {
                    echo "<strong><i class='fa fa-book mr-1'></i>فایل های آپلود شده</strong>
                            <div id='prevfiles' class='row'>";
                    foreach ($document as $file) {
                        echo "<div class='mt-4 col-md-4 col-sm-12 ltr'>
                                                <label>عنوان: $file->file_title</label>
                                               <div class='form-control'>
                                                   <a class='float-right ml-2' target='_blank' href=$file->file_path><i class='fa fa-search-plus'></i></a>
                                                    <small class='float-left'><i class='fa fa-clock-o'></i>".verta($file->file_create)."</small>
                                                    ";
                        if (in_array(pathinfo($file->file_path, PATHINFO_EXTENSION),['png','jpeg','jpg']))
                            echo '<img src='.$file->file_path.'>';
                        else echo "<a href='$file->file_path' target='_blank'>لینک فایل</a>";
                        echo "
                                                </div>
            </div>";
                    }
                }
                else
                    echo "<p> موردی ارسال نشده است</p>";
                ?>
            </div>
        </div>
    </div>
</section>
<?php
include "views/partials/footer.php";
?>
