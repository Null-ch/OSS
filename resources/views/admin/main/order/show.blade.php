@extends('admin.layouts.main')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <div class="row">
                            <h2>Просмотр данных о заказе</h2>
                            <div class="col-2">
                                <a href="{{ route('admin.order.edit', $order->id) }}" class="text-success"><i class="fas fa-pencil-alt  pt-3"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Административная панель</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.orders.index') }}">Список заказов</a></li>
                            <li class="breadcrumb-item active">Просмотр данных о категории</li>
                        </ol>
                    </div>
                </div>

            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-10">
                        <div class="card">
                            <div class="row justify-content-center mt-1">
                                <label>Информация о заказе</label>
                            </div>
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <tbody>
                                        <tr>
                                            <th class="p-2 text-center pt-3">ID</th>
                                            <th class="p-2 text-center pt-3">Заказчик</th>
                                            <th class="p-2 text-center pt-3">Статус</th>
                                            <th class="p-2 text-center pt-3">Дата создания</th>
                                            <th class="p-2 text-center pt-3">Дата обновления</th>
                                        </tr>
                                        <tr>
                                            <td class="p-2 text-center pt-3">{{ $order->id }}</td>
                                            <td class="p-2 text-center pt-3">{{ $order->user->getFullName() }}</td>
                                            <td class="p-2 text-center pt-3">{{ $order->getStatus() }}</td>
                                            <td class="p-2 text-center pt-3">{{ $order->created_at->locale('ru')->diffForHumans() }}</td>
                                            <td class="p-2 text-center pt-3">{{ $order->updated_at->locale('ru')->diffForHumans() }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card">
                            <div class="row justify-content-center mt-1">
                                <label>Список товаров</label>
                            </div>
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <tbody>
                                        <tr>
                                            <th class="p-2 text-center pt-3">ID</th>
                                            <th class="p-2 text-center pt-3">Название</th>
                                            <th class="p-2 text-center pt-3">Категория</th>
                                            <th class="p-2 text-center pt-3">Стоимость</th>
                                            <th class="p-2 text-center pt-3">Количество</th>
                                        </tr>
                                        @foreach ($products as $item)
                                        <tr>
                                            <td class="p-2 text-center pt-3">{{$item->product_id}}</td>
                                            <td class="p-2 text-center pt-3">{{$item->product->title}}</td>
                                            <td class="p-2 text-center pt-3">{{$item->product->category->title}}</td>
                                            <td class="p-2 text-center pt-3">{{$item->product->price}} P</td>
                                            <td class="p-2 text-center pt-3">{{$item->quantity}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="row justify-content-end mt-1 pr-5">
                                <label>Общая стоимость: {{$order->getTotalCost()}} Р</label>
                            </div>
                        </div>
                        <div class="card">
                            <div class="row justify-content-center mt-1">
                                <label>Информация о доставке</label>
                            </div>
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap justify-content-center">
                                    <tbody>
                                        <tr>
                                            <th class="p-2 text-center pt-3">Тип</th>
                                            <th class="p-2 text-center pt-3">Служба доставки</th>
                                            <th class="p-2 text-center pt-3">Адрес</th>
                                        </tr>
                                        <tr>
                                            <td class="p-2 text-center pt-3"></td>
                                            <td class="p-2 text-center pt-3"></td>
                                            <td class="p-2 text-center pt-3"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-2 p-1">
                        <a href="{{ url()->previous() }}" class="btn btn-block bg-gradient-secondary mt-2">Назад</a>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('scripts')
    <script>
        window.addEventListener('DOMContentLoaded', function() {
            var imagePreview = document.getElementById('preview_image');
            var imageSrc = "{{ asset($order->preview_image) }}";

            var img = new Image();
            img.src = imageSrc;
            img.alt = "Preview Image";

            img.addEventListener('load', function() {
                imagePreview.style.backgroundImage = "url(" + img.src + ")";
                imagePreview.style.backgroundSize = "contain";
                imagePreview.style.backgroundPosition = "center";
                imagePreview.style.backgroundRepeat = "no-repeat";
                imagePreview.style.width = "430px";
                imagePreview.style.height = "400px";
            });
        });
    </script>
@endsection
