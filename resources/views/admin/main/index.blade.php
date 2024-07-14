@extends('admin.layouts.main')
@section('content')
    <style>
        .small-box .inner i {
            position: absolute;
            bottom: 30%;
            right: 3%;
            opacity: 0.3;
            font-size: 3rem;
        }
    </style>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h2 class="m-0">Панель администратора</h2>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/admin">Административная панель</a></li>
                            <li class="breadcrumb-item active">Панель администратора</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div>
                    <h3>Магазин</h3>
                    <div class="row">
                        <div class="col-3 m-1">
                            <div class="small-box bg-info">
                                <div class="inner" style="text-align: center">
                                    <p>Товары</p>
                                    <h3>{{ $productsCount }}</h3>
                                    <i class="fa fa-cubes"></i>
                                </div>
                                <a href="{{ route('admin.products.index') }}" class="small-box-footer">Перейти к товарам<i class="fas fa-arrow-circle-right" style="margin-left: 5px"></i></a>
                            </div>
                        </div>
                        <div class="col-3 m-1">
                            <div class="small-box bg-info">
                                <div class="inner" style="text-align: center">
                                    <p>Категории</p>
                                    <h3>{{ $categoriesCount }}</h3>
                                    <i class="fa fa-tasks"></i>
                                </div>
                                <a href="{{ route('admin.categories.index') }}" class="small-box-footer">Перейти к категориям<i class="fas fa-arrow-circle-right" style="margin-left: 5px"></i></a>
                            </div>
                        </div>
                        <div class="col-3 m-1">
                            <div class="small-box bg-info">
                                <div class="inner" style="text-align: center">
                                    <p>Заказы</p>
                                    <h3>{{ $ordersCount }}</h3>
                                    <i class="fa fa-rub"><b>$</b></i>
                                </div>
                                <a href="{{ route('admin.orders.index') }}" class="small-box-footer">Перейти к заказам<i class="fas fa-arrow-circle-right" style="margin-left: 5px"></i></a>
                            </div>
                        </div>
                        <div class="col-3 m-1">
                            <div class="small-box bg-info">
                                <div class="inner" style="text-align: center">
                                    <p>Специальные предложения</p>
                                    <h3>{{ $specialOffersCount }}</h3>
                                    <i class="fa fa-fire"></i>
                                </div>
                                <a href="{{ route('admin.special-offers.index') }}" class="small-box-footer">Перейти к специальным предложениям<i class="fas fa-arrow-circle-right" style="margin-left: 5px"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <h3>Сообщество</h3>
                    <div class="row">
                        {{-- <div class="col-3 m-1">
                            <div class="small-box bg-green">
                                <div class="inner" style="text-align: center">
                                    <p>Отзывы</p>
                                    <h3>{{ $reviewsCount }}</h3>
                                </div>
                                <a href="{{ route('admin.reviews.index') }}" class="small-box-footer">Перейти к отзывам<i class="fas fa-arrow-circle-right" style="margin-left: 5px"></i></a>
                            </div>
                        </div> --}}
                        <div class="col-3 m-1">
                            <div class="small-box bg-green">
                                <div class="inner" style="text-align: center">
                                    <p>Пользователи</p>
                                    <h3>{{ $usersCount }}</h3>
                                    <i class="fa fa-user-circle"></i>
                                </div>
                                <a href="{{ route('admin.users.index') }}" class="small-box-footer">Перейти к пользователям<i class="fas fa-arrow-circle-right" style="margin-left: 5px"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
