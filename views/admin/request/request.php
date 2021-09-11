<?php
$title = 'لیست درخواست های فیبر نوری';
include 'views/partials/header.php';
include 'views/admin/sidebar.php'; ?>
<style>
    body{
        padding-right: 0 !important;
    }
</style>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">جزییات درخواست های فیبر نوری
                    <button type="submit" class="float-left replyrequest btn btn-success btn-sm" data-toggle="modal"
                            data-target="#postanswer">ارسال پاسخ
                    </button>
                </div>
                <div class="card-body">
                    <div class="row">
                        <?php foreach ($requset as $key => $item)
                            if (!empty($key)) {
                                echo "<div class='col-md-6'><strong><i class='fa fa-book mr-1'></i> $key</strong>
                        <p class='text-muted'>
                            $item
                        </p>
                        <hr></div>";
                            }
                        echo "</div>";
                        if (isset($files[0])) {
                            echo "<strong><i class='fa fa-book mr-1'></i>فایل های آپلود شده</strong>
<div id='prevfiles' class='row'>";
                            foreach ($files as $file) {
                                echo "<div class='item mt-2 col-md-3 col-sm-12'>
                                                <div class='form-control'>
                                                    <a target='_blank' href=$file->file_path
                                                    class='ltr'>$file->file_title</a>
                                                </div>
                                      </div>";
                            }
                            echo "</div>";
                        } ?>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    <div class="modal fade" id="postanswer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ارسال جوابیه درخواست</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="ml" for="txt"><?php echo  \Systems\Auth::user()['user_name'] ?> عزیز
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