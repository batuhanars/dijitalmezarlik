@extends('back.layout.main')
@section('title', $appFeature->title)
@section('content')
    <!--begin::Toolbar-->
    <div class="toolbar mb-5 mb-lg-7" id="kt_toolbar">
        <!--begin::Page title-->
        <div class="page-title d-flex flex-column me-3">
            <!--begin::Title-->
            <h1 class="d-flex text-dark fw-bolder my-1 fs-3">{{ $appFeature->title }}</h1>
            <!--end::Title-->
            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-dot fw-bold text-gray-600 fs-7 my-1">
                <!--begin::Item-->
                <li class="breadcrumb-item text-gray-600">
                    <a href="{{ route('panel') }}" class="text-gray-600 text-hover-primary">Anasayfa</a>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item text-gray-600">Site Yönetimi</li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item text-gray-600">{{ $appFeature->title }}</li>
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
                <h3 class="card-title">Uygulama Özelliği Güncelle</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('app-features.update', $appFeature->id) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method("PUT")
                    <div class="form-group mb-5">
                        <label for="icon" class="form-label">İkon</label>
                        <span class="text-danger d-block">{{ $errors->first('icon') }}</span>
                        <input type="file" name="icon" id="icon" class="form-control form-control-solid"
                            value="{{ $appFeature->icon }}">
                    </div>
                    <div class="form-group mb-5">
                        <label for="title" class="form-label">Başlık</label>
                        <span class="text-danger d-block">{{ $errors->first('title') }}</span>
                        <input type="text" name="title" id="title" class="form-control form-control-solid"
                            value="{{ $appFeature->title }}" placeholder="Başlık" autocomplete="off">
                    </div>
                    <div class="form-group mb-5">
                        <label for="description" class="form-label">Kısa Açıklama</label>
                        <span class="text-danger d-block">{{ $errors->first('description') }}</span>
                        <textarea name="description" id="description" class="form-control form-control-solid"
                            placeholder="Kısa açıklama" data-kt-autosize="true">{{ $appFeature->description }}</textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Güncelle</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--end::Post-->
@endsection
