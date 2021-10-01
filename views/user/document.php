<?php
$title = 'لیست مدارک ارسال شده';
include 'views/partials/header.php';
include 'views/user/sidebar.php'; ?>
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
                <form method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-4">
                            <label class="control-label">عنوان مدرک</label>
                            <input placeholder="عنوان مدرک" id="title" type="text"
                                   class="form-control mb-2" name="title[]" value="" autofocus>
                            <input name="file[]" type="file" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label class="control-label">عنوان مدرک</label>
                            <input placeholder="عنوان مدرک" id="title" type="text"
                                   class="form-control mb-2" name="title[]" value="" autofocus>
                            <input name="file[]" type="file" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label class="control-label">عنوان مدرک</label>
                            <input placeholder="عنوان مدرک" id="title[]" type="text"
                                   class="form-control mb-2" name="title[]" value="" autofocus>
                            <input name="file[]" type="file" class="form-control">
                        </div>
                    </div>
                    <button type='submit' class='btn btn-primary btn-flat mt-2 mb-3'>ثبت</button>
                </form>
                <?php
                if (isset($document[0])) {
                    echo "<strong><i class='fa fa-book mr-1'></i>فایل های آپلود شده</strong>
                            <div id='prevfiles' class='row'>";
                    foreach ($document as $file) {
                        echo "<div class='mt-4 item col-md-4 col-sm-12 ltr'>
<a class='close deletefile float-left' alt='delete' data-file=$file->file_id>×</a>
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
                ?>
            </div>
        </div>
    </div>
</section>
<?php
include "views/partials/footer.php";
?>
