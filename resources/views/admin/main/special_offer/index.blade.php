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
                                            <th class="p-2 text-center" colspan="3">Действия</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($specialOffers as $specialOffer)
                                            <tr data-id="{{ $specialOffer->id }}">
                                                <td class="p-2 text-center">{{ $specialOffer->header }}</td>
                                                <td class="p-2 text-center">{{ $specialOffer->description }}</td>
                                                <td class="p-2 text-center">{{ $specialOffer->hex_code }}</td>
                                                <td class="p-2 text-center">{{ $specialOffer->sort_order }}</td>
                                                <td class="p-2 text-center">
                                                    <div class="p-2">
                                                        <input class="form-check-input" type="checkbox" name="is_active" id="is_active_checkbox" {{ $specialOffer->is_active ? 'checked' : '' }} value="{{ $specialOffer->id }}">
                                                    </div>
                                                </td>
                                                <td class="text-center" class="p-2"><a href="{{ route('admin.special-offer.show', $specialOffer->id) }}"><i class="far fa-eye"></i></a></td>
                                                <td class="text-center" class="p-2"><a href="{{ route('admin.special-offer.edit', $specialOffer->id) }}" class="text-success"><i class="fas fa-pencil-alt"></i></a></td>
                                                <td class="text-center p-1">
                                                    <button class="btn btn-danger" onclick="deleteConfirmation({{ $specialOffer->id }})">Удалить</button>
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
                    <i class="fa fa-angle-up" aria-hidden="true"></i>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#is_active_checkbox').change(function() {
                var isChecked = $(this).val();

                $.ajax({
                    url: '/admin/special-offer/activity/' + isChecked,
                    type: 'GET',
                    success: function(response) {}
                });
            });
        });
    </script>
    <script type="text/javascript">
        function deleteConfirmation(id) {
            Swal.fire({
                title: "Удалить?",
                text: "Подтвердите удаление",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Да, удалить!",
                cancelButtonText: "Нет, отменить",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    var CSRF_TOKEN = {!! json_encode(csrf_token()) !!};
                    $.ajax({
                        type: 'POST',
                        url: "{{ url('admin/special-offer/delete/') }}/" + id,
                        data: {
                            _token: CSRF_TOKEN,
                            _method: 'DELETE'
                        },
                        dataType: 'JSON',
                        success: function(results) {
                            if (results.success === true) {
                                Swal.fire("Готово!", results.message, "success").then(() => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire("Ошибка!", results.message, "error").then(() => {
                                    location.reload();
                                });
                            }
                        }
                    });
                }
            });
        }
    </script>
@endsection
