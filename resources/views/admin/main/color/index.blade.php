@extends('admin.layouts.main')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Цвета</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/">Главная</a></li>
                            <li class="breadcrumb-item active">Цвета</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        
        <section class="content">
            <div>
                <div class="row">
                    <div class="col-10 ml-3">
                        <div class="card">
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
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
