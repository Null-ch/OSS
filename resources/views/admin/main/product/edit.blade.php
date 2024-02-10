@extends('admin.layouts.main')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <div class="row">
                            <h2>Редактирование товара</h2>
                            <div class="col-2">
                                <a href="{{ route('admin.product.edit', $product->id) }}" class="text-success"><i class="fas fa-pencil-alt"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Административная панель</a></li>
                            <li class="breadcrumb-item"><a href="/admin/products">Список товаров</a></li>
                            <li class="breadcrumb-item active">Редактирование товара</li>
                        </ol>
                    </div>
                </div>

            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 ml-2 p-2">
                        <form action="{{ route('admin.product.update', $product->id) }}" method="POST" class="col-10">
                            @csrf
                            @method('PATCH')
                            
                            <div class="row">
                                <div class="col-2 p-1">
                                    <input type="submit" class="btn btn-block bg-gradient-secondary mt-2" value="Обновить">
                                </div>
                                <div class="col-2 p-1">
                                    <a href="{{ url()->previous() }}" class="btn btn-block bg-gradient-secondary mt-2">Назад</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('scripts')
@endsection
