@extends('admin.layouts.main')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <div class="row">
                            <h2>Список пользователей </h2>
                            <div class="col-2">
                                <a href="{{ route('admin.user.create') }}" class="btn btn-block bg-gradient-secondary">Добавить</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Административная панель</a></li>
                            <li class="breadcrumb-item active">Список пользователей</li>
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
                                            <th class="p-2 text-center">Имя</th>
                                            <th class="p-2 text-center">Email</th>
                                            <th class="p-2 text-center">Роль</th>
                                            <th class="p-2 text-center">Дата создания</th>
                                            <th class="p-2 text-center">Дата изменения</th>
                                            <th class="p-2 text-center">Просмотр</th>
                                            <th class="p-2 text-center">Редактировать</th>
                                            <th class="p-2 text-center">Удалить</th>
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
                                                <td class="text-center" class="p-2"><a href="{{ route('admin.user.show', $user->id) }}"><i class="far fa-eye"></i></a></td>
                                                <td class="text-center" class="p-2"><a href="{{ route('admin.user.edit', $user->id) }}" class="text-success"><i class="fas fa-pencil-alt"></i></a></td>
                                                <td class="text-center p-2">
                                                    <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST">
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
                    <i class="fa fa-angle-up" aria-hidden="true"></i>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('scripts')
@endsection
