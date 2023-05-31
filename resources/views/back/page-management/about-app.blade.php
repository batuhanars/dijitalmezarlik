@extends('back.layout.main')
@section('title', 'Uygulama Hakkında')
@section('content')
    <!--begin::Toolbar-->
    <div class="toolbar mb-5 mb-lg-7" id="kt_toolbar">
        <!--begin::Page title-->
        <div class="page-title d-flex flex-column me-3">
            <!--begin::Title-->
            <h1 class="d-flex text-dark fw-bolder my-1 fs-3">Uygulama Hakkında</h1>
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
                <li class="breadcrumb-item text-gray-600">Uygulama Hakkında</li>
                <!--end::Item-->
            </ul>
            <!--end::Breadcrumb-->
        </div>
        <!--end::Page title-->
    </div>
    <!--end::Toolbar-->
    <!--begin::Post-->
    <form action="{{ route('about-app.save') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="content flex-column-fluid" id="kt_content">
            <div class="card card-xl-stretch mb-xl-8">
                <div class="card-header">
                    <h3 class="card-title">Arkaplan Görselleri</h3>
                </div>
                <div class="card-body">
                    <div class="form-group mb-5">
                        <input type="file" name="images[]" id="images" class="form-control form-control-solid" multiple>
                        <div class="text-center mt-10" id="images_preview">
                            @if ($aboutApp)
                                @foreach (json_decode($aboutApp->images) as $image)
                                    <img src="{{ asset('/upload/aboutapp/' . $image) }}" width="250" id="images-child"
                                        class="mb-5">
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="card card-xl-stretch mb-xl-8">
                <div class="card-header">
                    <h3 class="card-title">Video Görseli</h3>
                </div>
                <div class="card-body">
                    <div class="form-group mb-5">
                        <input type="file" name="video_image" id="video_image" class="form-control form-control-solid">
                        <div class="text-center mt-5">
                            <img src="{{ $aboutApp ? $aboutApp->video_image : '' }}" id="video_image_preview" width="250"
                                alt="" class="mb-5">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Uygulama Hakkında İçerik</h3>
                </div>
                <div class="card-body">
                    <div class="form-group mb-5">
                        <label for="video" class="form-label">Video Url</label>
                        <input type="text" name="video" id="video" class="form-control form-control-solid"
                            value="{{ $aboutApp ? $aboutApp->video : '' }}" placeholder="Video Url" autocomplete="off">
                    </div>

                    <div class="form-group mb-5">
                        <label for="title" class="form-label">Başlık</label>
                        <input type="text" name="title" id="title" class="form-control form-control-solid"
                            value="{{ $aboutApp ? $aboutApp->title : '' }}" placeholder="Başlık" autocomplete="off">
                    </div>
                    <div class="form-group mb-5">
                        <label for="content" class="form-label">Açıklama</label>
                        <textarea name="content" id="content" class="form-control form-control-solid"
                            placeholder="Açıklama">{!! $aboutApp ? $aboutApp->content : '' !!}</textarea>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success">Kaydet</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!--end::Post-->
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $('#content').summernote();
        });
        $("#video_image").change(function() {
            let file = URL.createObjectURL(this.files[0]);
            $("#video_image_preview").attr("src", file)
        });
    </script>
@endsection
