<?php
$title = 'جزییات اعلام خرابی';
include 'views/partials/header.php';
include 'views/admin/sidebar.php'; ?>
    <style>
        body {
            padding-right: 0 !important;
        }
    </style>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">جزییات اعلام خرابی
                    <button type="submit" class="float-left replyrequest btn btn-success btn-sm" data-toggle="modal"
                            data-target="#postanswer">ارسال پاسخ
                    </button>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class='col-md-6'><strong>نام مشتری</strong>
                            <p class='text-muted'>
                                <a href=adminCustomer/?id=<?php echo $user['user_id'].">".$user['user_name']."</a>"; ?>
                            </p>
                            <hr>
                        </div>

                        <div class='col-md-6'><strong>شماره موبایل</strong>
                            <p class='text-muted'>
                                <?php echo $user['user_phone'] ?>
                            </p>
                            <hr>
                        </div>

                        <div class='col-md-6'><strong> شماره مجازی</strong>
                            <p class='text-muted'>
                                <?php echo $bug->bug_virtual_number ?>
                            </p>
                            <hr>
                        </div>
                        <div class='col-md-6'><strong>هزینه(ریال)</strong>
                            <p class='text-muted'>
                                <?php echo !empty($bug->bug_payment) ? number_format($bug->bug_payment) : 'اعلام نشده' ?>
                            </p>
                            <hr>
                        </div>
                        <div class='col-md-6'><strong>تاریخ ثبت خرابی</strong>
                            <p class='text-muted ltr'>
                                <?php echo $bug->bug_create ?>
                            </p>
                            <hr>
                        </div>
                        <div class='col-md-6'><strong> وضعیت</strong>
                            <p class='text-muted'>
                                <?php echo $bug->bug_status ?>
                            </p>
                            <hr>
                        </div>
                        <div class='col-md-6'><strong>وضعیت چراغ پان مودم</strong>
                            <p class='text-muted'>
                                <?php echo $bug->bug_pan ?>
                            </p>
                            <hr>
                        </div>
                        <div class='col-md-6'><strong>وضعیت چراغ لاست مودم</strong>
                            <p class='text-muted'>
                                <?php echo $bug->bug_last ?>
                            </p>
                            <hr>
                        </div>
                        <div class="col-md-12">
                            <strong>شرح خرابی</strong>
                            <p class='text-muted'>
                                <?php echo $bug->bug_description ?>
                            </p>
                        </div>
                    </div>
                        <?php
                        if(isset($answers[0]))
                        {
                            echo "<hr><strong><i class='fa fa-reply mr-1'></i>جوابیه ها</strong>";
                            foreach ($answers as $answer) {
                                echo "<div class='item'><div class='card-footer card-comments'>
                                      <a class='close deleteanswer float-left' alt='delete'
                                                       data-id=$answer->answer_id>×</a>
                                     <div class='text-muted ltr'>".verta($answer->answer_create)."<i class='fa fa-clock-o'></i></div>
                                     <div class='card-comment mt-1'>
                                        $answer->asnswer_text
                                </div></div></div>";
                            }
                        }
                        if (isset($files[0])) {
                            echo "<hr><strong>فایل های آپلود شده</strong>
                    <div id='prevfiles' class='row'>";
                            foreach ($files as $file) {
                                echo "
                        <div class='item mt-2 col-md-3 col-sm-12'>
                            <div class='form-control'>
                                <a target='_blank' href=$file->file_path
                                    class='ltr'>$file->file_title</a>
                            </div>
                        </div>
                        ";
                            }
                            echo "
                    </div>
                    ";
                        } ?>
                    </div>
                </div>
            </div>
    </section>
    <div class="modal fade" id="postanswer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ارسال جوابیه</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="post">
                    <div class="modal-body">
                        <label class="control-label">هزینه (ریال)</label>
                        <input placeholder="هزینه به ریال" id="bug_payment" type="text"
                               class="form-control"
                               name="bug_payment" value="<?php echo !empty($bug->bug_payment) ? $bug->bug_payment :'' ?>" autofocus>
                        <div class="form-group">
                            <label class="ml" for="txt"><?php echo \Systems\Auth::user()['user_name'] ?> عزیز
                                پاسخ خود را وارد کنید:</label>
                            <textarea name="txt" id="txt" class="form-control" rows="3"
                                      placeholder="متن جوابیه..."></textarea>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left"
                                data-dismiss="modal">خروج
                        </button>
                        <button type="submit" class="btn btn-primary">ثبت</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php
include 'views/partials/footer.php';
?>