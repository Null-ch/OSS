@extends('admin.layouts.main')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <div class="row">
                            <h2>Товары</h2>
                            <div class="col-2">
                                <a href="{{ route('admin.product.create') }}" class="btn btn-block bg-gradient-secondary">Добавить</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Административная панель</a></li>
                            <li class="breadcrumb-item active">Список товаров</li>
                        </ol>
                    </div>
                </div>

            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th class="p-2 text-center">Название</th>
                                            <th class="p-2 text-center">Цена</th>
                                            <th class="p-2 text-center">Количество</th>
                                            <th class="p-2 text-center">Категория</th>
                                            <th class="p-2 text-center">Активность</th>
                                            <th class="p-2 text-center" colspan="3">Действия</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (isset($products))
                                            @foreach ($products as $product)
                                                <tr class="edit-page" data-id="{{ $product->id }}">
                                                    <td class="p-2 text-center pt-3">{{ $product->title }}</td>
                                                    <td class="p-2 text-center pt-3">{{ $product->price }}</td>
                                                    <td class="p-2 text-center pt-3">{{ $product->quantity }}</td>
                                                    {{-- <td class="p-2 text-center pt-3">{{ $product->category->title }}</td> --}}
                                                    <td class="p-2 text-center pt-3">
                                                        @if($product->category)
                                                            {{ $product->category->title }}
                                                        @else
                                                            Без категории
                                                        @endif
                                                    </td>
                                                    <td class="p-2 text-center">
                                                        <div class="p-2">
                                                            <label class="toggle">
                                                                <input class="toggle-checkbox" type="checkbox" name="is_active" id="is_active_checkbox_{{ $product->id }}" {{ $product->is_active ? 'checked' : '' }} value="{{ $product->id }}">
                                                                <div class="toggle-switch"></div>
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td class="text-center p-1 pt-3">
                                                        <button class="btn btn-danger" onclick="deleteConfirmation({{ $product->id }})">Удалить</button>
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
                    @if (isset($products))
                        <div class="col-8 d-flex p-1 mt-2 justify-content-end ">
                            {!! $products->links()->render() !!}
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
    <script>
        $(document).ready(function() {
            $('input[name="is_active"]').change(function() {
                let id = $(this).val();
                let url = '/admin/product/activity/' + id;

                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(response) {},
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
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
                        url: "{{ url('admin/product/delete/') }}/" + id,
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
