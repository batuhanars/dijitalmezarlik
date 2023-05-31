@extends('back.layout.main')
@section('title', 'Kullanıcı Ekle')
@section('content')
    <!--begin::Toolbar-->
    <div class="toolbar mb-5 mb-lg-7" id="kt_toolbar">
        <!--begin::Page title-->
        <div class="page-title d-flex flex-column me-3">
            <!--begin::Title-->
            <h1 class="d-flex text-dark fw-bolder my-1 fs-3">Kullanıcı Ekle</h1>
            <!--end::Title-->
            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-dot fw-bold text-gray-600 fs-7 my-1">
                <!--begin::Item-->
                <li class="breadcrumb-item text-gray-600">
                    <a href="{{ route('panel') }}" class="text-gray-600 text-hover-primary">Anasayfa</a>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item text-gray-600">Kullanıcı Yönetimi</li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item text-gray-600">Kullanıcı Ekle</li>
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
                <h3 class="card-title">Kullanıcı Ekle</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('users.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-5">
                        <label for="image" class="form-label">Kullanıcı Resmi</label>
                        <span class="text-danger d-block">{{ $errors->first('image') }}</span>
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
                            <select name="organisations[]" id="organisation_id" class="form-select form-select-solid"
                                data-control="select2" multiple>
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
                            <input type="text" name="first_name" id="first_name" class="form-control form-control-solid"
                                placeholder="İsim giriniz" autocomplete="off" value="{{ old('first_name') }}">
                        </div>
                        <div class="form-group mb-5 col-md-6">
                            <label for="last_name" class="form-label">Soyisim</label>
                            <span class="text-danger d-block">{{ $errors->first('last_name') }}</span>
                            <input type="text" name="last_name" id="last_name" class="form-control form-control-solid"
                                placeholder="Soyisim giriniz" autocomplete="off" value="{{ old('last_name') }}">
                        </div>
                    </div>
                    <div class="form-group mb-5">
                        <label for="email" class="form-label">Email</label>
                        <span class="text-danger d-block">{{ $errors->first('email') }}</span>
                        <input type="text" name="email" id="email" class="form-control form-control-solid"
                            placeholder="Email Giriniz" autocomplete="off" value="{{ old('email') }}">
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
                            placeholder="Adres Giriniz" autocomplete="off" value="{{ old('address') }}">
                    </div>
                    <div class="form-group mb-5">
                        <label for="password" class="form-label">Parola</label>
                        <span class="text-danger d-block">{{ $errors->first('password') }}</span>
                        <input type="password" name="password" id="password" class="form-control form-control-solid"
                            placeholder="Parola Giriniz">
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
    </script>
@endsection
