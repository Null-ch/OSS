@extends('admin.layouts.main')
@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Редактирование данных о пользователе</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="/admin">Административная панель</a></li>
                                <li class="breadcrumb-item"><a href="/admin/users">Список пользователей</a></li>
                                <li class="breadcrumb-item active">Редактирование данных о пользователе</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 ml-2 p-2">
                        <form action="{{ route('admin.user.update', $user->id) }}" method="POST" class="col-10">
                            @csrf
                            @method('PATCH')
                            <div class="row p-1">
                                <div class="form-group p-1 text-center col-md-6">
                                    <label>Фамилия</label>
                                    <input type="text" class="form-control text-center" name="first_name" placeholder="Олег" value="{{ $user->first_name }}">
                                    @error('first_name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group p-1 text-center col-md-6">
                                    <label>Имя</label>
                                    <input type="text" class="form-control text-center" name="name" placeholder="Олег" value="{{ $user->name }}">
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row p-1">
                                <div class="form-group p-1 text-center col-md-6">
                                    <label>Email</label>
                                    <input type="text" class="form-control text-center" name="email" placeholder="qwerty@yandex.ru" value="{{ $user->email }}">
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group p-1 text-center col-md-6">
                                    <label>Отчество</label>
                                    <input type="text" class="form-control text-center" name="last_name" placeholder="Олег" value="{{ $user->last_name }}">
                                    @error('last_name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group text-center p-1 col-md-6">
                                    <label>Пол</label>
                                    <select name="role" class="form-control text-center">
                                        <option value="0" {{ $user->gender == 0 ? 'selected' : '' }}>Мужской</option>
                                        <option value="1" {{ $user->gender == 1 ? 'selected' : '' }}>Женский</option>
                                    </select>
                                    @error('role')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group text-center p-1 col-md-6">
                                    <label>Выберите роль</label>
                                    <select name="role" class="form-control text-center">
                                        @foreach ($roles as $id => $role)
                                            <option value="{{ $id }}" {{ $user->role ? 'selected' : '' }}>
                                                {{ $role }}</option>
                                        @endforeach
                                    </select>
                                    @error('role')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="md-form p-1">
                                <label>Активность</label>
                                <div class="form-group">
                                    <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                        <input type="checkbox" class="custom-control-input" id="customSwitch3" name="toggle" value="{{ $user->id }}" {{ $user->isActive === 1 ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="customSwitch3"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group w-50">
                                <input type="hidden" name="user_id" value="{{ $user->id }}">
                            </div>
                            <div class="row">
                                <div class="col-2 p-1">
                                    <input type="submit" class="btn btn-block bg-gradient-secondary mt-2" value="Обновить">
                                </div>
                                <div class="col-2 p-1">
                                    <a href="{{ url()->previous() }}" class="btn btn-block bg-gradient-secondary mt-2">Назад</a>
                                </div>
                            </div>
                        </form>
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
