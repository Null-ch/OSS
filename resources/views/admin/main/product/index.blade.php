@extends('admin.layouts.main')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <div class="row">
                            <h2>Товары</h2>
                            <div class="col-2">
                                <a href="{{ route('admin.product.create') }}" class="btn btn-block bg-gradient-secondary">Добавить</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Административная панель</a></li>
                            <li class="breadcrumb-item active">Список товаров</li>
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
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th class="p-2 text-center">Название</th>
                                            <th class="p-2 text-center">Цена</th>
                                            <th class="p-2 text-center">Количество</th>
                                            <th class="p-2 text-center">Категория</th>
                                            <th class="p-2 text-center">Просмотр</th>
                                            <th class="p-2 text-center">Редактировать</th>
                                            <th class="p-2 text-center">Удалить</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @foreach ($products as $product)
                                            <tr data-id="{{ $product->id }}">
                                                <td class="p-2 text-center">{{ $product->name }}</td>
                                                <td class="p-2 text-center">{{ $product->email }}</td>
                                                <td class="p-2 text-center">{{ $product->role == 0 ? 'Администратор' : 'Пользователь' }}</td>
                                                <td class="p-2 text-center">{{ $product->created_at }}</td>
                                                <td class="p-2 text-center">{{ $product->updated_at }}</td>
                                                <td class="text-center" class="p-2"><a href="{{ route('admin.product.show', $product->id) }}"><i class="far fa-eye"></i></a></td>
                                                <td class="text-center" class="p-2"><a href="{{ route('admin.product.edit', $product->id) }}" class="text-success"><i class="fas fa-pencil-alt"></i></a></td>
                                                <td class="text-center" class="p-2"><a href=""><i class="far fa-trash"></i></a></td>
                                            </tr>
                                        @endforeach --}}
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
                <div class="scroll-to-top" onclick="scrollToTop()">
                    <img src="{{ asset('images/admin/Arrow-Up.png') }}" alt="Наверх">
                </div>
            </div>
        </section>
    </div>
@endsection
@section('scripts')
@endsection
