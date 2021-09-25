<?php
$title = 'اعلام خرابی';
include 'views/partials/header.php';
include 'views/user/sidebar.php'; ?>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">اعلام خرابی</div>
                <div class="card-body">
                    <form method="post" enctype="multipart/form-data">
                        <!-- Small boxes (Stat box) -->
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="control-label">شماره مجازی</label>
                                <input placeholder="شماره مجازی" id="bug_virtual_number" type="text"
                                       class="form-control" required
                                       name="bug_virtual_number" value="" autofocus>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="control-label">وضعیت چراغ پان مودم</label>
                                <div class="form-check">
                                    <input name="bug_pan" class="form-check-input" checked="checked" type="radio"
                                           value="0">
                                    <label class="form-check-label">سبز روشن و ثابت</label>
                                </div>
                                <div class="form-check">
                                    <input name="bug_pan" class="form-check-input" type="radio" value="1">
                                    <label class="form-check-label">سبز روشن و چشمک زن</label>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="control-label">وضعیت چراغ لاست مودم</label>
                                <div class="form-check">
                                    <input name="bug_last" class="form-check-input" checked="checked" type="radio"
                                           value="0">
                                    <label class="form-check-label">قرمز روشن و چشمک زن</label>
                                </div>
                                <div class="form-check">
                                    <input name="bug_last" class="form-check-input" type="radio" value="1">
                                    <label class="form-check-label">خاموش</label>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="control-label">شرح خرابی</label>
                                <textarea name="bug_description" required class="form-control" rows="3"></textarea>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="control-label">آپلود عکس </label>
                                <input name="bug_file[]" multiple="multiple" type="file" class="form-control">
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