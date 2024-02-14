@extends('admin.layouts.main')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <div class="row">
                            <h2>Специальные предложения</h2>
                            <div class="col-2">
                                <a href="{{ route('admin.category.create') }}" class="btn btn-block bg-gradient-secondary">Добавить</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Административная панель</a></li>
                            <li class="breadcrumb-item active">Специальные предложения</li>
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
                                            <th class="p-2 text-center">Заголовок</th>
                                            <th class="p-2 text-center">Текст предложения</th>
                                            <th class="p-2 text-center">Обложка</th>
                                            <th class="p-2 text-center">Цвет</th>
                                            <th class="p-2 text-center">Порядок сортировки</th>
                                            <th class="p-2 text-center">Активность</th>
                                            <th class="p-2 text-center">Редактировать</th>
                                            <th class="p-2 text-center">Удалить</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
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
