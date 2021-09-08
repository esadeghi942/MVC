<?php
$title = 'تیکت ها';
include 'views/partials/header.php';
include 'views/user/sidebar.php';
?>
<style>
    .card{
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
                                    <?php foreach ($comments as $comment) { ?>
                                        <li>
                                            <div class="timeline-item <?php echo $comment->comment_from == \Systems\Auth::id() ? '' : 'float-left' ?>">
                                                <span class="time"><i
                                                            class="fa fa-clock-o"></i><?php echo verta($comment->comment_create)->format('Y-m-d H:i:s') ?></span>

                                                <h3 class="timeline-header"><span class="text-green"
                                                                                  href="#"><?php echo $comment->comment_from == \Systems\Auth::id() ? \Systems\Auth::user()['user_name'] : 'پشتیبان' ?></span>
                                                    :</h3>

                                                <div class="timeline-body"><?php echo $comment->comment_text ?></div>
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
            <div class="row">
                <div class="col-md-12">
                    <form method="post">
                        <div class="form-group">
                            <label class="ml" for="txt"><?php echo \Systems\Auth::user()['user_name']; ?>
                                عزیز
                                تیکت خود را وارد کنید:</label>
                            <textarea name="comment_text" id="comment_text" class="form-control" rows="3" placeholder="متن تیکت..."></textarea>
                        </div>
                        <button type="submit" class="btn btn-sm btn-success btn-flat pull-left">ارسال تیکت</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <script type="text/javascript">
        $(".card").scrollTop($('.card').height());
    </script>
<?php
include 'views/partials/footer.php';
?>