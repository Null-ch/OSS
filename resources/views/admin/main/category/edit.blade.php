@extends('admin.layouts.main')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <div class="row">
                        <h2>Редактирование категории</h2>
                        <div class="col-2">
                            <a href="{{ url()->previous() }}" class="btn btn-block bg-gradient-secondary">Назад</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Административная панель</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.categories.index') }}">Список категорий</a></li>
                        <li class="breadcrumb-item active">Редактирование категории</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 ml-2 p-2">
                    <h3>Редактирование категории</h3>
                    <form action="{{ route('admin.category.store') }}" method="POST" class="w-25">
                        @csrf
                        <div class="form-group">
                            <label>Название</label>
                            <input type="text" class="form-control" name="title" placeholder="Название категории..." value="{{$category->title}}">
                            @error('title')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
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
