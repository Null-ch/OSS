@extends('admin.layouts.main')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <div class="row">
                            <h2>Добавление товара</h2>
                            <div class="col-2">
                                <a href="{{ url()->previous() }}" class="btn btn-block bg-gradient-secondary">Назад</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Административная панель</a></li>
                            <li class="breadcrumb-item active">Добавление товара</li>
                        </ol>
                    </div>
                </div>

            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 ml-2 p-2">
                        <form action="{{ route('admin.product.store') }}" method="POST" class="w-25">
                            @csrf
                            <div class="row p-1">
                                <div class="form-group p-1 text-center col-md-12">
                                    <label>Название</label>
                                    <input type="text" class="form-control text-center" name="title" placeholder="Введите название" >
                                    @error('title')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row p-1">
                                <div class="form-group p-1 text-center col-md-12">
                                    <label>Описание</label>
                                    <textarea class="form-control" rows="3" name="description" placeholder="Введите описание ..." style="height: 89px;"></textarea>
                                    @error('description')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                  </div>
                            </div>
                            <div class="row p-1">
                                <div class="form-group p-1 text-center col-md-6">
                                    <label>Цена</label>
                                    <input type="text" class="form-control text-center" name="price" placeholder="Установите цену за шт.">
                                    @error('price')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group p-1 text-center col-md-6">
                                    <label>Текущее количество</label>
                                    <input type="text" class="form-control text-center" name="count" placeholder="Установите количество товара на складе">
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
                                            <option value="{{ $category->id }}">
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
                                            <option value="{{ $color->id }}">
                                                {{ $color->title }}</option>
                                        @endforeach
                                    </select>
                                    @error('color_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row p-1">
                                <div class="form-group text-center p-1 col-md-6">
                                    <label>Категория</label>
                                    <select name="category_id" class="form-control text-center">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">
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
                                            <option value="{{ $color->id }}">
                                                {{ $color->title }}</option>
                                        @endforeach
                                    </select>
                                    @error('color_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <input type="submit" class="btn btn-block bg-gradient-secondary" value="Добавить">
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('scripts')
@endsection
