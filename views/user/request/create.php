<?php
$title = 'درخواست فیبر نوری';
include 'views/partials/header.php';
include 'views/user/sidebar.php'; ?>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">درخواست فیبر نوری</div>
                <div class="card-body">
                    <form method="post" enctype="multipart/form-data">
                        <!-- Small boxes (Stat box) -->
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="control-label">وضعیت مالکیت</label>
                                <div class="form-check">
                                    <input name="request_owner" class="form-check-input" checked="checked" type="radio"
                                           value="1">
                                    <label class="form-check-label">مالک</label>
                                </div>
                                <div class="form-check">
                                    <input name="request_owner" class="form-check-input" type="radio" value="0">
                                    <label class="form-check-label">مستاجر</label>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label"> درخواست کارشناسی حضوری و حضور کارشناس در محل را
                                    دارید؟</label>
                                <div class="form-check">
                                    <input name="request_karshenasi" class="form-check-input" type="radio" value="1">
                                    <label class="form-check-label">بله <small>(باید هزینه ایاب و ذهاب به مبلغ <?php  echo (new \Models\Mali())->payment ?>ریال را به صورت آنلاین پرداخت نمایید.)</small></label>
                                </div>
                                <div class="form-check">
                                    <input name="request_karshenasi" class="form-check-input" checked="checked" type="radio"
                                           value="0">
                                    <label class="form-check-label">خیر <small>( به صورت رایگان)</small></label>
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label class="control-label">وضعیت ساختمان</label>
                                <div class="form-check">
                                    <input name="request_buildstatus" class="form-check-input" checked="checked"
                                           type="radio"
                                           value="0">
                                    <label class="form-check-label">درحال ساخت</label>
                                </div>
                                <div class="form-check">
                                    <input name="request_buildstatus" class="form-check-input" type="radio" value="1">
                                    <label class="form-check-label">در حال بازسازی</label>
                                </div>
                                <div class="form-check">
                                    <input name="request_buildstatus" class="form-check-input" type="radio" value="2">
                                    <label class="form-check-label">نوساز</label>
                                </div>
                                <div class="form-check">
                                    <input name="request_buildstatus" class="form-check-input" type="radio" value="3">
                                    <label class="form-check-label">عمر تا 10 سال</label>
                                </div>
                                <div class="form-check">
                                    <input name="request_buildstatus" class="form-check-input" type="radio" value="4">
                                    <label class="form-check-label">بیشتر از 10 سال</label>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label">آیا بستر فیبر نوری در ساختمان وجود دارد ؟</label>
                                <div class="form-check">
                                    <input name="request_base" class="form-check-input" checked="checked" type="radio"
                                           value="0">
                                    <label class="form-check-label">در ساختمان وجود دارد</label>
                                </div>
                                <div class="form-check">
                                    <input name="request_base" class="form-check-input" type="radio" value="1">
                                    <label class="form-check-label">در واحد پریز فیبر نوری وجود دارد</label>
                                </div>
                                <div class="form-check">
                                    <input name="request_base" class="form-check-input" type="radio" value="2">
                                    <label class="form-check-label">در کوچه باکس فیبر نوری وجود دارد</label>
                                </div>
                                <div class="form-check">
                                    <input name="request_base" class="form-check-input" type="radio" value="3">
                                    <label class="form-check-label">همسایه ها سرویس فیبر نوری دارند</label>
                                </div>
                                <div class="form-check">
                                    <input name="request_base" class="form-check-input" type="radio" value="4">
                                    <label class="form-check-label">همسایه ها سرویس فیبر نوری ندارند</label>
                                </div>
                                <div class="form-check">
                                    <input name="request_base" class="form-check-input" type="radio" value="5">
                                    <label class="form-check-label">نمیدانم</label>
                                </div>
                            </div>

                                <div class="form-group col-md-6">
                                    <label class="control-label">نوع کاربری</label>
                                    <div class="form-check">
                                        <input name="request_karbary" class="form-check-input" type="radio"
                                               value="1">
                                        <label class="form-check-label">اداری</label>
                                    </div>
                                    <div class="form-check">
                                        <input name="request_karbary" class="form-check-input" checked="checked" type="radio" value="0">
                                        <label class="form-check-label">مسکونی</label>
                                    </div>
                                </div>
                            <div class="row col-12">
                            <div class="form-group col-md-6">
                                <label class="control-label">تعداد واحد<small class="text-danger">*</small></label>
                                <input placeholder="تعداد واحد" id="request_count_unit" type="text"
                                       class="form-control" required
                                       name="request_count_unit" value="" autofocus>
                            </div>
                            <div class="form-group col-6">
                                <label class="control-label">تعداد درخواست شما<small class="text-danger">*</small></label>
                                <input placeholder="تعداد درخواست شما" id="request_count_request" type="text"
                                       class="form-control" required
                                       name="request_count_request" value="" autofocus>
                            </div>
                            <div class="form-group col-6">
                                <label class="control-label">تعداد متقاضی در ساختمان<small class="text-danger">*</small></label>
                                <input placeholder="تعداد متقاضی در ساختمان" id="request_build_request" type="text"
                                       class="form-control" required
                                       name="request_build_request" value="" autofocus>
                            </div>
                            <div class="form-group col-6">
                                <label class="control-label">تلفن ثابت<small class="text-danger">*</small></label>
                                <input placeholder="تلفن ثابت" id="request_fix_number" type="text"
                                       class="form-control" required
                                       name="request_fix_number" value="" autofocus>
                            </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="control-label">آدرس دقیق برای کارشناسی<small class="text-danger">*</small></label>
                                <textarea name="request_address" class="form-control" required rows="3"></textarea>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="control-label">آپلود عکس باکس فیبر نوری <small>(امکان بارگزاری چندین عکس)</small></label>
                                <input name="request_file[]" multiple="multiple" type="file" class="form-control">
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
<script>
    $('input[name=request_karshenasi]').on('change',function (){
        if($(this).val()==0)
            $('button[type=submit]').html('ثبت');
        else
            $('button[type=submit]').html('پرداخت آنلاین و ثبت درخواست');
    });
</script>
<?php
include 'views/partials/footer.php';
?>