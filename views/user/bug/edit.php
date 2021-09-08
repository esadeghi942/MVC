<?php
$title = 'ویرایش اعلام خرابی';
include 'views/partials/header.php';
include 'views/user/sidebar.php'; ?>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">ویرایش اعلام خرابی</div>
                <div class="card-body">
                    <form method="post" enctype="multipart/form-data">
                        <!-- Small boxes (Stat box) -->
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="control-label">شماره مجازی</label>
                                <input placeholder="شماره مجازی" id="bug_virtual_number" type="text"
                                       class="form-control"
                                       name="bug_virtual_number" value="<?php echo $bug->bug_virtual_number; ?>" autofocus>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="control-label">وضعیت چراغ پان مودم</label>
                                <div class="form-check">
                                    <input name="bug_pan" class="form-check-input"
                                           type="radio" <?php echo $bug->bug_pan == 0 ? 'checked="checked"' : '' ?>
                                           value="0">
                                    <label class="form-check-label">سبز روشن و ثابت</label>
                                </div>
                                <div class="form-check">
                                    <input name="bug_pan" class="form-check-input"
                                           type="radio" <?php echo $bug->bug_pan == 1 ? 'checked="checked"' : '' ?>
                                           value="1">
                                    <label class="form-check-label">سبز روشن و چشمک زن</label>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="control-label">وضعیت چراغ لاست مودم</label>
                                <div class="form-check">
                                    <input name="bug_last" class="form-check-input"
                                           type="radio" <?php echo $bug->bug_last == 0 ? 'checked="checked"' : '' ?>
                                           value="0">
                                    <label class="form-check-label">قرمز روشن و چشمک زن</label>
                                </div>
                                <div class="form-check">
                                    <input name="bug_last" class="form-check-input"
                                           type="radio" <?php echo $bug->bug_last == 1 ? 'checked="checked"' : '' ?>
                                           value="1">
                                    <label class="form-check-label">خاموش</label>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="control-label">شرح خرابی</label>
                                <textarea name="bug_description" class="form-control" rows="3"><?php echo $bug->bug_description; ?></textarea>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="control-label">آپلود عکس</label>
                                <input name="bug_file[]" multiple="multiple" type="file" class="form-control">
                                <div id="prevfiles" class="row">
                                    <?php
                                    if (isset($files))
                                        foreach ($files as $file) { ?>
                                            <div class="item mt-2 col-md-3 col-sm-12">
                                                <div class="form-control">
                                                    <a target="_blank" href="<?php echo $file->file_path; ?>"
                                                       class="ltr"><?php echo $file->file_title ?></a>
                                                    <a class="close deletefile" alt="delete"
                                                       data-file="<?php echo $file->file_id ?>">×</a>
                                                </div>
                                            </div>
                                        <?php } ?>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-flat mb-2">ثبت</button>
                    </form>
                </div>
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
<?php
include 'views/partials/footer.php';
?>