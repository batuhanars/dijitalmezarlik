@extends('back.layout.main')
@section('title', Auth::user()->full_name)
@section('content')
    <!--begin::Toolbar-->
    <div class="toolbar mb-5 mb-lg-7" id="kt_toolbar">
        <!--begin::Page title-->
        <div class="page-title d-flex flex-column me-3">
            <!--begin::Title-->
            <h1 class="d-flex text-dark fw-bolder my-1 fs-3">{{ Auth::user()->full_name }}
            </h1>
            <!--end::Title-->
            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-dot fw-bold text-gray-600 fs-7 my-1">
                <!--begin::Item-->
                <li class="breadcrumb-item text-gray-600">
                    <a href="{{ route('panel') }}" class="text-gray-600 text-hover-primary">Anasayfa</a>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item text-gray-600">Profil Yönetimi</li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item text-gray-600">{{ Auth::user()->full_name }}
                </li>
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
                <h3 class="card-title">Profili Güncelle</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('profile.update', Auth::user()->id) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method("PUT")
                    <div class="form-group mb-5">
                        <label for="image" class="form-label">Profil Resmi</label>
                        <span class="text-danger d-block">{{ $errors->first('image') }}</span>
                        <div>
                            <img src="{{ Auth::user()->image }}" id="image_preview" width="250" alt=""
                                class="mb-5">
                        </div>
                        <input type="file" name="image" id="image" class="form-control form-control-solid">
                    </div>
                    <div class="form-group mb-5">
                        <label for="full_name" class="form-label">Ad Soyad</label>
                        <span class="text-danger d-block">{{ $errors->first('full_name') }}</span>
                        <input type="text" name="full_name" id="full_name" class="form-control form-control-solid"
                            placeholder="İsim giriniz" value="{{ Auth::user()->full_name }}" autocomplete="off">
                    </div>
                    <div class="form-group mb-5">
                        <label for="email" class="form-label">Email</label>
                        <span class="text-danger d-block">{{ $errors->first('email') }}</span>
                        <input type="email" name="email" id="email" class="form-control form-control-solid"
                            placeholder="Email Giriniz" value="{{ Auth::user()->email }}" autocomplete="off">
                    </div>
                    <div class="form-group mb-5">
                        <label for="phone" class="form-label">Telefon</label>
                        <span class="text-danger d-block">{{ $errors->first('phone') }}</span>
                        <input type="text" name="phone" id="phone" class="form-control form-control-solid"
                            value="{{ Auth::user()->phone }}" autocomplete="off">
                    </div>
                    <div class="form-group mb-5">
                        <label for="address" class="form-label">Adres</label>
                        <span class="text-danger d-block">{{ $errors->first('address') }}</span>
                        <input type="text" name="address" id="address" class="form-control form-control-solid"
                            placeholder="Adres Giriniz" value="{{ Auth::user()->address }}" autocomplete="off">
                    </div>
                    <div class="form-group mb-5">
                        <label for="password" class="form-label">Parola</label>
                        <input type="password" name="password" id="password" class="form-control form-control-solid"
                            placeholder="******">
                    </div>
                    <div class="form-group mb-5">
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
        Inputmask({
            "mask": "(999) 999-9999"
        }).mask("#phone");
        $("#image").change(function() {
            let file = URL.createObjectURL(this.files[0]);
            $("#image_preview").attr("src", file)
        });
        $(document).ready(function() {
            $("#district_id").prop("disabled", true);
            $("#province_id").change(function() {
                var provinceId = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "{{ route('districts') }}",
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
    </script>
@endsection
