@extends('back.layout.main')
@section('title', 'Ayarlar')
@section('content')
    <!--begin::Toolbar-->
    <div class="toolbar mb-5 mb-lg-7" id="kt_toolbar">
        <!--begin::Page title-->
        <div class="page-title d-flex flex-column me-3">
            <!--begin::Title-->
            <h1 class="d-flex text-dark fw-bolder my-1 fs-3">Genel Ayarlar</h1>
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
                <li class="breadcrumb-item text-gray-600">Genel Ayarlar</li>
                <!--end::Item-->
            </ul>
            <!--end::Breadcrumb-->
        </div>
        <!--end::Page title-->
    </div>
    <!--end::Toolbar-->
    <!--begin::Post-->
    <form action="{{ route('save.settings') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="content flex-column-fluid" id="kt_content">
            <div class="row">
                <div class="col-md-4">
                    <div class="card card-xl-stretch mb-xl-8">
                        <div class="card-header">
                            <h3 class="card-title">Siyah Logo</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="custom-file">
                                    <span class="text-danger d-block">{{ $errors->first('dark_logo') }}</span>
                                    <input type="file" id="dark_logo" name="dark_logo"
                                        class="form-control form-control-solid"
                                        value="{{ $setting ? $setting->dark_logo : '' }}">
                                </div>
                                <div class="text-center mt-10">
                                    <img src="{{ $setting ? $setting->dark_logo : '' }}" id="dark_logo_preview"
                                        width="250" alt="" class="mb-5">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-xl-stretch mb-xl-8 bg-dark">
                        <div class="card-header">
                            <h3 class="card-title text-white">Beyaz Logo</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="custom-file">
                                    <span class="text-danger d-block">{{ $errors->first('white_logo') }}</span>
                                    <input type="file" id="white_logo" name="white_logo"
                                        class="form-control form-control-solid"
                                        value="{{ $setting ? $setting->white_logo : '' }}">
                                </div>
                                <div class="text-center mt-10">
                                    <img src="{{ $setting ? $setting->white_logo : '' }}" id="white_logo_preview"
                                        width="250" alt="" class="mb-5">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-xl-stretch mb-xl-8">
                        <div class="card-header">
                            <h3 class="card-title">Favicon</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="custom-file">
                                    <span class="text-danger d-block">{{ $errors->first('favicon') }}</span>
                                    <input type="file" id="favicon" name="favicon" class="form-control form-control-solid"
                                        value="{{ $setting ? $setting->favicon : '' }}">
                                </div>
                                <div class="text-center mt-10">
                                    <img src="{{ $setting ? $setting->favicon : '' }}" id="favicon_preview" width="35"
                                        alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card card-xl-stretch mb-xl-8">
                <div class="card-header">
                    <h3 class="card-title">Sayfalar Arka Plan Resmi</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <span class="text-danger d-block">{{ $errors->first('pages_image') }}</span>
                        <input type="file" id="pages_image" name="pages_image" class="form-control form-control-solid"
                            value="{{ $setting ? $setting->pages_image : '' }}">
                        <div class="mt-5" id="pages_image_preview"
                            style="background: url({{ $setting ? $setting->pages_image : '' }}); background-repeat: no-repeat; background-position: center; width: 100%; height: {{ $setting ? '350px' : '' }};">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="form-group mb-5">
                        <label for="title" class="form-label">Site Başlık</label>
                        <input type="text" name="title" id="title" class="form-control form-control-solid"
                            value="{{ $setting ? $setting->title : '' }}" placeholder="Site Başlık" autocomplete="off">
                    </div>
                    <div class="form-group mb-5">
                        <label for="keywords" class="form-label">Site Anahtar Kelimeler</label>
                        <input type="text" name="keywords" id="keywords" class="form-control form-control-solid"
                            value="{{ $setting ? $setting->keywords : '' }}" placeholder="Site anahtar kelimeler"
                            autocomplete="off">
                    </div>
                    <div class="form-group mb-5">
                        <label for="description" class="form-label">Site Açıklama Metni</label>
                        <textarea name="description" id="description" class="form-control form-control-solid" rows="4"
                            placeholder="Site Açıklama"
                            data-kt-autosize="true">{{ $setting ? $setting->description : '' }}</textarea>
                    </div>
                    <div class="form-group mb-5">
                        <button type="submit" class="btn btn-success">Kaydet</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!--end::Post-->
@endsection
@section('js')
    <script>
        $("#dark_logo").change(function() {
            let file = URL.createObjectURL(this.files[0]);
            $("#dark_logo_preview").attr("src", file)
        });
        $("#white_logo").change(function() {
            let file = URL.createObjectURL(this.files[0]);
            $("#white_logo_preview").attr("src", file)
        });
        $("#favicon").change(function() {
            let file = URL.createObjectURL(this.files[0]);
            $("#favicon_preview").attr("src", file)
        });
        $("#pages_image").change(function() {
            let file = URL.createObjectURL(this.files[0]);
            $("#pages_image_preview").css('background', 'url(' + file + ')')
            $("#pages_image_preview").css('background-position', 'center')
            $("#pages_image_preview").css('width', '100%')
            $("#pages_image_preview").css('height', '350px')
            $("#pages_image_preview").css('background-repeat', 'no-repeat')
        });
    </script>
@endsection
