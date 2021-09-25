<?php
$title = 'لیست مدارک ارسال شده';
include 'views/partials/header.php';
include 'views/user/sidebar.php'; ?>
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
                        echo "<div class='item mt-2 col-md-3 col-sm-12'>
                                                <div class='form-control'>
                                                    <a target='_blank' href=$file->file_path
                                                       class='ltr'>$file->file_title</a>
                    <a class='close deletefile' alt='delete'
                       data-file=$file->file_id>×</a>
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
