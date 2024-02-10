@extends('admin.layouts.main')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <div class="row">
                        <h2>Список доступных цветов</h2>
                        <div class="col-2 p-1">
                            <a href="{{ url()->previous() }}" class="btn btn-block bg-gradient-secondary">Назад</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/admin">Административная панель</a></li>
                        <li class="breadcrumb-item active">Список доступных цветов</li>
                    </ol>
                </div>
            </div>
            
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="card-body table-responsive p-3">
                    <table class="table">
                        <thead>
                            <tr class="text-center">
                                <th>Название</th>
                                <th>HEX-код</th>
                                <th>HTML-код</th>
                                <th>Цвет</th>
                            </tr>
                        </thead>
                        <tbody id="tablecontents">
                            @foreach ($colors as $color)
                                <tr class="text-center">
                                    <td>{{ $color->title }}</td>
                                    <td>{{ $color->hex_code }}</td>
                                    <td>{{ $color->rgb_code }}</td>
                                    <td style="display: flex; justify-content: center; align-items: center;">
                                        <div style="background-color: {{ $color->hex_code }}; width: 20px; height: 20px;"></div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="scroll-to-top" onclick="scrollToTop()">
                    <i class="fa fa-angle-up" aria-hidden="true"></i>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@section('scripts')
@endsection
