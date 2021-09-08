<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="assets/img/loginlogo.png" alt=" فیبر نوری تهران" class="brand-image elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">پنل کاربری</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar" style="direction: ltr">
        <div style="direction: rtl">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="assets/img/user-avatar.png" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="profile" class="d-block"><?php echo systems\Auth::user()['user_name'] ?></a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <li class="nav-item has-treeview menu-open">
                        <a href="user" class="nav-link">
                            <i class="nav-icon fa fa-dashboard"></i>
                            <p>داشبورد
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="userComment" class="nav-link">
                            <i class="nav-icon fa fa-comment"></i>
                            <p>
                                تیکت ها
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-id-card"></i>
                            <p>
                                ویرایش اطلاعات
                                <i class="fa fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="edit" class="nav-link">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>ویرایش حساب کاربری</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="userProfileUpdate" class="nav-link">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>ویرایش پروفایل</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-wifi"></i>
                            <p>
                                درخواست  فیبر نوری
                                <i class="fa fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="userRequestCreate" class="nav-link">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>درخواست جدید</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="userRequestIndex" class="nav-link">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>لیست درخواست ها</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-wrench"></i>
                            <p>
                                اعلام خرابی
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="userBugCreate" class="nav-link">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>اعلام خرابی جدید</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="userBugIndex" class="nav-link">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>لیست اعلام خرابی ها</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-outdent"></i>
                            <p>
                                ارسال مدارک
                                <i class="fa fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="" class="nav-link">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>لیست مدارک ارسالی</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="" class="nav-link">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>جدید</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-tty"></i>
                            <p>
                                درخواست خط 4 یا 5 رقمی
                                <i class="fa fa-angle-left right"></i>
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-envelope-o"></i>
                            <p>
                                فعال سازی پیامک
                                <i class="fa fa-angle-left right"></i>
                            </p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
    </div>
    <!-- /.sidebar -->
</aside>