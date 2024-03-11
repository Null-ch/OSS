@extends('admin.layouts.main')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <div class="row">
                            <h2>Редактирование категории</h2>
                            <div class="col-2">
                                <a href="{{ url()->previous() }}" class="btn btn-block bg-gradient-secondary">Назад</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Административная панель</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.categories.index') }}">Список категорий</a></li>
                            <li class="breadcrumb-item active">Редактирование категории</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 ml-2 p-2">
                        <h3>Редактирование категории</h3>
                        <form action="{{ route('admin.category.update', $category->id) }}" method="POST" class="w-25" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <label>Название</label>
                                <input type="text" class="form-control" name="title" placeholder="Название категории..." value="{{ $category->title }}">
                                @error('title')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="text-center p-1 col-md-12">
                                <div class="row justify-content-center">
                                    <div>
                                        <label>Измените обложку категории</label>
                                        <div class="file-upload">
                                            <div class="imgUp">
                                                <div class="imagePreview" id="preview_image">
                                                </div>
                                                <label class="btn btn-block bg-gradient-secondary">
                                                    Выбрать
                                                    <input type="file" class="uploadFile img" name="preview_image" style="width: 0px;height: 0px;overflow: hidden;">
                                                </label>
                                            </div>
                                            @error('preview_image')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="submit" class="btn btn-block bg-gradient-secondary" value="Обновить">
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('scripts')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(function() {
            $(document).on("change", ".uploadFile", function() {
                var uploadFile = $(this);
                var files = !!this.files ? this.files : [];
                if (!files.length || !window.FileReader) return;
                if (/^image/.test(files[0].type)) {
                    var reader = new FileReader();
                    reader.readAsDataURL(files[0]);
                    reader.onloadend = function() {
                        uploadFile.closest(".imgUp").find('.imagePreview').css({
                            "background-image": "url(" + this.result + ")",
                            "background-size": "contain",
                            "background-position": "center",
                            "width": "100%",
                            "height": "230px"
                        });
                    }
                }
            });
        });
    </script>
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
