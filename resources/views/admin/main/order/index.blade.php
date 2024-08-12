@extends('admin.layouts.main')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <div class="row">
                            <h2>Список заказов </h2>
                            <div class="col-2">
                                <a href="{{ route('admin.order.create') }}" class="btn btn-block bg-gradient-secondary">Добавить</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Административная панель</a></li>
                            <li class="breadcrumb-item active">Список заказов</li>
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
                                            <th class="p-2 text-center">Заказчик</th>
                                            <th class="p-2 text-center">Статус заказа</th>
                                            <th class="p-2 text-center" colspan="3">Действия</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (isset($orders))
                                            @foreach ($orders as $order)
                                                <tr class="edit-page" data-id="{{ $order->id }}">
                                                    <td class="p-2 text-center pt-3">{{ $order->user?->getFullName() }}</td>
                                                    <td class="p-2 text-center pt-3">{{ $order?->getStatus() }}</td>
                                                    <td class="text-center p-1 pt-3">
                                                        <button class="btn btn-danger" onclick="deleteConfirmation({{ $order->id }})">Удалить</button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
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
                    @if (isset($orders))
                        <div class="col-8 d-flex p-1 mt-2 justify-content-end ">
                            {!! $orders->links()->render() !!}
                        </div>
                    @endif
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
                        url: "{{ url('admin/order/delete/') }}/" + id,
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
