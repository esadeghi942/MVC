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
                    <a class="d-block"><?php echo systems\Auth::user()['user_name'] ?></a>
                </div>
                <a href="logout" class="pt-1">
                    <i class="nav-icon fa fa-power-off"></i>
                </a>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <li class="nav-item has-treeview">
                        <a href="admin" class="active nav-link">
                            <i class="nav-icon fa fa-dashboard"></i>
                            <p>داشبورد
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="adminSetPayment" class="nav-link">
                            <i class="nav-icon fa fa-money"></i>
                            <p>هزینه کارشناسی
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="edit" class="nav-link">
                            <i class="nav-icon fa fa-id-card"></i>
                            <p>
                                ویرایش حساب کاربری
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="adminComment" class="nav-link">
                            <i class="nav-icon fa fa-comment"></i>
                            <p>
                                تیکت ها
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="adminCustomerIndex" class="nav-link">
                            <i class="nav-icon fa fa-users"></i>
                            <p>
                                مشتریان
                            </p>
                        </a>
                    </li>
                    <?php if(\Systems\Auth::isSuperAdmin()){ ?>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-id-card"></i>
                            <p>
                                مدیران سایت
                                <i class="fa fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="adminUserCreate" class="nav-link">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>افزودن مدیر جدید</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="adminUserIndex" class="nav-link">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>لیست مدیران</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <?php } ?>
                    <li class="nav-item has-treeview">
                        <a href="adminRequestIndex" class="nav-link">
                            <i class="nav-icon fa fa-wifi"></i>
                            <p>
                                لیست درخواست فیبر نوری
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="adminRequestIndex?karshenasi=1" class="nav-link">
                            <i class="nav-icon fa fa-wifi"></i>
                            <p>
                                لیست درخواست کارشناسی
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="adminBugIndex" class="nav-link">
                            <i class="nav-icon fa fa-wrench"></i>
                            <p>
                                اعلام خرابی ها
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="adminDocumentIndex" class="nav-link">
                            <i class="nav-icon fa fa-files-o"></i>
                            <p>
                                 مدارک دریافتی
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="adminMaliIndex" class="nav-link">
                            <i class="nav-icon fa fa-outdent"></i>
                            <p>
                                 تراکنش های مالی
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