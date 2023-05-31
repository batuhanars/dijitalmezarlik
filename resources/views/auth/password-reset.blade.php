<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
    <title>{{ $setting ? $setting->title : '' }} - Yeni Parola</title>
    <meta charset="utf-8" />
    <meta name="description" content="{{ $setting ? $setting->description : '' }}" />
    <meta name="keywords" content="{{ $setting ? $setting->keywords : '' }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="" />
    <meta property="og:url" content="" />
    <meta property="og:site_name" content="" />
    <link rel="canonical" href="" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ $setting ? $setting->favicon : '' }}">
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
    <div class="d-flex flex-column flex-root">
        <!--begin::Authentication - Sign-in -->
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
                    <form class="form w-100"
                        action="{{ route('reset-password.post', ['token' => $token, 'email' => $email]) }}"
                        method="post">
                        @csrf
                        @method("PUT")
                        <!--begin::Heading-->
                        <div class="text-center mb-10">
                            <!--begin::Title-->
                            <h1 class="text-dark mb-3">Parola Yenile</h1>
                            <div class="text-gray-400 fw-bold fs-4">Parolanızı zaten sıfırladınız mı?
                                <a href="{{ route('login') }}" class="link-primary fw-bolder">Giriş Yapın</a>
                            </div>
                            <!--end::Title-->
                            @if (session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif
                        </div>
                        <!--begin::Heading-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <!--begin::Wrapper-->
                            <div class="d-flex flex-stack mb-2">
                                <!--begin::Label-->
                                <label class="form-label fw-bolder text-dark fs-6 mb-0">Yeni Parola Ayarla</label>
                                <!--end::Label-->
                            </div>
                            <!--end::Wrapper-->
                            <span class="text-danger d-block">{{ $errors->first('password') }}</span>
                            <!--begin::Input-->
                            <input class="form-control form-control-lg form-control-solid" type="password"
                                name="password" placeholder="Yeni Parola Giriniz" autocomplete="off" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Actions-->
                        <div class="text-center">
                            <!--begin::Submit button-->
                            <button type="submit" class="btn w-100 mb-5" style="background: #1E1E2D"
                                onmouseover="this.style.backgroundColor = '#1BC3BB'"
                                onmouseout="this.style.backgroundColor = '#1E1E2D'">
                                <span class="indicator-label text-white">Parola Yenile</span>
                            </button>
                            <!--end::Submit button-->
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
        <!--end::Authentication - Sign-in-->
    </div>
    <!--end::Main-->
    <!--begin::Javascript-->
    <!--begin::Global Javascript Bundle(used by all pages)-->
    <script src="{{ asset('back/assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('back/assets/js/scripts.bundle.js') }}"></script>
    <!--end::Global Javascript Bundle-->
    <!--begin::Page Custom Javascript(used by this page)-->
    <script src="{{ asset('back/assets/js/custom/authentication/sign-in/general.js') }}"></script>
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
