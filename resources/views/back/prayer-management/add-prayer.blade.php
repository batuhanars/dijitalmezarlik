@extends('back.layout.main')
@section('title', 'Dua Ekle')
@section('content')
    <!--begin::Toolbar-->
    <div class="toolbar mb-5 mb-lg-7" id="kt_toolbar">
        <!--begin::Page title-->
        <div class="page-title d-flex flex-column me-3">
            <!--begin::Title-->
            <h1 class="d-flex text-dark fw-bolder my-1 fs-3">Dua Ekle</h1>
            <!--end::Title-->
            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-dot fw-bold text-gray-600 fs-7 my-1">
                <!--begin::Item-->
                <li class="breadcrumb-item text-gray-600">
                    <a href="{{ route('panel') }}" class="text-gray-600 text-hover-primary">Anasayfa</a>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item text-gray-600">Dua Yönetimi</li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item text-gray-600">Dua Ekle</li>
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
                <h3 class="card-title">Dua Ekle</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('prayers.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-5">
                        <label for="video_image" class="form-label">Video Resmi</label>
                        <span class="text-danger d-block">{{ $errors->first('video_image') }}</span>
                        <input type="file" name="video_image" id="video_image" class="form-control form-control-solid"
                            placeholder="Video Resmi">
                    </div>
                    <div class="form-group mb-5">
                        <label for="embed_code" class="form-label">Video Embed Kodu <small>(Örn:
                                HGY-4cDZ6ks)</small></label>
                        <span class="text-danger d-block">{{ $errors->first('embed_code') }}</span>
                        <input type="text" name="embed_code" id="embed_code" class="form-control form-control-solid"
                            placeholder="Embed Kodu" autocomplete="off" value="{{ old('embed_code') }}">
                    </div>
                    <div class="form-group mb-5">
                        <label for="title" class="form-label">Dua Adı</label>
                        <span class="text-danger d-block">{{ $errors->first('title') }}</span>
                        <input type="text" name="title" id="title" class="form-control form-control-solid"
                            placeholder="Dua Adı" autocomplete="off" value="{{ old('title') }}">
                    </div>
                    <div class="form-group mb-5">
                        <label for="content" class="form-label">Dua İçerik</label>
                        <span class="text-danger d-block">{{ $errors->first('content') }}</span>
                        <textarea name="content" id="content" class="form-control form-control-solid"></textarea>
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
            $('#content').summernote({
                height: 200,
            });
        });
    </script>
@endsection
