@extends('admin.layouts.main')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <div class="row">
                            <h2>Редактирование товара</h2>
                            <div class="col-2">
                                <a href="{{ route('admin.product.edit', $product->id) }}" class="text-success"><i class="fas fa-pencil-alt"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Административная панель</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">Список товаров</a></li>
                            <li class="breadcrumb-item active">Редактирование товара</li>
                        </ol>
                    </div>
                </div>

            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 ml-2 p-2">
                        <form action="{{ route('admin.product.update', $product->id) }}" method="POST" class="col-10" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="row p-1">
                                <div class="form-group p-1 text-center col-md-6">
                                    <label>Название</label>
                                    <input type="text" class="form-control text-center" name="title" placeholder="Введите название товара" value="{{ $product->title }}">
                                    @error('title')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group p-1 text-center col-md-6">
                                    <label>Описание</label>
                                    <input type="text" class="form-control text-center" name="description" placeholder="Введите описание товара" value="{{ $product->description }}">
                                    @error('description')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row p-1">
                                <div class="form-group p-1 text-center col-md-6">
                                    <label>Цена</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control text-center" name="price" placeholder="Установите цену за шт."value="{{ $product->price }}">
                                        <div class="input-group-append">
                                            <span class="input-group-text">₽</span>
                                        </div>
                                    </div>
                                    @error('price')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group p-1 text-center col-md-6">
                                    <label>Текущее количество</label>
                                    <input type="number" class="form-control text-center" name="quantity" placeholder="Установите количество товара на складе" min="0" value="{{ $product->quantity }}">
                                    @error('quantity')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row p-1">
                                <div class="form-group text-center p-1 col-md-6">
                                    <label>Категория</label>
                                    <select name="category_id" class="form-control text-center">
                                        @if ($product->category_id)
                                            <option value="{{ $product->category_id }}" {{ 'selected' }}> {{ $product->category->title }}</option>
                                        @else
                                            <option value="" {{ 'selected' }}>Без категории</option>
                                        @endif
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group text-center p-1 col-md-6">
                                    <label>Цвет</label>
                                    <input class="form-control text-" type="color" id="color" name="hex_code" value="{{ $product->hex_code }}" />
                                </div>
                            </div>
                            <div class="text-center p-1 col-md-12">
                                <div class="row justify-content-center">
                                    <div>
                                        <label>Загрузите обложку товара</label>
                                        <div class="file-upload">
                                            <div class="imgUp">
                                                <div class="imagePreview" id="preview_image">
                                                </div>
                                                <label class="btn btn-block bg-gradient-secondary">
                                                    Выбрать
                                                    <input type="file" class="uploadFile img" name="preview_image" style="width: 0px;height: 0px;overflow: hidden;">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center p-1 col-md-12">
                                <div class="row justify-content-center">
                                    <label class="text-center">Загрузите фотографии товара</label>
                                </div>
                                <div class="row p-1">
                                    <div class="file-upload col-md-4">
                                        <div class="imgUp">
                                            <div class="imagePreview" id="1">
                                            </div>
                                            <label class="btn btn-block bg-gradient-secondary">
                                                Выбрать
                                                <input type="file" class="uploadFile img" name="img_0" style="width: 0px;height: 0px;overflow: hidden;">
                                            </label>
                                        </div>
                                    </div>
                                    <div class="file-upload col-md-4">
                                        <div class="imgUp">
                                            <div class="imagePreview" id="2"></div>
                                            <label class="btn btn-block bg-gradient-secondary">
                                                Выбрать
                                                <input type="file" class="uploadFile img" name="img_1" style="width: 0px;height: 0px;overflow: hidden;">
                                            </label>
                                        </div>
                                    </div>
                                    <div class="file-upload col-md-4">
                                        <div class="imgUp">
                                            <div class="imagePreview" id="3"></div>
                                            <label class="btn btn-block bg-gradient-secondary">
                                                Выбрать
                                                <input type="file" class="uploadFile img" name="img_2" style="width: 0px;height: 0px;overflow: hidden;">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" value="{{ $images }}" name="images">
                            <div class="row p-1">
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
        {{-- {{dd($images )}} --}}
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
            var previewImagePath = "{{ asset($product->preview_image) }}";
            setImageBackground(previewImageElementId, previewImagePath);

            var images = {!! $images !!};
            images.forEach(function(image, index) {
                var imagePreviewElementId = (index + 1).toString();
                var imagePreviewImagePath = "/" + image.image_path;
                setImageBackground(imagePreviewElementId, imagePreviewImagePath);
            });
        });
    </script>
@endsection
