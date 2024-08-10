@extends('admin.layouts.main')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <div class="row">
                            <h2>Редактирование данных о пользователе</h2>
                            <div class="col-2">
                                <a href="{{ route('admin.user.edit', $user->id) }}" class="text-success"><i class="fas fa-pencil-alt"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Административная панель</a></li>
                            <li class="breadcrumb-item"><a href="{{route('admin.users.index')}}">Список пользователей</a></li>
                            <li class="breadcrumb-item active">Редактирование данных о пользователе</li>
                        </ol>
                    </div>
                </div>

            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 ml-2 p-2">
                        <form action="{{ route('admin.user.update', $user->id) }}" method="POST" class="col-10">
                            @csrf
                            @method('PATCH')
                            <div class="row p-1">
                                <div class="form-group p-1 text-center col-md-6">
                                    <label>Фамилия</label>
                                    <input type="text" class="form-control text-center" name="middle_name" placeholder="Олег" value="{{ $user->middle_name }}">
                                    @error('middle_name')
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
        </section>
    </div>
@endsection
@section('scripts')
@endsection
