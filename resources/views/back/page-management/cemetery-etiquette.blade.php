@extends('back.layout.main')
@section('title', 'Mezarlık Adabı')
@section('content')
    <!--begin::Toolbar-->
    <div class="toolbar mb-5 mb-lg-7" id="kt_toolbar">
        <!--begin::Page title-->
        <div class="page-title d-flex flex-column me-3">
            <!--begin::Title-->
            <h1 class="d-flex text-dark fw-bolder my-1 fs-3">Mezarlık Adabı</h1>
            <!--end::Title-->
            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-dot fw-bold text-gray-600 fs-7 my-1">
                <!--begin::Item-->
                <li class="breadcrumb-item text-gray-600">
                    <a href="{{ route('panel') }}" class="text-gray-600 text-hover-primary">Anasayfa</a>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item text-gray-600">Sayfa Yönetimi</li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item text-gray-600">Mezarlık Adabı</li>
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
                <h3 class="card-title">Mezarlık Adabı</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('save.cemetery-etiquette') }}" method="post">
                    @csrf
                    <div class="form-group mb-5">
                        <label for="title" class="form-label">Başlık</label>
                        <span class="text-danger d-block">{{ $errors->first('title') }}</span>
                        <input type="text" name="title" id="title" class="form-control form-control-solid"
                            value="{{ $cemeteryEtiquette ? $cemeteryEtiquette->title : '' }}" placeholder="Başlık"
                            autocomplete="off">
                    </div>
                    <div class="form-group mb-5">
                        <label for="content" class="form-label">İçerik</label>
                        <span class="text-danger d-block">{{ $errors->first('content') }}</span>
                        <textarea name="content" id="content"
                            class="form-control form-control-solid">{{ $cemeteryEtiquette ? $cemeteryEtiquette->content : '' }}</textarea>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success">Kaydet</button>
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
