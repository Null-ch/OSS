@extends('admin.layouts.main')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <div class="row">
                            <h2>Просмотр данных о спец. предложении</h2>
                            <div class="col-2">
                                <a href="{{ route('admin.special-offer.edit', $specialOffer->id) }}" class="text-success"><i class="fas fa-pencil-alt  pt-3"></i></a>
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
                    <div class="col-10">
                        <div class="card">
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <tbody>
                                        <tr>
                                            <th class="text-center">ID</th>
                                            <th class="text-center">Заголовок</th>
                                            <th class="text-center">Описание</th>
                                            <th class="text-center">Позиция в сетке</th>
                                            <th class="text-center">Цвет</th>
                                            <th class="text-center">Активность</th>
                                            <th class="text-center">Дата создания</th>
                                            <th class="text-center">Дата обновления</th>
                                        </tr>
                                        <tr>
                                            <td class="text-center">{{ $specialOffer->id }}</td>
                                            <td class="text-center">{{ $specialOffer->header }}</td>
                                            <td class="text-center">{{ $specialOffer->description }}</td>
                                            <td class="text-center">{{ $specialOffer->sort_order }}</td>
                                            <td class="text-center">{{ $specialOffer->hex_code }}</td>
                                            <td class="text-center"><input class="form-check-input" type="checkbox" name="is_active" id="is_active_checkbox" {{ $specialOffer->is_active == 1 ? 'checked' : '' }} disabled></td>
                                            <td class="text-center">{{ $specialOffer->created_at }}</td>
                                            <td class="text-center">{{ $specialOffer->updated_at }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card p-1">
                            <label class="text-center">Обложка</label>
                            <div class="imagePreview p-2" id="preview_image"></div>
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
            var imageSrc = "{{ asset($specialOffer->image) }}";

            var img = new Image();
            img.src = imageSrc;
            img.alt = "Preview Image";

            img.addEventListener('load', function() {
                imagePreview.style.backgroundImage = "url(" + img.src + ")";
                imagePreview.style.backgroundSize = "contain";
                imagePreview.style.backgroundPosition = "center";
                imagePreview.style.backgroundRepeat = "no-repeat";
                imagePreview.style.width = "100%";
                imagePreview.style.height = "430px";
            });
        });
    </script>
@endsection
