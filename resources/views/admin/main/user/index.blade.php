@extends('admin.layouts.main')
@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Список пользователей</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="/admin">Административная панель</a></li>
                                <li class="breadcrumb-item active">Список пользователей</li>
                            </ol>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-2">
                            <a href="{{ route('admin.user.create') }}" class="btn btn-block btn-primary mb 3">Добавить</a>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-10">
                        <div class="card">
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th class="p-2 text-center">Имя</th>
                                            <th class="p-2 text-center">Email</th>
                                            <th class="p-2 text-center">Роль</th>
                                            <th class="p-2 text-center">Дата создания</th>
                                            <th class="p-2 text-center">Дата изменения</th>
                                            <th class="p-2 text-center">Активность</th>
                                            <th class="p-2 text-center">Просмотр</th>
                                            <th class="p-2 text-center">Редактировать</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr data-id="{{ $user->id }}">
                                                <td class="p-2 text-center">{{ $user->name }}</td>
                                                <td class="p-2 text-center">{{ $user->email }}</td>
                                                <td class="p-2 text-center">{{ $user->role == 0 ? 'Администратор' : 'Пользователь' }}</td>
                                                <td class="p-2 text-center">{{ $user->created_at }}</td>
                                                <td class="p-2 text-center">{{ $user->updated_at }}</td>
                                                <td class="p-2 text-center" class="text-center">
                                                    <div class="form-group">
                                                        <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                                            <input type="checkbox" class="custom-control-input" id="customSwitch3" name="toggle" value="{{ $user->id }}" {{ $user->isActive === 1 ? 'checked' : '' }}>
                                                            <label class="custom-control-label" for="customSwitch3"></label>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-center" class="p-2"><a href="{{ route('admin.user.show', $user->id) }}"><i class="far fa-eye"></i></a></td>
                                                <td class="text-center" class="p-2"><a href="{{ route('admin.user.edit', $user->id) }}" class="text-success"><i class="fas fa-pencil-alt"></i></a></td>
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
@section('scripts')
    <script>
        $(document).ready(function() {
            $('#customSwitch3').click(function() {
                var isActive = $(this).prop('checked');
                $.ajax({
                    url: '/admin/users/activity',
                    method: 'POST',
                    data: {
                        user_id: $(this).val(),
                        is_active: isActive ? 1 : 0
                    },
                    success: function(response) {
                        console.log(response);
                    },
                    error: function(xhr, status, error) {
                        // Обработка ошибки
                    }
                });
            });
        });
    </script>
@endsection
