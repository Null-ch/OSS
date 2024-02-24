@extends('admin.layouts.main')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <div class="row">
                            <h2>Просмотр данных о пользователе</h2>
                            <div class="col-2">
                                <a href="{{ route('admin.category.edit', $category->id) }}" class="text-success"><i class="fas fa-pencil-alt"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Административная панель</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.categories.index') }}">Список категорий</a></li>
                            <li class="breadcrumb-item active">Просмотр данных о категории</li>
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
                                    <tbody>
                                        <tr>
                                            <th class="text-center">ID</th>
                                            <th class="text-center">Название</th>
                                            <th class="text-center">Дата создания</th>
                                            <th class="text-center">Дата обновления</th>
                                        </tr>
                                        <tr>
                                            <td class="text-center">{{ $category->id }}</td>
                                            <td class="text-center">{{ $category->title }}</td>
                                            <td class="text-center">{{ $category->created_at }}</td>
                                            <td class="text-center">{{ $category->updated_at }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="text-center p-1 col-md-12">
                        <div class="row justify-content-center">
                            <div>
                                <label>Обложка категории</label>
                                <div class="file-upload">
                                    <div class="imgUp">
                                        <div class="imagePreview" id="preview_image">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-2 p-1">
                        <a href="{{ url()->previous() }}" class="btn btn-block bg-gradient-secondary mt-2">Назад</a>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('scripts')
<script>
    window.addEventListener('DOMContentLoaded', function() {
        var imagePreview = document.getElementById('preview_image');
        var imageSrc = "{{ asset($category->preview_image) }}";

        var img = new Image();
        img.src = imageSrc;
        img.alt = "Preview Image";

        img.addEventListener('load', function() {
            imagePreview.style.backgroundImage = "url(" + img.src + ")";
            imagePreview.style.backgroundSize = "contain";
            imagePreview.style.backgroundPosition = "center";
            imagePreview.style.width = "430px";
            imagePreview.style.height = "400px";
        });
    });
</script>
@endsection
