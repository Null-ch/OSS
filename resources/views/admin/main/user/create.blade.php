@extends('admin.layouts.main')
@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 ml-2 p-2">
                        <h3>Добавление пользователя</h3>
                        <form action="{{ route('admin.user.store') }}" method="POST" class="w-25">
                            @csrf
                            <div class="form-group">
                                <label>Фамилия пользователя</label>
                                <input type="text" class="form-control" name="first_name" placeholder="Олегов">
                                @error('first_name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Имя пользователя</label>
                                <input type="text" class="form-control" name="name" placeholder="Олег">
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Отчество пользователя</label>
                                <input type="text" class="form-control" name="last_name" placeholder="Олегович">
                                @error('last_name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" class="form-control" name="email" placeholder="qwerty@yandex.ru">
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Пол</label>
                                <select name="gender" class="form-control">
                                    @foreach ($genders as $id => $gender)
                                        <option value="{{ $id }}"{{ $id == old('gender') ? 'selected' : '' }}>
                                            {{ $gender }}</option>
                                    @endforeach
                                </select>
                                @error('gender')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Пароль</label>
                                <input type="text" class="form-control" name="password" placeholder="****">
                                @error('password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Выберите роль</label>
                                <select name="role" class="form-control">
                                    @foreach ($roles as $id => $role)
                                        <option value="{{ $id }}"{{ $id == old('role') ? 'selected' : '' }}>
                                            {{ $role }}</option>
                                    @endforeach
                                </select>
                                @error('role')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <input type="submit" class="btn btn-primary mt-2" value="Добавить">
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
