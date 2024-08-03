<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
        <img src="{{ asset('adminlte/dist/img/oss-logo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">OSS</span>
    </a>
    
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('adminlte/dist/img/user-default.png') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <p class="d-block text-white">Пользователь</p>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
                <li class="nav-header">Основное</li>
                <li class="nav-item {{ Request::is('admin/cart*') || Request::is('admin/category*') || Request::is('admin/color*') || Request::is('admin/order*') || Request::is('admin/product*') || Request::is('admin/special-offer*') ? 'menu-is-opening menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <p>
                            Магазин
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('admin.orders.index')}}" class="nav-link {{Request::is('admin/order*') ? 'active' : ''}}">
                                <i class="fa fa-rub"><b>$</b></i>
                                <p class="p-2">Заказы</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.products.index')}}" class="nav-link {{Request::is('admin/product*') ? 'active' : ''}}">
                                <i class="fa fa-cubes"></i>
                                <p class="p-2">Товары</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.categories.index')}}" class="nav-link {{Request::is('admin/category*') ? 'active' : '' }}">
                                <i class="fa fa-tasks"></i>
                                <p class="p-2">Категории</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.special-offers.index')}}" class="nav-link {{Request::is('admin/special-offer*') ? 'active' : ''}}">
                                <i class="fa fa-fire"></i>
                                <p class="p-2">Специальные предложения</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ Request::is('admin/user*') || Request::is('admin/review*') ? 'menu-is-opening menu-open' : '' }}">
                    <a href="{{route('admin.users.index')}}" class="nav-link {{Request::is('admin/users*') ? 'active' : ''}}">
                        <p>
                            Пользователи
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        {{-- <li class="nav-item">
                            <a href="{{route('admin.reviews.index')}}" class="nav-link {{Request::is('admin/review*') ? 'active' : ''}}">
                                <i class="fa fa-comments"></i>
                                <p class="p-2">Отзывы</p>
                            </a>
                        </li> --}}
                        <li class="nav-item">
                            <a href="{{route('admin.users.index')}}" class="nav-link {{Request::is('admin/user*') ? 'active' : ''}}">
                                <i class="fa fa-user-circle"></i>
                                <p class="p-2">Пользователи</p>
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
