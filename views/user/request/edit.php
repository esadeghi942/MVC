<?php
$title = 'ویرایش فیبر نوری';
include 'views/partials/header.php';
include 'views/user/sidebar.php'; ?>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">ویرایش فیبر نوری</div>
                <div class="card-body">
                    <form method="post" enctype="multipart/form-data">
                        <!-- Small boxes (Stat box) -->
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="control-label">وضعیت مالکیت</label>
                                <div class="form-check">
                                    <input name="request_owner"
                                           class="form-check-input" <?php echo $request->request_owner == 1 ? 'checked="checked"' : '' ?>
                                           type="radio"
                                           value="1">
                                    <label class="form-check-label">مالک</label>
                                </div>
                                <div class="form-check">
                                    <input name="request_owner"
                                           class="form-check-input" <?php echo $request->request_owner == 0 ? 'checked="checked"' : '' ?>
                                           type="radio" value="0">
                                    <label class="form-check-label">مستاجر</label>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label"> درخواست کارشناسی حضوری و حضور کارشناس در محل را
                                    دارید؟</label>
                                <div class="form-check">
                                    <input name="request_karshenasi"
                                           class="form-check-input" <?php echo $request->request_karshenasi == 1 ? 'checked="checked"' : '' ?>
                                           type="radio" value="1">
                                    <label class="form-check-label">بله</label>
                                </div>
                                <div class="form-check">
                                    <input name="request_karshenasi"
                                           class="form-check-input" <?php echo $request->request_karshenasi == 0 ? 'checked="checked"' : '' ?>
                                           type="radio" value="0">
                                    <label class="form-check-label">خیر</label>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label">وضعیت ساختمان</label>
                                <div class="form-check">
                                    <input name="request_buildstatus" class="form-check-input" checked="checked"
                                           type="radio" <?php echo $request->request_buildstatus == 0 ? 'checked="checked"' : '' ?>
                                           value="0">
                                    <label class="form-check-label">درحال ساخت</label>
                                </div>
                                <div class="form-check">
                                    <input name="request_buildstatus" class="form-check-input"
                                           type="radio" <?php echo $request->request_buildstatus == 1 ? 'checked="checked"' : '' ?>
                                           value="1">
                                    <label class="form-check-label">در حال بازسازی</label>
                                </div>
                                <div class="form-check">
                                    <input name="request_buildstatus" class="form-check-input"
                                           type="radio" <?php echo $request->request_buildstatus == 2 ? 'checked="checked"' : '' ?>
                                           value="2">
                                    <label class="form-check-label">نوساز</label>
                                </div>
                                <div class="form-check">
                                    <input name="request_buildstatus" class="form-check-input"
                                           type="radio" <?php echo $request->request_buildstatus == 3 ? 'checked="checked"' : '' ?>
                                           value="3">
                                    <label class="form-check-label">عمر تا 10 سال</label>
                                </div>
                                <div class="form-check">
                                    <input name="request_buildstatus" class="form-check-input"
                                           type="radio" <?php echo $request->request_buildstatus == 4 ? 'checked="checked"' : '' ?>
                                           value="4">
                                    <label class="form-check-label">بیشتر از 10 سال</label>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label">آیا بستر فیبر نوری در ساختمان وجود دارد ؟</label>
                                <div class="form-check">
                                    <input name="request_base" class="form-check-input" checked="checked"
                                           type="radio" <?php echo $request->request_base == 0 ? 'checked="checked"' : '' ?>
                                           value="0">
                                    <label class="form-check-label">در ساختمان وجود دارد</label>
                                </div>
                                <div class="form-check">
                                    <input name="request_base" class="form-check-input"
                                           type="radio" <?php echo $request->request_base == 1 ? 'checked="checked"' : '' ?>
                                           value="1">
                                    <label class="form-check-label">در واحد پریز فیبر نوری وجود دارد</label>
                                </div>
                                <div class="form-check">
                                    <input name="request_base" class="form-check-input"
                                           type="radio" <?php echo $request->request_base == 2 ? 'checked="checked"' : '' ?>
                                           value="2">
                                    <label class="form-check-label">در کوچه باکس فیبر نوری وجود دارد</label>
                                </div>
                                <div class="form-check">
                                    <input name="request_base" class="form-check-input"
                                           type="radio" <?php echo $request->request_base == 3 ? 'checked="checked"' : '' ?>
                                           value="3">
                                    <label class="form-check-label">همسایه ها سرویس فیبر نوری دارند</label>
                                </div>
                                <div class="form-check">
                                    <input name="request_base" class="form-check-input"
                                           type="radio" <?php echo $request->request_base == 4 ? 'checked="checked"' : '' ?>
                                           value="4">
                                    <label class="form-check-label">همسایه ها سرویس فیبر نوری ندارند</label>
                                </div>
                                <div class="form-check">
                                    <input name="request_base" class="form-check-input"
                                           type="radio" <?php echo $request->request_base == 5 ? 'checked="checked"' : '' ?>
                                           value="5">
                                    <label class="form-check-label">نمیدانم</label>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label">تعداد واحد</label>
                                <input placeholder="تعداد واحد" id="request_count_unit" type="text"
                                       class="form-control"
                                       name="request_count_unit" value="<?php echo $request->request_count_unit; ?>"
                                       autofocus>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label">تعداد درخواست شما</label>
                                <input placeholder="تعداد درخواست شما" id="request_count_request" type="text"
                                       class="form-control"
                                       name="request_count_request" value="<?php echo $request->request_count_unit; ?>"
                                       autofocus>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label">تعداد متقاضی در ساختمان</label>
                                <input placeholder="تعداد متقاضی در ساختمان" id="request_build_request" type="text"
                                       class="form-control"
                                       name="request_build_request"
                                       value="<?php echo $request->request_build_request; ?>" autofocus>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label">تلفن ثابت</label>
                                <input placeholder="تلفن ثابت" id="request_fix_number" type="text"
                                       class="form-control"
                                       name="request_fix_number" value="<?php echo $request->request_fix_number; ?>"
                                       autofocus>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="control-label">آدرس دقیق برای کارشناسی</label>
                                <textarea name="request_address" class="form-control"
                                          rows="3"><?php echo $request->request_address; ?>
                                </textarea>
                            </div>

                            <div class="form-group col-md-12">
                                <label class="control-label">آپلود عکس باکس فیبر نوری</label>
                                <input name="request_file[]" multiple="multiple" type="file" class="form-control">

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
                            <div class="form-group col-md-12">
                                <p>توضیح بیشتر :</p>
                                شما خودتان می توانید وضعیت بستر سازی فیبر نوری را با
                                مطالعه
                                <a>این مقاله </a>مشخص کنید.
                            </div>
                            <!-- ./col -->
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