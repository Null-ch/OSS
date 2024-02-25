@extends('admin.layouts.main')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <div class="row">
                            <h2>Список категорий </h2>
                            <div class="col-2">
                                <a href="{{ route('admin.category.create') }}" class="btn btn-block bg-gradient-secondary">Добавить</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Административная панель</a></li>
                            <li class="breadcrumb-item active">Список категорий</li>
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
                                            <th class="p-2 text-center">Название</th>
                                            <th class="p-2 text-center">Активность</th>
                                            <th class="p-2 text-center" colspan="3">Действия</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $category)
                                            <tr data-id="{{ $category->id }}">
                                                <td class="p-2 text-center">{{ $category->title }}</td>
                                                <td class="p-2 text-center">
                                                    <div class="p-2">
                                                        <label class="toggle">
                                                            <input class="toggle-checkbox" type="checkbox" name="is_active" id="is_active_checkbox_{{ $category->id }}" {{ $category->is_active ? 'checked' : '' }} value="{{ $category->id }}">
                                                            <div class="toggle-switch"></div>
                                                        </label>
                                                    </div>
                                                </td>
                                                <td class="text-center" class="p-2"><a href="{{ route('admin.category.show', $category->id) }}"><i class="far fa-eye"></i></a></td>
                                                <td class="text-center" class="p-2"><a href="{{ route('admin.category.edit', $category->id) }}" class="text-success"><i class="fas fa-pencil-alt"></i></a></td>
                                                <td class="text-center p-1">
                                                    <button class="btn btn-danger" onclick="deleteConfirmation({{ $category->id }})">Удалить</button>
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
                    <div class="col-8 d-flex p-1 mt-2 justify-content-end ">
                        {!! $categories->links()->render() !!}
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
                        url: "{{ url('admin/category/delete/') }}/" + id,
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
