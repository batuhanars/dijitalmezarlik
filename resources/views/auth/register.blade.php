<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
    <title>{{ $setting ? $setting->title : '' }} - Giriş Yap</title>
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
                    <img alt="Logo" src="{{ asset('front/assets/img/mezarlik-arama-sistemi1641301506.png') }}"
                        class="w-300px" />
                </a>
                <!--end::Logo-->
                <!--begin::Wrapper-->
                <div class="w-lg-800px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
                    <!--begin::Form-->
                    <form class="form w-100" action="{{ route('registerPost') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <!--begin::Heading-->
                        <div class="text-center mb-10">
                            <!--begin::Title-->
                            <h1 class="text-dark mb-3">Üye Ol</h1>
                            <!--end::Title-->
                            @if (session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif
                        </div>
                        <!--begin::Heading-->
                        <div class="form-group mb-5">
                            <label for="image" class="form-label">Kullanıcı Resmi</label>
                            <input type="file" name="image" id="image" class="form-control form-control-solid">
                        </div>
                        <div class="row">
                            <div class="form-group mb-5 col-md-4">
                                <label for="province_id" class="form-label">İl</label>
                                <span class="text-danger d-block">{{ $errors->first('provinces') }}</span>
                                <select name="provinces[]" id="province_id" class="form-select form-select-solid"
                                    data-control="select2" data-placeholder="İl Seçiniz" multiple>
                                    <option value=""></option>
                                    @foreach ($provinces as $province)
                                        <option value="{{ $province->id }}">{{ $province->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-5 col-md-4">
                                <label for="district_id" class="form-label">İlçe</label>
                                <span class="text-danger d-block">{{ $errors->first('districts') }}</span>
                                <select name="districts[]" id="district_id" class="form-select form-select-solid"
                                    data-control="select2" data-placeholder="İlçe Seçiniz" multiple>
                                    <option value=""></option>
                                </select>
                            </div>
                            <div class="form-group mb-5 col-md-4">
                                <label for="organisation_id" class="form-label">Kurum</label>
                                <span class="text-danger d-block">{{ $errors->first('organisations') }}</span>
                                <select name="organisations[]" id="organisation_id"
                                    class="form-select form-select-solid" data-control="select2" multiple>
                                    <option value="0" selected>Tüm Kurumlar</option>
                                    @foreach ($organisations as $organisation)
                                        <option value="{{ $organisation->id }}">{{ $organisation->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group mb-5 col-md-6">
                                <label for="first_name" class="form-label">İsim</label>
                                <span class="text-danger d-block">{{ $errors->first('first_name') }}</span>
                                <input type="text" name="first_name" id="first_name"
                                    class="form-control form-control-solid" placeholder="İsim giriniz"
                                    autocomplete="off">
                            </div>
                            <div class="form-group mb-5 col-md-6">
                                <label for="last_name" class="form-label">Soyisim</label>
                                <span class="text-danger d-block">{{ $errors->first('last_name') }}</span>
                                <input type="text" name="last_name" id="last_name"
                                    class="form-control form-control-solid" placeholder="Soyisim giriniz"
                                    autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group mb-5">
                            <label for="email" class="form-label">Email</label>
                            <span class="text-danger d-block">{{ $errors->first('email') }}</span>
                            <input type="text" name="email" id="email" class="form-control form-control-solid"
                                placeholder="Email Giriniz" autocomplete="off">
                        </div>
                        <div class="form-group mb-5">
                            <label for="phone" class="form-label">Telefon</label>
                            <span class="text-danger d-block">{{ $errors->first('phone') }}</span>
                            <input type="text" name="phone" id="phone" class="form-control form-control-solid"
                                placeholder="Telefon Giriniz" autocomplete="off">
                        </div>
                        <div class="form-group mb-5">
                            <label for="address" class="form-label">Adres</label>
                            <span class="text-danger d-block">{{ $errors->first('address') }}</span>
                            <input type="text" name="address" id="address" class="form-control form-control-solid"
                                placeholder="Adres Giriniz" autocomplete="off">
                        </div>
                        <div class="form-group mb-5">
                            <label for="password" class="form-label">Parola</label>
                            <span class="text-danger d-block">{{ $errors->first('password') }}</span>
                            <input type="password" name="password" id="password" class="form-control form-control-solid"
                                placeholder="Parola Giriniz">
                        </div>
                        <!--begin::Actions-->
                        <div class="text-center">
                            <!--begin::Submit button-->
                            <button type="submit" class="btn w-100 mb-5" style="background: #1E1E2D"
                                onmouseover="this.style.backgroundColor = '#1BC3BB'"
                                onmouseout="this.style.backgroundColor = '#1E1E2D'">
                                <span class="indicator-label text-white">Üye Ol</span>
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
    <script>
        Inputmask({
            "mask": "(999) 999-9999"
        }).mask("#phone");
        $(document).ready(function() {
            $("#district_id").prop("disabled", true);
            $("#province_id").change(function() {
                var provinceId = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "{{ route('districts.user-page') }}",
                    data: {
                        "province_id": provinceId,
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function(value) {
                        $("#district_id").prop("disabled", false)
                        $("#district_id").html(value)
                    }
                })
            });
        });
        $(document).ready(function() {
            $("#province").change(function() {
                var provinceId = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "{{ route('districts') }}",
                    data: {
                        "province_id": provinceId,
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function(value) {
                        $("#district").html(value)
                    }
                })
            });
        });
    </script>
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
