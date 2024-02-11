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
                        <form action="{{ route('admin.product.store') }}" method="POST" class="w-25" enctype="multipart/form-data">
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
                                    <input type="text" class="form-control text-center" name="price" placeholder="Установите цену за шт.">
                                    @error('price')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group p-1 text-center col-md-6">
                                    <label>Текущее количество</label>
                                    <input type="text" class="form-control text-center" name="count" placeholder="Установите количество товара на складе">
                                    @error('count')
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
                            <div class="text-center p-1 col-md-12 input-file-row">
                                <div class="row justify-content-end">
                                    <div>
                                        <span>Загрузите обложку товара</span>
                                        <label class="input-file">
                                            <input type="file" name="preview_image" />
                                            <span>Выберите файл</span>
                                        </label>
                                        <div class="input-file-list"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center p-1 col-md-12 input-file-row">
                                <div class="row justify-content-end">
                                    <div>
                                        <span>Загрузите фото товара</span>
                                        <label class="input-file">
                                            <input type="file" name="product_images[]" multiple accept="image/*" max="4" />
                                            <span>Выберите файлы</span>
                                        </label>
                                        <div class="input-file-list"></div>
                                    </div>
                                </div>
                            </div>
                            <input type="submit" class="btn btn-block bg-gradient-secondary" value="Добавить">
                        </form>
                    </div>
                    <div class="row">
                        <div class="scroll-to-top" onclick="scrollToTop()">
                            <i class="fa fa-angle-up" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        var dt = new DataTransfer();

        $('.input-file input[type=file]').on('change', function() {
            let $files_list = $(this).closest('.input-file').next();
            $files_list.empty();

            for (var i = 0; i < this.files.length; i++) {
                let file = this.files.item(i);
                dt.items.add(file);

                let reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onloadend = function() {
                    let new_file_input = '<div class="input-file-list-item">' +
                        '<img class="input-file-list-img" src="' + reader.result + '">' +
                        '<span class="input-file-list-name">' + file.name + '</span>' +
                        '<a href="#" onclick="removeFilesItem(this); return false;" class="input-file-list-remove">x</a>' +
                        '</div>';
                    $files_list.append(new_file_input);
                }
            };
            this.files = dt.files;
        });

        function removeFilesItem(target) {
            let name = $(target).prev().text();
            let input = $(target).closest('.input-file-row').find('input[type=file]');
            $(target).closest('.input-file-list-item').remove();
            for (let i = 0; i < dt.items.length; i++) {
                if (name === dt.items[i].getAsFile().name) {
                    dt.items.remove(i);
                }
            }
            input[0].files = dt.files;
        }
    </script>
@endsection
