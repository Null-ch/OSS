@extends('admin.layouts.main')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <div class="row">
                            <h2>Добавление категории</h2>
                            <div class="col-2">
                                <a href="{{ url()->previous() }}" class="btn btn-block bg-gradient-secondary">Назад</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Административная панель</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.categories.index') }}">Список категорий</a></li>
                            <li class="breadcrumb-item active">Добавление категории</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 ml-2 p-2">
                        <h3>Добавление категории</h3>
                        <form action="{{ route('admin.category.store') }}" method="POST" class="w-25" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Название</label>
                                <input type="text" class="form-control" name="title" placeholder="Название категории..." value="{{old('title')}}">
                                @error('title')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Описание</label>
                                <textarea rows="5" cols="30" class="form-control" name="description" placeholder="Описание категории..." value="{{old('description')}}"></textarea>
                                @error('description')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="text-center p-1 col-md-12">
                                <div class="row justify-content-center">
                                    <div>
                                        <span>Загрузите обложку категории</span>
                                        <div class="file-upload" id="1">
                                            <div class="imgUp">
                                                <div class="imagePreview"></div>
                                                <label class="btn btn-block bg-gradient-secondary">
                                                    Выбрать
                                                    <input type="file" class="uploadFile img" name="preview_image" style="width: 0px;height: 0px;overflow: hidden;">
                                                </label>
                                            </div>
                                        </div>
                                        @error('preview_image')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <input type="submit" class="btn btn-block bg-gradient-secondary" value="Добавить">
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
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
                            "backgroundRepeat": "no-repeat",
                            "width": "100%",
                            "height": "230px"
                        });
                    }
                }
            });
        });
    </script>
@endsection
