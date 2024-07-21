<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="/admin" class="nav-link"><b>Админ панель</b></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="<?php echo url('/'); ?>" class="nav-link" target="_blank"><b>На сайт</b></a>
          </li>
    </ul>

    <ul class="navbar-nav ml-auto">
        @if (auth()->check())
            <li class="nav-item dropdown ml-auto">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                    <span><b>{{ Auth::user()->name }}</b></span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
                        {{ __('Выйти') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
            </li>
        @endif
    </ul>
</nav>
