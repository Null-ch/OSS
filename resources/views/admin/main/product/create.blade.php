@extends('admin.layouts.main')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <div class="row">
                            <h2>Добавление товара</h2>
                            <div class="col-2">
                                <a href="{{ url()->previous() }}" class="btn btn-block bg-gradient-secondary">Назад</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Административная панель</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">Список товаров</a></li>
                            <li class="breadcrumb-item active">Добавление товара</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 ml-2 p-2">
                        <form action="{{ route('admin.product.store') }}" method="POST" class="w-50" enctype="multipart/form-data">
                            @csrf
                            <div class="row p-1">
                                <div class="form-group p-1 text-center col-md-12">
                                    <label>Название</label>
                                    <input type="text" class="form-control text-center" name="title" placeholder="Введите название">
                                    @error('title')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row p-1">
                                <div class="form-group p-1 text-center col-md-12">
                                    <label>Описание</label>
                                    <textarea class="form-control" rows="3" name="description" placeholder="Введите описание ..." style="height: 89px;"></textarea>
                                    @error('description')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row p-1">
                                <div class="form-group p-1 text-center col-md-6">
                                    <label>Цена</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control text-center" name="price" placeholder="Установите цену за шт.">
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
                                    <input type="number" class="form-control text-center" name="quantity" placeholder="Установите количество товара на складе" min="0" value="0">
                                    @error('quantity')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row p-1">
                                <div class="form-group text-center p-1 col-md-6">
                                    <label>Категория</label>
                                    <select name="category_id" class="form-control text-center">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">
                                                {{ $category->title }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group text-center p-1 col-md-6">
                                    <label>Цвет</label>
                                    <input class="form-control text-" type="color" id="color" name="hex_code" value="#00000" />
                                </div>
                            </div>
                            <div class="text-center p-1 col-md-12">
                                <div class="row justify-content-center">
                                    <div>
                                        <label>Загрузите обложку товара</label>
                                        <div class="file-upload" id="1">
                                            <div class="imgUp">
                                                <div class="imagePreview"></div>
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
                                    <div class="file-upload col-md-4" id="1">
                                        <div class="imgUp">
                                            <div class="imagePreview"></div>
                                            <label class="btn btn-block bg-gradient-secondary">
                                                Выбрать
                                                <input type="file" class="uploadFile img" name="img_1" style="width: 0px;height: 0px;overflow: hidden;">
                                            </label>
                                        </div>
                                    </div>
                                    <div class="file-upload col-md-4" id="2">
                                        <div class="imgUp">
                                            <div class="imagePreview"></div>
                                            <label class="btn btn-block bg-gradient-secondary">
                                                Выбрать
                                                <input type="file" class="uploadFile img" name="img_2" style="width: 0px;height: 0px;overflow: hidden;">
                                            </label>
                                        </div>
                                    </div>
                                    <div class="file-upload col-md-4" id="3">
                                        <div class="imgUp">
                                            <div class="imagePreview"></div>
                                            <label class="btn btn-block bg-gradient-secondary">
                                                Выбрать
                                                <input type="file" class="uploadFile img" name="img_3" style="width: 0px;height: 0px;overflow: hidden;">
                                            </label>
                                        </div>
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
