@extends('back.layout.main')
@section('title', $prayer->title)
@section('content')
    <!--begin::Toolbar-->
    <div class="toolbar mb-5 mb-lg-7" id="kt_toolbar">
        <!--begin::Page title-->
        <div class="page-title d-flex flex-column me-3">
            <!--begin::Title-->
            <h1 class="d-flex text-dark fw-bolder my-1 fs-3">{{ $prayer->title }}</h1>
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
                <li class="breadcrumb-item text-gray-600">{{ $prayer->title }}</li>
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
                <h3 class="card-title">Dua Güncelle</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('prayers.update', $prayer->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method("PUT")
                    <div class="form-group mb-5">
                        <label for="video_image" class="form-label">Video Resmi</label>
                        <span class="text-danger d-block">{{ $errors->first('video_image') }}</span>
                        <div>
                            <img src="{{ $prayer->video_image }}" id="image_preview" width="250" alt=""
                                class="mb-5">
                        </div>
                        <input type="file" name="video_image" id="video_image" class="form-control form-control-solid"
                            value="{{ $prayer->video_image }}">
                    </div>
                    <div class="form-group mb-5">
                        <label for="embed_code" class="form-label">Video Embed Kodu</label>
                        <span class="text-danger d-block">{{ $errors->first('embed_code') }}</span>
                        <input type="text" name="embed_code" id="embed_code" value="{{ $prayer->embed_code }}"
                            class="form-control form-control-solid" placeholder="Embed Kodu">
                    </div>
                    <div class="form-group mb-5">
                        <label for="title" class="form-label">Dua Adı</label>
                        <input type="text" name="title" id="title" value="{{ $prayer->title }}"
                            class="form-control form-control-solid" placeholder="Dua Adı">
                    </div>
                    <div class="form-group mb-5">
                        <label for="content" class="form-label">Dua İçerik</label>
                        <textarea name="content" id="content"
                            class="form-control form-control-solid">{{ $prayer->content }}</textarea>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success">Güncelle</button>
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
