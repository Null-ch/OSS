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
                                <a href="{{ route('admin.special-offer.create') }}" class="btn btn-block bg-gradient-secondary">Добавить</a>
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
                                            <th class="p-2 text-center">Цвет</th>
                                            <th class="p-2 text-center">Порядок сортировки</th>
                                            <th class="p-2 text-center">Активность</th>
                                            <th class="p-2 text-center">Редактировать</th>
                                            <th class="p-2 text-center">Удалить</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($specialOffers as $specialOffer)
                                            <tr data-id="{{ $specialOffer->id }}">
                                                <td class="p-2 text-center">{{ $specialOffer->header }}</td>
                                                <td class="p-2 text-center">{{ $specialOffer->description }}</td>
                                                <td class="p-2 text-center">{{ $specialOffer->hex_code }}</td>
                                                <td class="p-2 text-center">{{ $specialOffer->is_active }}</td>
                                                <td class="text-center" class="p-2"><a href="{{ route('admin.special-offer.show', $specialOffer->id) }}"><i class="far fa-eye"></i></a></td>
                                                <td class="text-center" class="p-2"><a href="{{ route('admin.special-offer.edit', $specialOffer->id) }}" class="text-success"><i class="fas fa-pencil-alt"></i></a></td>
                                                <td class="text-center p-2">
                                                    <form action="{{ route('admin.special-offer.destroy', $specialOffer->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
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
