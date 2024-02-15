@extends('admin.layouts.main')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <div class="row">
                            <h2>Просмотр данных о товаре</h2>
                            <div class="col-2">
                                <a href="{{ route('admin.product.edit', $product->id) }}" class="text-success"><i class="fas fa-pencil-alt"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Административная панель</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">Список товаров</a></li>
                            <li class="breadcrumb-item active">Просмотр данных о товаре</li>
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
                            <div class="row">
                                <div class="card-body table-responsive p-0">
                                    <table class="table table-hover text-nowrap">
                                        <tbody>
                                            <tr>
                                                <th class="text-center">ID</th>
                                                <th class="text-center">Название</th>
                                                <th class="text-center">Описание</th>
                                                <th class="text-center">Остаток</th>
                                                <th class="text-center">Категория</th>
                                                <th class="text-center">Цвет</th>
                                            </tr>
                                            <tr>
                                                <td class="text-center">{{ $product->id }}</td>
                                                <td class="text-center">{{ $product->title }}</td>
                                                <td class="text-center">{{ $product->price }}</td>
                                                <td class="text-center">{{ $product->count }}</td>
                                                <td class="text-center">{{ $product->category->title }}</td>
                                                <td style="justify-content: center; align-items: center;">
                                                    <div style="background-color: {{ $product->hex_code }}; width: 20px; height: 20px;"></div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="row p-1">
                                <div class="text-center p-1 col-md-12">
                                    <div class="row justify-content-center">
                                        <label class="text-center">Фотографии товара</label>
                                    </div>
                                    <div class="row p-1">
                                        <div class="file-upload col-md-4">
                                            <div class="imgUp">
                                                <div class="imagePreview" id="1">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="file-upload col-md-4">
                                            <div class="imgUp">
                                                <div class="imagePreview" id="2"></div>
                                            </div>
                                        </div>
                                        <div class="file-upload col-md-4">
                                            <div class="imgUp">
                                                <div class="imagePreview" id="3"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="row">
                                <div class="text-center p-1 col-md-12">
                                    <div class="row justify-content-center">
                                        <div>
                                            <label>Обложка товара</label>
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
            var imageSrc = "{{ asset($product->preview_image) }}";

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
    <script>
        window.addEventListener('DOMContentLoaded', function() {
            let images = {!! json_encode($images) !!};
            images.forEach(function(image, index) {
                var imagePath = image.image_path;
                var rootUrl = window.location.origin;
                var imageUrl = rootUrl + '/' + imagePath;

                var imagePreview = document.getElementById(index + 1);
                imagePreview.style.backgroundImage = "url('" + imageUrl + "')";
                imagePreview.style.backgroundSize = "contain";
                imagePreview.style.backgroundPosition = "center";
                imagePreview.style.width = "100%";
                imagePreview.style.height = "250px";
            });
        });
    </script>
@endsection
