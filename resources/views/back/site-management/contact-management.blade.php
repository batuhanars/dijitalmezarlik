@extends('back.layout.main')
@section('title', 'İletişim Yönetimi')
@section('content')
    <!--begin::Toolbar-->
    <div class="toolbar mb-5 mb-lg-7" id="kt_toolbar">
        <!--begin::Page title-->
        <div class="page-title d-flex flex-column me-3">
            <!--begin::Title-->
            <h1 class="d-flex text-dark fw-bolder my-1 fs-3">İletişim Yönetimi</h1>
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
                <li class="breadcrumb-item text-gray-600">İletişim Yönetimi</li>
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
                <h3 class="card-title">İletişim Yönetimi</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('contact-management.save') }}" method="post">
                    @csrf
                    <div class="form-group mb-5">
                        <label for="title" class="form-label">Ünvan</label>
                        <span class="text-danger d-block">{{ $errors->first('title') }}</span>
                        <input type="text" name="title" id="title" class="form-control form-control-solid"
                            value="{{ $contactManagement ? $contactManagement->title : '' }}" placeholder="Ünvan"
                            autocomplete="off">
                    </div>
                    <div class="form-group mb-5">
                        <label for="phone" class="form-label">Telefon</label>
                        <span class="text-danger d-block">{{ $errors->first('phone') }}</span>
                        <input type="tel" name="phone" id="phone" class="form-control form-control-solid"
                            value="{{ $contactManagement ? $contactManagement->phone : '' }}" placeholder="Telefon"
                            autocomplete="off">
                    </div>
                    <div class="form-group mb-5">
                        <label for="email" class="form-label">E-posta</label>
                        <span class="text-danger d-block">{{ $errors->first('email') }}</span>
                        <input type="email" name="email" id="email" class="form-control form-control-solid"
                            value="{{ $contactManagement ? $contactManagement->email : '' }}" placeholder="Email"
                            autocomplete="off">
                    </div>
                    <div class="form-group mb-5">
                        <label for="address" class="form-label">Adres</label>
                        <span class="text-danger d-block">{{ $errors->first('address') }}</span>
                        <input type="text" name="address" id="address" class="form-control form-control-solid"
                            value="{{ $contactManagement ? $contactManagement->address : '' }}" placeholder="Adres"
                            autocomplete="off">
                    </div>
                    <div class="form-group mb-5">
                        <label for="address_map" class="form-label">Adres Harita Url</label>
                        <span class="text-danger d-block">{{ $errors->first('address') }}</span>
                        <input type="text" name="address_map" id="address_map" class="form-control form-control-solid"
                            value="{{ $contactManagement ? $contactManagement->address_map : '' }}"
                            placeholder="Adres Harita Url" autocomplete="off">
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
        Inputmask({
            "mask": "(999) 999-9999"
        }).mask("#phone");
    </script>
@endsection
