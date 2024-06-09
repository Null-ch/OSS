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
                            <div class="form-group">
                                <label>Описание</label>
                                <textarea rows="5" cols="30" class="form-control" name="description" placeholder="Описание категории...">{{ $category->description ? $category->description : old('description')}}</textarea>
                                @error('description')
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
        function setImageBackground(elementId, imagePath) {
            var imagePreview = document.getElementById(elementId);
            if (!imagePreview) return;

            var img = new Image();
            img.src = imagePath;
            img.alt = "Preview Image";

            img.addEventListener('load', function() {
                imagePreview.style.backgroundImage = "url(" + img.src + ")";
                imagePreview.style.backgroundSize = "contain";
                imagePreview.style.backgroundPosition = "center";
                imagePreview.style.backgroundRepeat = "no-repeat";
                imagePreview.style.width = "100%";
                imagePreview.style.height = "230px";
            });
        }

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
                            "backgroundRepeat": "no-repeat",
                            "width": "100%",
                            "height": "230px"
                        });
                    }
                }
            });

            var previewImageElementId = 'preview_image';
            var previewImagePath = "{{ asset($category->preview_image) }}";
            setImageBackground(previewImageElementId, previewImagePath);

        });
    </script>
@endsection
