<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/admin" class="brand-link">
        <img src="/template/admin/dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="/template/admin/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="/admin/main" class="d-block">Alexander Pierce</a>
            </div>
        </div> -->
        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-layer-group mr-2"></i>
                        <p>
                            Danh mục
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/admin/menus/add" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thêm Danh Mục</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/menus/list" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Xem Danh mục</p>
                            </a>
                        </li>
                    </ul>
                </li>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-shoe-prints mr-2"></i>
                        <p>
                            Sản phẩm
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/admin/product/add" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thêm Sản phẩm</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/product/list" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Xem Sản phẩm</p>
                            </a>
                        </li>
                        <!-- <li class="nav-item">
                            <a href="/admin/product/attribute" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Size và Màu</p>
                            </a>
                        </li> -->
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-image mr-2"></i>
                        <p>
                            Ảnh chi tiết sản phẩm
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/admin/productImage/list" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh Sách ảnh sản phẩm</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/productImage/add" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thêm ảnh sản phẩm</p>
                            </a>
                        </li>
                    </ul>
                </li>


                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-box mr-2"></i>
                        <p>
                            Đơn hàng
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/admin/customer" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh Sách đơn hàng</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/product/list" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Xem đơn hàng</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-user mr-2"></i>
                        <p>
                            Tài khoản
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/admin/account/list" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh Sách tài khoản</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-warehouse mr-2"></i>
                        <p>
                            Kho hàng
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/admin/warehouse/list" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh Sách kho hàng</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/warehouse/add" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Nhập hàng</p>
                            </a>
                        </li>
                    </ul>
                </li>


                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-user mr-2"></i>
                        <p>
                            Nhà cung cấp
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/admin/supplier/add" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thêm nhà cung cấp</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/supplier/list" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách nhà cung cấp</p>
                            </a>
                        </li>
                    </ul>
                    
                </li>


                <li class="nav-item m-l-30">
                    <form style="margin-left:30px" action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button style="background-color: seashell" type="submit">Đăng xuất</button>
                    </form>
                </li>


                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>