<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->

<head>
    <title>{{ $setting ? $setting->title : '' }} - Şifremi Unuttum</title>
    <meta charset="utf-8" />
    <meta name="description" content="{{ $setting ? $setting->description : '' }}" />
    <meta name="keywords" content="{{ $setting ? $setting->keywords : '' }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" href="{{ $setting ? $setting->favicon : '' }}" />
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    <link href="{{ asset('back/assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('back/assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body" class="bg-body">
    <!--begin::Main-->
    <!--begin::Root-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Authentication - Password reset -->
        <div
            class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed">
            <!--begin::Content-->
            <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
                <!--begin::Logo-->
                <a href="{{ route('panel') }}" class="mb-12">
                    <img alt="Logo" src="{{ asset('back/assets/media/616810a97da45.png') }}" class="w-300px" />
                </a>
                <!--end::Logo-->
                <!--begin::Wrapper-->
                <div class="w-lg-500px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
                    <!--begin::Form-->
                    <form class="form w-100" action="{{ route('send-email') }}" method="post"
                        novalidate="novalidate" id="kt_password_reset_form">
                        @csrf
                        <!--begin::Heading-->
                        <div class="text-center mb-10">
                            <!--begin::Title-->
                            <h1 class="text-dark mb-3">Parolanızı mı Unuttunuz ?</h1>
                            <!--end::Title-->
                            <!--begin::Link-->
                            <div class="text-gray-400 fw-bold fs-4">Şifrenizi sıfırlamak için e-postanızı girin.</div>
                            <!--end::Link-->
                            @if (session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif
                        </div>
                        <!--begin::Heading-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <label class="form-label fw-bolder text-gray-900 fs-6">Email</label>
                            <span class="text-danger d-block">{{ $errors->first('email') }}</span>
                            <input class="form-control form-control-solid" type="email"
                                placeholder="Email Adresi Giriniz" name="email" autocomplete="off" />
                        </div>
                        <!--end::Input group-->
                        <!--begin::Actions-->
                        <div class="d-flex flex-wrap justify-content-center pb-lg-0">
                            <button type="submit" class="btn btn-lg btn-primary fw-bolder me-4"
                                style="background: #1E1E2D" onmouseover="this.style.backgroundColor = '#1BC3BB'"
                                onmouseout="this.style.backgroundColor = '#1E1E2D'">
                                <span class="indicator-label">Gönder</span>
                            </button>
                            <a href="{{ route('login') }}" class="btn btn-lg btn-light-danger fw-bolder">İptal Et</a>
                        </div>
                        <!--end::Actions-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Content-->
            <!--begin::Footer-->
            <div class="d-flex flex-center flex-column-auto p-10">
                <!--begin::Links-->
                <div class="d-flex align-items-center fw-bold fs-6">
                    Copyright ©️ 2021 - reklamlarim.com - Dijital Reklam Ajansı
                </div>
                <!--end::Links-->
            </div>
            <!--end::Footer-->
        </div>
        <!--end::Authentication - Password reset-->
    </div>
    <!--end::Root-->
    <!--end::Main-->
    <!--begin::Javascript-->
    <!--begin::Global Javascript Bundle(used by all pages)-->
    <script src="{{ asset('back/assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('back/assets/js/scripts.bundle.js') }}"></script>
    <!--end::Global Javascript Bundle-->
    <!--begin::Page Custom Javascript(used by this page)-->
    <script src="{{ asset('back/assets/js/custom/authentication/password-reset/password-reset.j') }}s"></script>
    <!--end::Page Custom Javascript-->
    <!--end::Javascript-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('success'))
        <script>
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 1500
            })
        </script>
    @endif
</body>
<!--end::Body-->

</html>
