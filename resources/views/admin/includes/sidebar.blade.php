<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <span class="brand-text font-weight-light">AdminPage</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info">
                <a href="{{url('admin/logout')}}" class="d-block">Logout</a>
            </div>
        </div>

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
                <li class="nav-item">
                    <a href="{{url('admin/home')}}" class="nav-link">
                        <i class="nav-icon far fa-calendar-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('brand.index')}}" class="nav-link">
                        <i class="nav-icon far fa-calendar-alt"></i>
                        <p>Brand</p>
                        <span class="badge badge-info right">{{$count_brand}}</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('category.index')}}" class="nav-link">
                        <i class="nav-icon far fa-calendar-alt"></i>
                        <p>Category</p>
                        <span class="badge badge-info right">{{$count_category}}</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('slider.index')}}" class="nav-link">
                        <i class="nav-icon far fa-calendar-alt"></i>
                        <p>Slider</p>
                        <span class="badge badge-info right">{{$count_slider}}</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Product
                            <i class="fas fa-angle-left right"></i>
                            <span class="badge badge-info right">{{$count_product}}</span>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('product.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('product.create')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create</p>
                            </a>
                        </li>

                    </ul>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>