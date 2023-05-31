@extends('back.layout.main')
@section('title', 'Ürün Ekle')
@section('content')
    <!--begin::Toolbar-->
    <div class="toolbar mb-5 mb-lg-7" id="kt_toolbar">
        <!--begin::Page title-->
        <div class="page-title d-flex flex-column me-3">
            <!--begin::Title-->
            <h1 class="d-flex text-dark fw-bolder my-1 fs-3">Ürün Ekle</h1>
            <!--end::Title-->
            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-dot fw-bold text-gray-600 fs-7 my-1">
                <!--begin::Item-->
                <li class="breadcrumb-item text-gray-600">
                    <a href="{{ route('panel') }}" class="text-gray-600 text-hover-primary">Anasayfa</a>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item text-gray-600">Ürün Yönetimi</li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item text-gray-600">Ürün Ekle</li>
                <!--end::Item-->
            </ul>
            <!--end::Breadcrumb-->
        </div>
        <!--end::Page title-->
    </div>
    <!--end::Toolbar-->
    <!--begin::Post-->
    <div class="content flex-column-fluid" id="kt_content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Ürün Ekle</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-5">
                        <label for="image" class="form-label">Ürün Resmi</label>
                        <span class="text-danger d-block">{{ $errors->first('image') }}</span>
                        <input type="file" id="image" name="image[]" multiple
                            class="form-control form-control-solid">
                    </div>
                    <div class="form-group mb-5">
                        <label for="title" class="form-label">Başlık</label>
                        <span class="text-danger d-block">{{ $errors->first('title') }}</span>
                        <input type="text" name="title" id="title" class="form-control form-control-solid"
                            placeholder="Başlık Giriniz" autocomplete="off" value="{{ old('title') }}">
                    </div>
                    <div class="form-group mb-5">
                        <label for="price" class="form-label">Fiyat</label>
                        <span class="text-danger d-block">{{ $errors->first('price') }}</span>
                        <input type="number" name="price" id="price" class="form-control form-control-solid"
                            placeholder="Fiyat Giriniz" autocomplete="off" value="{{ old('price') }}">
                    </div>
                    <div class="form-group mb-5">
                        <label for="status" class="form-label">Durum</label>
                        <select name="status" id="status" class="form-select form-select-solid">
                            <option value="1">Aktif</option>
                            <option value="0">Pasif</option>
                        </select>
                    </div>
                    <div class="form-group mb-5">
                        <label for="description" class="form-label">Kısa Açıklama</label>
                        <span class="text-danger d-block">{{ $errors->first('description') }}</span>
                        <textarea name="description" id="description" class="form-control form-control-solid">{{ old('description') }}</textarea>
                    </div>
                    <div class="form-group mb-5">
                        <label for="content" class="form-label">İçerik</label>
                        <span class="text-danger d-block">{{ $errors->first('content') }}</span>
                        <textarea name="content" id="content" class="form-control form-control-solid">{{ old('content') }}</textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Kaydet</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--end::Post-->
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $('#content').summernote();
        });
    </script>
@endsection
