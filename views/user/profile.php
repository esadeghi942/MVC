<?php
include 'views/partials/header.php';
include 'views/user/sidebar.php'; ?>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">پروفایل</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-left">
                            <li class="breadcrumb-item"><a href="#">خانه</a></li>
                            <li class="breadcrumb-item active">‌پروفایل</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>150</h3>

                                <p>سفارشات جدید</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="#" class="small-box-footer">اطلاعات بیشتر <i
                                        class="fa fa-arrow-circle-left"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>53<sup style="font-size: 20px">%</sup></h3>

                                <p>افزایش امتیاز</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="#" class="small-box-footer">اطلاعات بیشتر <i
                                        class="fa fa-arrow-circle-left"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>44</h3>

                                <p>کاربران ثبت شده</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <a href="#" class="small-box-footer">اطلاعات بیشتر <i
                                        class="fa fa-arrow-circle-left"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>65</h3>

                                <p>بازدید جدید</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="#" class="small-box-footer">اطلاعات بیشتر <i
                                        class="fa fa-arrow-circle-left"></i></a>
                        </div>
                    </div>
                    <div class="form-group col-md-10">
                        <label class="control-label">نام شرکت</label>
                        <input placeholder="نام شرکت" id="cu_company" type="text"
                               class="form-control  <?php isset($errors['email']) ? ' is-invalid' : '' ?>"
                               name="cu_company" value="" required autofocus>
                    </div>
                    <div class="form-group col-md-10">
                        <label class="control-label">نام نماینده</label>
                        <input placeholder="نام نماینده" id="cu_namayande" type="text"
                               class="form-control  <?php isset($errors['email']) ? ' is-invalid' : '' ?>"
                               name="cu_namayande" value="" required autofocus>
                    </div>
                    <div class="form-group col-md-10">
                        <label class="control-label">تلفن ثابت</label>
                        <input placeholder="تلفن ثابت" id="cu_phone" type="text"
                               class="form-control  <?php isset($errors['email']) ? ' is-invalid' : '' ?>"
                               name="cu_phone" value="" required autofocus>
                    </div>
                    <div class="form-group col-md-10">
                        <label class="control-label">آدرس</label>
                        <textarea name="cu_addresss" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="form-group col-md-10">
                        <label class="control-label">وضعیت مالکیت</label>
                        <div class="form-check">
                            <input name="cu_status" class="form-check-input" checked="checked" type="radio" value="1">
                            <label class="form-check-label">مالک</label>
                        </div>
                        <div class="form-check">
                            <input name="cu_status" class="form-check-input" type="radio" value="2">
                            <label class="form-check-label">مستاجر</label>
                        </div>
                    </div>
                    <!-- ./col -->
                </div>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
    </div>
<?php
include 'views/partials/footer.php';
?>