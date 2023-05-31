@extends('back.layout.main')
@section('title', 'Sosyal Medya Yönetimi')
@section('content')
    <!--begin::Toolbar-->
    <div class="toolbar mb-5 mb-lg-7" id="kt_toolbar">
        <!--begin::Page title-->
        <div class="page-title d-flex flex-column me-3">
            <!--begin::Title-->
            <h1 class="d-flex text-dark fw-bolder my-1 fs-3">Sosyal Medya Yönetimi</h1>
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
                <li class="breadcrumb-item text-gray-600">Sosyal Medya Yönetimi</li>
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
                <h3 class="card-title">Sosyal Medya Linkleri</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('social-media.save') }}" method="post">
                    @csrf
                    <div class="form-group mb-5">
                        <label for="facebook" class="form-label">Facebook Url</label>
                        <div class="input-group">
                            <div class="input-group-append">
                                <div class="btn" style="background-color: rgb(59, 89, 152);">
                                    <i class="fab fa-facebook-f text-white fs-3"></i>
                                </div>
                            </div>
                            <input type="text" name="facebook" id="facebook" class="form-control form-control-solid"
                                value="{{ $socialMedia ? $socialMedia->facebook : '' }}">
                        </div>
                    </div>
                    <div class="form-group mb-5">
                        <label for="instagram" class="form-label">Instagram Url</label>
                        <div class="input-group">
                            <div class="input-group-append">
                                <div class="btn" style="background-color: rgb(131, 58, 180);">
                                    <i class="fab fa-instagram text-white fs-3"></i>
                                </div>
                            </div>
                            <input type="text" name="instagram" id="instagram" class="form-control form-control-solid"
                                value="{{ $socialMedia ? $socialMedia->instagram : '' }}">
                        </div>
                    </div>
                    <div class="form-group mb-5">
                        <label for="twitter" class="form-label">Twitter Url</label>
                        <div class="input-group">
                            <div class="input-group-append">
                                <div class="btn" style="background-color: rgb(29, 161, 242);">
                                    <i class="fab fa-twitter text-white fs-3"></i>
                                </div>
                            </div>
                            <input type="text" name="twitter" id="twitter" class="form-control form-control-solid"
                                value="{{ $socialMedia ? $socialMedia->twitter : '' }}">
                        </div>
                    </div>
                    <div class="form-group mb-5">
                        <label for="youtube" class="form-label">Youtube Url</label>
                        <div class="input-group">
                            <div class="input-group-append">
                                <div class="btn" style="background: red">
                                    <i class="fab fa-youtube text-white fs-3"></i>
                                </div>
                            </div>
                            <input type="text" name="youtube" id="youtube" class="form-control form-control-solid"
                                value="{{ $socialMedia ? $socialMedia->youtube : '' }}">
                        </div>
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
