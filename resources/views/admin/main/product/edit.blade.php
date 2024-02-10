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
                            <div class="row p-1">
                                <div class="form-group p-1 text-center col-md-6">
                                    <label>Название</label>
                                    <input type="text" class="form-control text-center" name="title" placeholder="Олег" value="{{ $product->title }}">
                                    @error('title')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group p-1 text-center col-md-6">
                                    <label>Описание</label>
                                    <input type="text" class="form-control text-center" name="description" placeholder="Олег" value="{{ $product->description }}">
                                    @error('description')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row p-1">
                                <div class="form-group p-1 text-center col-md-6">
                                    <label>Цена</label>
                                    <input type="text" class="form-control text-center" name="price" placeholder="Олег" value="{{ $product->price }}">
                                    @error('price')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group p-1 text-center col-md-6">
                                    <label>Текущее количество</label>
                                    <input type="text" class="form-control text-center" name="count" placeholder="Олег" value="{{ $product->count }}">
                                    @error('count')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row p-1">
                                <div class="form-group text-center p-1 col-md-6">
                                    <label>Категория</label>
                                    <select name="category_id" class="form-control text-center">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ $product->category_id ? 'selected' : '' }}>
                                                {{ $category->title }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group text-center p-1 col-md-6">
                                    <label>Цвет</label>
                                    <select name="color_id" class="form-control text-center">
                                        @foreach ($colors as $color)
                                            <option value="{{ $color->id }}" {{ $product->color_id ? 'selected' : '' }}>
                                                {{ $color->title }}</option>
                                        @endforeach
                                    </select>
                                    @error('color_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
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
