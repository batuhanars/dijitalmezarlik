@extends('back.layout.main')
@section('title', $funeral->first_name . ' ' . $funeral->last_name)
@section('content')
    <!--begin::Toolbar-->
    <div class="toolbar mb-5 mb-lg-7" id="kt_toolbar">
        <!--begin::Page title-->
        <div class="page-title d-flex flex-column me-3">
            <!--begin::Title-->
            <h1 class="d-flex text-dark fw-bolder my-1 fs-3">{{ $funeral->first_name . ' ' . $funeral->last_name }}</h1>
            <!--end::Title-->
            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-dot fw-bold text-gray-600 fs-7 my-1">
                <!--begin::Item-->
                <li class="breadcrumb-item text-gray-600">
                    <a href="{{ route('panel') }}" class="text-gray-600 text-hover-primary">Anasayfa</a>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item text-gray-600">Cenaze İlanı Yönetimi</li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item text-gray-600">{{ $funeral->first_name . ' ' . $funeral->last_name }}</li>
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
                <h3 class="card-title">Cenaze İlanı Güncelle</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('funeral-notice.update', $funeral->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group mb-5">
                        <label for="owner" class="form-label">İlan Sahibi</label>
                        <input type="text" name="owner" class="form-control form-control-solid"
                            value="{{ $funeral->owner }}">
                    </div>
                    <div class="form-group mb-5">
                        <label for="funeral_country_id" class="form-label">Ülkeler</label>
                        <select name="country_id" id="funeral_country_id" class="form-select form-select-solid"
                            data-control="select2" style="width: 100%">
                            @foreach ($countries as $country)
                                <option @if ($country->id == $funeral->country_id) selected @endif value="{{ $country->id }}">
                                    {{ $country->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    @if ($funeral->province)
                        <div class="row" id="funeralSelectValue">
                            <div class="form-group col-md-4 mb-5">
                                <label for="province_id" class="form-label">İl</label>
                                <span class="text-danger d-block">{{ $errors->first('province_id') }}</span>
                                <select name="province_id" id="province_id" class="form-select form-select-solid"
                                    data-control="select2" data-placeholder="İl Seçiniz">
                                    <option value=""></option>
                                    @foreach ($provinces as $province)
                                        <option @if ($funeral->province->id === $province->id) selected @endif
                                            value="{{ $province->id }}">
                                            {{ $province->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4 mb-5">
                                <label for="district_id" class="form-label">İlçe</label>
                                <span class="text-danger d-block">{{ $errors->first('district_id') }}</span>
                                <select name="district_id" id="district_id" class="form-select form-select-solid"
                                    data-control="select2" data-placeholder="İlçe Seçiniz">
                                    <option value=""></option>
                                    <option selected value="{{ $funeral->district->id ?? '' }}">
                                        {{ $funeral->district->name ?? '' }}</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4 mb-5">
                                <label for="neighborhood_id" class="form-label">Mahalle</label>
                                <span class="text-danger d-block">{{ $errors->first('neighborhood_id') }}</span>
                                <select name="neighborhood_id" id="neighborhood_id" class="form-select form-select-solid"
                                    data-control="select2" data-placeholder="Mahalle Seçiniz">
                                    <option value=""></option>
                                    <option selected value="{{ $funeral->neighborhood->id ?? '' }}">
                                        {{ $funeral->neighborhood->name ?? '' }}
                                    </option>
                                </select>
                            </div>
                        </div>
                    @endif
                    <div class="row mb-5" id="noneFuneralSelectValue">
                        <div class="form-group col-md-4">
                            <label for="province_name" class="form-label">İl</label>
                            <input type="text" id="province_name" name="province_name"
                                class="form-control form-control-solid" placeholder="İl"
                                value="{{ $funeral->province_name }}">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="district_name" class="form-label">İlçe</label>
                            <input type="text" id="district_name" name="district_name"
                                class="form-control form-control-solid" placeholder="İlçe"
                                value="{{ $funeral->district_name }}">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="neighborhood_name" class="form-label">Mahalle</label>
                            <input type="text" id="neighborhood_name" name="neighborhood_name"
                                class="form-control form-control-solid" placeholder="İl"
                                value="{{ $funeral->neighborhood_name }}">
                        </div>
                    </div>
                    <div class="form-group mb-5">
                        <label for="cemetery" class="form-label">Mezarlık</label>
                        <span class="text-danger d-block">{{ $errors->first('cemetery') }}</span>
                        <input type="text" name="cemetery" id="cemetery" class="form-control form-control-solid"
                            value="{{ $funeral->cemetery }}" placeholder="Mezarlık">
                    </div>
                    <div class="row">
                        <div class="form-group mb-5 col-md-6">
                            <label for="first_name" class="form-label">Mevta Adı</label>
                            <span class="text-danger d-block">{{ $errors->first('first_name') }}</span>
                            <input type="text" name="first_name" id="first_name"
                                class="form-control form-control-solid" value="{{ $funeral->first_name }}"
                                placeholder="Ad">
                        </div>
                        <div class="form-group mb-5 col-md-6">
                            <label for="last_name" class="form-label">Mevta Soyadı</label>
                            <span class="text-danger d-block">{{ $errors->first('last_name') }}</span>
                            <input type="text" name="last_name" id="last_name"
                                class="form-control form-control-solid" value="{{ $funeral->last_name }}"
                                placeholder="Soyad">
                        </div>
                    </div>
                    <div class="form-group mb-5">
                        <label for="gender" class="form-label">Cinsiyet</label>
                        <select name="gender" id="funeral_gender" class="form-select form-select-solid"
                            style="width: 100%">
                            <option @if ($funeral->gender == 'Erkek') selected @endif value="Erkek">Erkek</option>
                            <option @if ($funeral->gender == 'Kadın') selected @endif value="Kadın">Kadın</option>
                        </select>
                    </div>
                    <div class="form-group mb-5" id="funeralMaidenNameContainer">
                        <label for="maiden_name" class="form-label">Kızlık Soyadı</label>
                        <input type="text" name="maiden_name" id="funeral_maiden_name"
                            class="form-control form-control-solid" placeholder="Kızlık Soyadı" autocomplete="off"
                            value="{{ $funeral->maiden_name }}">
                    </div>
                    <div class="form-group mb-5">
                        <label for="father_name" class="form-label">Baba Adı</label>
                        <input type="text" name="father_name" id="father_name"
                            class="form-control form-control-solid" value="{{ $funeral->father_name }}"
                            placeholder="Baba Adı">
                    </div>
                    <div class="form-group mb-5">
                        <label for="mosque" class="form-label">Cenazenin Kaldırılacağı Camii</label>
                        <span class="text-danger d-block">{{ $errors->first('mosque') }}</span>
                        <input type="text" name="mosque" id="mosque" class="form-control form-control-solid"
                            value="{{ $funeral->mosque }}" placeholder="Cenazenin Kaldırılacağı Camii">
                    </div>
                    <div class="form-group mb-5">
                        <label for="funeral_time" class="form-label">Cenaze Vakti</label>
                        <span class="text-danger d-block">{{ $errors->first('funeral_time') }}</span>
                        <select name="funeral_time" id="" class="form-select form-select-solid">
                            <option value="" selected disabled>Cenaze Vakti Seçiniz</option>
                            <option @if ($funeral->funeral_time === 'Öğle namazına müteakip') selected @endif value="Öğle namazına müteakip">Öğle
                                namazına müteakip</option>
                            <option @if ($funeral->funeral_time === 'İkindi namazına müteakip') selected @endif value="İkindi namazına müteakip">
                                İkindi namazına müteakip</option>
                        </select>
                    </div>
                    <div class="form-group mb-5">
                        <label for="funeral_address" class="form-label">Taziye Adresi</label>
                        <input type="text" name="funeral_address" id="funeral_address"
                            class="form-control form-control-solid" value="{{ $funeral->funeral_address }}"
                            placeholder="Taziye Adresi">
                    </div>
                    <div class="form-group mb-5">
                        <label for="date_of_death" class="form-label">Ölüm Tarihi</label>
                        <span class="text-danger d-block">{{ $errors->first('date_of_death') }}</span>
                        <input type="date" name="date_of_death" id="date_of_death"
                            class="form-control form-control-solid"
                            value="{{ $funeral->date_of_death->format('Y-m-d') }}" placeholder="Ölüm Tarihi"
                            min="{{ Carbon\Carbon::now()->subDays(3)->format('Y-m-d') }}"
                            max="{{ Carbon\Carbon::now()->format('Y-m-d') }}">
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css"
        rel="stylesheet" />
    <script>
        $(document).ready(function() {
            $('#content').summernote();
        });
    </script>
    @if ($funeral->country_id === '190')
        <script>
            $("#funeralSelectValue").show();
            $("#noneFuneralSelectValue").hide();
        </script>
    @else
        <script>
            $("#funeralSelectValue").hide();
            $("#noneFuneralSelectValue").show();
        </script>
    @endif
    <script>
        $("#funeral_country_id").change(e => {
            if (e.target.value === "190") {
                $("#funeralSelectValue").show();
                $("#noneFuneralSelectValue").hide();
            } else {
                $("#funeralSelectValue").hide();
                $("#noneFuneralSelectValue").show();
            }
        })

        $(document).ready(function() {
            $("#district_id").prop("disabled", true);
            $("#neighborhood_id").prop("disabled", true);
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
                        var districtId = $("#district_id").val();
                        $.ajax({
                            type: "POST",
                            url: "{{ route('neighborhoods') }}",
                            data: {
                                "district_id": districtId,
                                "_token": "{{ csrf_token() }}"
                            },
                            success: function(value) {
                                $("#neighborhood_id").prop("disabled", false)
                                $("#neighborhood_id").html(value)
                            }
                        })
                    }
                })
            });
        });
        $(document).ready(function() {
            $("#neighborhood_id").prop("disabled", true);
            $("#district_id").change(function() {
                var districtId = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "{{ route('neighborhoods') }}",
                    data: {
                        "district_id": districtId,
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function(value) {
                        $("#neighborhood_id").prop("disabled", false)
                        $("#neighborhood_id").html(value)
                    }
                })
            });
        });
    </script>
    @if ($funeral->gender == 'Kadın')
        <script>
            $("#funeralMaidenNameContainer").show()
        </script>
    @else
        <script>
            $("#funeralMaidenNameContainer").hide()
        </script>
    @endif
    <script>
        $("#funeral_gender").change(e => {
            if (e.target.value == 'Kadın') $("#funeralMaidenNameContainer").show()
            else $("#funeralMaidenNameContainer").hide()
        })
    </script>
@endsection
