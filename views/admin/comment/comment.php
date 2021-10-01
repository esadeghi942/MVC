<?php
$title = 'تیکت ها';
include 'views/partials/header.php';
include 'views/admin/sidebar.php';
?>
    <style>
        .card {
            max-height: 295px;
            overflow-y: scroll;
            scroll-behavior: smooth;
        }
    </style>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-md-12">
                            <div id="comment">
                                <ul class="timeline timeline-inverse">
                                    <!-- timeline item -->
                                    <?php
                                    if (!isset($comments[0]))
                                        echo '<div class="pr-3">هنوز تیکتی وجود ندارد.</div>';
                                    foreach ($comments as $comment) { ?>
                                        <li>
                                            <i class="fa fa-comments bg-yellow"></i>
                                            <div class="timeline-item <?php echo $comment->user_type != \Models\User::customer ? '' : 'float-left' ?>">
                                                <span class="time"><i
                                                            class="fa fa-clock-o"></i><?php echo verta($comment->comment_create)->format('Y-m-d H:i:s') ?></span>

                                                <h3 class="timeline-header"><span class="text-green"
                                                                                  href="#"><?php echo $comment->user_name; ?></span>
                                                    :</h3>

                                                <i class="fa float-left pt-3 <?php echo $comment->comment_readed == 1 ? 'fa-check-circle' : 'fa-check-circle-o' ?>"></i>
                                                <div class="timeline-body"><?php echo $comment->comment_text ?></div>
                                                <?php if ($comment->comment_readed == 0 && $comment->user_id == \Systems\Auth::id()) { ?>
                                                    <div class="timeline-footer">
                                                        <button type="submit"
                                                                data-id="<?php echo $comment->comment_id; ?>"
                                                                class="deletecomment btn btn-danger btn-flat btn-xs">
                                                            حذف
                                                        </button>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </li>

                                    <?php } ?>
                                    <!-- END timeline item -->
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php if($active == 1){ ?>
                <div class='row'>
                    <div class='col-md-12'>
                        <form method='post'>
                            <div class='form-group'>
                                <label class='ml' for='txt'>
                                    تیکت خود را وارد کنید:</label>
                                <textarea name='comment_text' id='comment_text' class='form-control' rows='3'
                                          placeholder='متن تیکت...'></textarea>
                            </div>
                            <button type='submit' class='btn btn-sm btn-success btn-flat pull-left'>ارسال تیکت</button>
                        </form>
                    </div>
                </div>
            <?php } ?>
        </div>
    </section>
    <script type="text/javascript">
        $(".card").scrollTop($('.card').height());
    </script>
<?php
include 'views/partials/footer.php';
?>