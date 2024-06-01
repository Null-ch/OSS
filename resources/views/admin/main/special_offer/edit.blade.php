@extends('admin.layouts.main')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <div class="row">
                        <h2>Редактирование специального предложения</h2>
                        <div class="col-2">
                            <a href="{{ url()->previous() }}" class="btn btn-block bg-gradient-secondary">Назад</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Административная панель</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.special-offers.index') }}">Список спец. предложений</a></li>
                        <li class="breadcrumb-item active">Редактирование спец. предложения</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 ml-2 p-2">
                    <h3>Редактирование специального предложения</h3>
                    <form action="{{ route('admin.special-offer.update', $specialOffer->id) }}" method="POST" class="w-25" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="row p-1">
                            <div class="form-group p-1 text-center col-md-12">
                                <label>Заголовок</label>
                                <input type="text" class="form-control text-center" name="header" placeholder="Введите название" value="{{$specialOffer->header}}">
                                @error('header')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row p-1">
                            <div class="form-group p-1 text-center col-md-12">
                                <label>Описание</label>
                                <textarea class="form-control" rows="3" name="description" placeholder="Введите описание ..." style="height: 89px;" value="{{$specialOffer->description}}">{{$specialOffer->description}}</textarea>
                                @error('description')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row p-1">
                            <div class="form-group text-center p-1 col-md-6">
                                <label>Цвет</label>
                                <input class="form-control text-" type="color" id="color" name="hex_code" value="{{$specialOffer->hex_code}}" />
                            </div>
                            <div class="form-group p-1 text-center col-md-6">
                                <label>Позиция в ленте</label>
                                <input type="number" class="form-control text-center" name="sort_order" placeholder="Введите название" min="1" value="{{$specialOffer->sort_order}}">
                                @error('sort_order')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
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
                                                <input type="file" class="uploadFile img" name="image" style="width: 0px;height: 0px;overflow: hidden;">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center p-1 col-md-12">
                            <div class="row justify-content-center">
                                <div>
                                    <label>Укажите текущую активность</label>
                                    <div class="form-check card card-secondary">
                                        <div class="p-2">
                                            <input class="form-check-input" type="checkbox" name="is_active" id="is_active_checkbox" {{$specialOffer->is_active == 1 ? 'checked' : ''}} >
                                            <label class="form-check-label" for="is_active_checkbox">Активный</label>
                                        </div>
                                    </div>
                                    @error('is_active')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
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
        var imageSrc = "{{ asset($specialOffer->image) }}";

        var img = new Image();
        img.src = imageSrc;
        img.alt = "Preview Image";

        img.addEventListener('load', function() {
            imagePreview.style.backgroundImage = "url(" + img.src + ")";
            imagePreview.style.backgroundSize = "contain";
            imagePreview.style.backgroundPosition = "center";
            imagePreview.style.width = "100%";
            imagePreview.style.height = "230px";
        });
    });
</script>

@endsection
