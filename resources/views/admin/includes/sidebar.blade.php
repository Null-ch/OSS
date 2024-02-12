<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{ asset('adminlte/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">OSS</span>
    </a>
    
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('adminlte/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
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
                <li class="nav-item {{ Request::is('admin/cart*') || Request::is('admin/category*') || Request::is('admin/color*') || Request::is('admin/order*') || Request::is('admin/product*') ? 'menu-is-opening menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <p>
                            Магазин
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        {{-- <li class="nav-item {{Request::is('admin/cart*') ? 'menu-open' : '' }}">
                            <a href="{{route('admin.carts.index')}}" class="nav-link">
                                <i class="fa fa-shopping-cart m-r-20"></i>
                                <p class="p-2 {{Request::is('admin/cart*') ? 'active' : '' }}">Корзины</p>
                            </a>
                        </li> --}}
                        {{-- <li class="nav-item {{Request::is('admin/order*') ? 'menu-open' : '' }}">
                            <a href="{{route('admin.orders.index')}}" class="nav-link {{Request::is('admin/order*') ? 'active' : ''}}">
                                <i class="fa fa-rub"><b>$</b></i>
                                <p class="p-2">Заказы</p>
                            </a>
                        </li> --}}
                        <li class="nav-item {{Request::is('admin/product*') ? 'menu-open' : '' }}">
                            <a href="{{route('admin.products.index')}}" class="nav-link {{Request::is('admin/product*') ? 'active' : ''}}">
                                <i class="fa fa-cubes"></i>
                                <p class="p-2">Товары</p>
                            </a>
                        </li>
                        <li class="nav-item {{Request::is('admin/categories*') ? 'menu-open' : '' }}">
                            <a href="{{route('admin.categories.index')}}" class="nav-link {{Request::is('admin/category*') ? 'active' : '' }}">
                                <i class="fa fa-tasks"></i>
                                <p class="p-2">Категории</p>
                            </a>
                        </li>
                        {{-- <li class="nav-item {{Request::is('admin/colors*') ? 'menu-open' : '' }}">
                            <a href="{{route('admin.colors.index')}}" class="nav-link {{Request::is('admin/color*') ? 'active' : ''}}">
                                <i class="fa fa-paint-brush"></i>
                                <p class="p-2">Цвета</p>
                            </a>
                        </li> --}}
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
