@extends('admin.layouts.main')
@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Панель администратора</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="/admin">Административная панель</a></li>
                                <li class="breadcrumb-item active">Панель администратора</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <div class="container-fluid">
                <div>
                    <h3>Магазин</h3>
                    <div class="row">
                        <!-- Карточка Пользователей -->
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-info">
                                <div class="inner" style="text-align: center">
                                    <p>Корзины</p>
                                    {{-- <h3>{{ $users->count() }}</h3> --}}
                                </div>
                                {{-- <a href="{{ route('admin.users.index') }}" class="small-box-footer">Перейти к пользователям<i
                                        class="fas fa-arrow-circle-right" style="margin-left: 5px"></i></a> --}}
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-info">
                                <div class="inner" style="text-align: center">
                                    <p>Категории</p>
                                    {{-- <h3>{{ $users->count() }}</h3> --}}
                                </div>
                                {{-- <a href="{{ route('admin.users.index') }}" class="small-box-footer">Перейти к пользователям<i
                                        class="fas fa-arrow-circle-right" style="margin-left: 5px"></i></a> --}}
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-info">
                                <div class="inner" style="text-align: center">
                                    <p>Заказы</p>
                                    {{-- <h3>{{ $users->count() }}</h3> --}}
                                </div>
                                {{-- <a href="{{ route('admin.users.index') }}" class="small-box-footer">Перейти к пользователям<i
                                        class="fas fa-arrow-circle-right" style="margin-left: 5px"></i></a> --}}
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-info">
                                <div class="inner" style="text-align: center">
                                    <p>Товары</p>
                                    {{-- <h3>{{ $users->count() }}</h3> --}}
                                </div>
                                {{-- <a href="{{ route('admin.users.index') }}" class="small-box-footer">Перейти к пользователям<i
                                        class="fas fa-arrow-circle-right" style="margin-left: 5px"></i></a> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <h3>Сообщество</h3>
                    <div class="row">
                        <!-- Карточка Пользователей -->
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-info">
                                <div class="inner" style="text-align: center">
                                    <p>Отзывы</p>
                                    {{-- <h3>{{ $users->count() }}</h3> --}}
                                </div>
                                {{-- <a href="{{ route('admin.users.index') }}" class="small-box-footer">Перейти к пользователям<i
                                        class="fas fa-arrow-circle-right" style="margin-left: 5px"></i></a> --}}
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-info">
                                <div class="inner" style="text-align: center">
                                    <p>Пользователи</p>
                                    {{-- <h3>{{ $users->count() }}</h3> --}}
                                </div>
                                {{-- <a href="{{ route('admin.users.index') }}" class="small-box-footer">Перейти к пользователям<i
                                        class="fas fa-arrow-circle-right" style="margin-left: 5px"></i></a> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
