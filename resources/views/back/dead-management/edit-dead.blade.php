@extends('back.layout.main')
@section('title', $dead->full_name)
@section('content')
    <!--begin::Toolbar-->
    <div class="toolbar mb-5 mb-lg-7" id="kt_toolbar">
        <!--begin::Page title-->
        <div class="page-title d-flex flex-column me-3">
            <!--begin::Title-->
            <h1 class="d-flex text-dark fw-bolder my-1 fs-3">{{ $dead->full_name }}</h1>
            <!--end::Title-->
            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-dot fw-bold text-gray-600 fs-7 my-1">
                <!--begin::Item-->
                <li class="breadcrumb-item text-gray-600">
                    <a href="{{ route('panel') }}" class="text-gray-600 text-hover-primary">Anasayfa</a>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item text-gray-600">Mevta Yönetimi</li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item text-gray-600">{{ $dead->full_name }}</li>
                <!--end::Item-->
            </ul>
            <!--end::Breadcrumb-->
        </div>
        <!--end::Page title-->
    </div>
    <!--end::Toolbar-->
    @if (!$dead->cemetery && $dead->cemetery_name)
        <div class="alert alert-info">
            <i class="fas fa-info-circle text-info"></i>
            Bu mevta sistemde olmayan {{ $dead->cemetery_name }} mezarlığına atanmış
        </div>
    @endif
    <!--begin::Post-->
    <div class="content flex-column-fluid" id="kt_content">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Mevta Güncelle</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('deceased.update', $dead->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group mb-5">
                                <label for="image" class="form-label">Mevta Resmi</label>
                                <div>
                                    <img src="{{ $dead->image }}" id="image_preview" width="250" alt=""
                                        class="mb-5">
                                </div>
                                <span class="text-danger d-block">{{ $errors->first('image') }}</span>
                                <input type="file" name="image" id="image" class="form-control form-control-solid">
                            </div>
                            <div class="form-group mb-5">
                                <label for="country_id" class="form-label">Ülke</label>
                                <select name="country_id" id="country_id" data-control="select2"
                                    class="form-select form-select-solid" style="width: 100%">
                                    @foreach ($countries as $country)
                                        <option @if ($country->id == $dead->country_id) selected @endif
                                            value="{{ $country->id }}">
                                            {{ $country->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row" id="selectValue">
                                @if (Auth::user()->province_district_customization == 0)
                                    <div class="form-group col-md-6 mb-5">
                                        <label for="province_id" class="form-label">İl</label>
                                        <span class="text-danger d-block">{{ $errors->first('province_id') }}</span>
                                        <select name="province_id" id="province_id" class="form-select form-select-solid"
                                            data-control="select2" data-placeholder="İl Seçiniz">
                                            <option value=""></option>
                                            @foreach ($provinces as $province)
                                                <option @if ($province->id == $dead->province_id) selected @endif
                                                    value="{{ $province->id }}">
                                                    {{ $province->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6 mb-5">
                                        <label for="district_id" class="form-label">İlçe</label>
                                        <span class="text-danger d-block">{{ $errors->first('district_id') }}</span>
                                        <select name="district_id" id="district_id" class="form-select form-select-solid"
                                            data-control="select2" data-placeholder="İlçe Seçiniz">
                                            <option value=""></option>
                                            @foreach ($districts as $district)
                                                <option @if ($dead->district_id == $district->id) selected @endif
                                                    value="{{ $district->id }}">
                                                    {{ $district->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @elseif(Auth::user()->province_district_customization == 1)
                                    <div class="form-group col-md-12 mb-5">
                                        <label for="province_id" class="form-label">İl</label>
                                        <span class="text-danger d-block">{{ $errors->first('province_id') }}</span>
                                        <select name="province_id" id="province_id" class="form-select form-select-solid"
                                            data-control="select2" data-placeholder="İl Seçiniz">
                                            <option value=""></option>
                                            @foreach (Auth::user()->provinces as $province)
                                                <option @if ($province->id == $dead->province_id) selected @endif
                                                    value="{{ $province->id }}">
                                                    {{ $province->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @elseif(Auth::user()->province_district_customization == 2)
                                    <div class="form-group col-md-6 mb-5">
                                        <label for="province_id" class="form-label">İl</label>
                                        <span class="text-danger d-block">{{ $errors->first('province_id') }}</span>
                                        <select name="province_id" id="province_id" class="form-select form-select-solid"
                                            data-control="select2" data-placeholder="İl Seçiniz">
                                            <option value=""></option>
                                            @foreach (Auth::user()->provinces as $province)
                                                <option @if ($province->id == $dead->province_id) selected @endif
                                                    value="{{ $province->id }}">
                                                    {{ $province->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6 mb-5">
                                        <label for="district_id" class="form-label">İlçe</label>
                                        <span class="text-danger d-block">{{ $errors->first('district_id') }}</span>
                                        <select name="district_id" id="district_id" class="form-select form-select-solid"
                                            data-control="select2" data-placeholder="İlçe Seçiniz">
                                            <option value=""></option>
                                            @foreach (Auth::user()->provinces as $province)
                                                @foreach ($province->districts as $district)
                                                    <option @if ($district->id == $dead->district_id) selected @endif
                                                        value="{{ $district->id }}">
                                                        {{ $district->name }}</option>
                                                @endforeach
                                            @endforeach
                                        </select>
                                    </div>
                                @endif
                                <div class="form-group mb-5">
                                    <label for="neighborhood_id" class="form-label">Mahalle</label>
                                    <span class="text-danger d-block">{{ $errors->first('neighborhood_id') }}</span>
                                    <select name="neighborhood_id" id="neighborhood_id"
                                        class="form-select form-select-solid" data-control="select2"
                                        data-placeholder="Mahalle Seçiniz">
                                        <option value=""></option>
                                        @foreach ($neighborhoods as $neighborhood)
                                            <option @if ($dead->neighborhood_id == $neighborhood->id) selected @endif
                                                value="{{ $neighborhood->id }}">
                                                {{ $neighborhood->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-5" id="noneSelectValue">
                                <div class="form-group col-md-4">
                                    <label for="province_id" class="form-label">İl</label>
                                    <input type="text" name="province_name" id="province_name"
                                        class="form-control form-control-solid" value="{{ $dead->province_name }}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="district_id" class="form-label">İlçe</label>
                                    <input type="text" name="district_name" id="district_name"
                                        class="form-control form-control-solid" value="{{ $dead->district_name }}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="neighborhood_id" class="form-label">Mahalle</label>
                                    <input type="text" name="neighborhood_name" id="neighborhood_name"
                                        class="form-control form-control-solid" value="{{ $dead->neighborhood_name }}">
                                </div>
                            </div>
                            <div class="form-group mb-5" id="selectCemetery">
                                <label for="cemetery_id" class="form-label">Mezarlık</label>
                                <span class="text-danger d-block">{{ $errors->first('cemetery_id') }}</span>
                                <select name="cemetery_id" id="cemetery_id" class="form-select form-select-solid"
                                    data-control="select2" data-placeholder="Mezarlık Seçiniz">
                                    <option value=""></option>
                                    @foreach ($cemeteries as $cemetery)
                                        <option @if ($dead->cemetery_id == $cemetery->id) selected @endif
                                            value="{{ $cemetery->id }}">
                                            {{ $cemetery->title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-5" id="noneSelectCemetery">
                                <label for="cemetery_name" class="form-label">Mezarlık Adı</label>
                                <span class="text-danger d-block"
                                    id="cemeteryError">{{ $errors->first('cemetery') }}</span>
                                <input type="text" name="cemetery_name" id="cemetery_name"
                                    class="form-control form-control-solid" value="{{ $dead->cemetery_name }}">
                            </div>
                            <div class="form-group mb-5">
                                <label for="full_name" class="form-label">Mevta Ad Soyad</label>
                                <span class="text-danger d-block">{{ $errors->first('full_name') }}</span>
                                <input type="text" name="full_name" id="full_name"
                                    class="form-control form-control-solid" value="{{ $dead->full_name }}"
                                    placeholder="Mevta Adı" autocomplete="off">
                            </div>
                            <div class="form-group mb-5">
                                <label for="job" class="form-label">Meslek</label>
                                {{-- <input type="text" name="job" id="job" class="form-control form-control-solid" placeholder="Meslek"
                                    autocomplete="off" value="{{ $dead->job }}"> --}}
                                <select name="job" id="job" class="form-select form-select-solid"
                                    data-control="select2" data-placeholder="Meslek Seçiniz">
                                    <option value=""></option>
                                    @foreach ($jobs as $job)
                                        <option @if ($job->title == $dead->job) selected @endif
                                            value="{{ $job->title }}">
                                            {{ $job->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-5">
                                <label for="gender" class="form-label">Cinsiyet</label>
                                <select name="gender" id="gender" class="form-select form-select-solid"
                                    style="width: 100%">
                                    <option @if ($dead->gender == 'Erkek') selected @endif value="Erkek">Erkek
                                    </option>
                                    <option @if ($dead->gender == 'Kadın') selected @endif value="Kadın">Kadın
                                    </option>
                                </select>
                            </div>
                            <div class="form-group mb-5" id="maidenNameContainer">
                                <label for="maiden_name" class="form-label">Kızlık Soyadı</label>
                                <input type="text" name="maiden_name" id="maiden_name"
                                    class="form-control form-control-solid" placeholder="Kızlık Soyadı"
                                    autocomplete="off" value="{{ $dead->maiden_name }}">
                            </div>
                            <div class="row">
                                <div class="form-group mb-5 col-md-6">
                                    <label for="father_name" class="form-label">Baba Adı</label>
                                    <input type="text" name="father_name" id="father_name"
                                        class="form-control form-control-solid" value="{{ $dead->father_name }}"
                                        placeholder="Baba Adı" autocomplete="off">
                                </div>
                                <div class="form-group mb-5 col-md-6">
                                    <label for="mother_name" class="form-label">Anne Adı</label>
                                    <input type="text" name="mother_name" id="mother_name"
                                        class="form-control form-control-solid" value="{{ $dead->mother_name }}"
                                        placeholder="Anne Adı" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group mb-5">
                                <label for="is_married" class="form-label">Medeni Hali</label>
                                <select name="is_married" id="is_married" class="form-select form-select-solid"
                                    style="width: 100%">
                                    <option @if ($dead->is_married == 0) selected @endif value="0">Bekar
                                    </option>
                                    <option @if ($dead->is_married == 1) selected @endif value="1">Evli
                                    </option>
                                </select>
                            </div>
                            <div class="form-group mb-5" id="spouse_container">
                                <label for="spouse_name" class="form-label">Eş Adı</label>
                                <input type="text" name="spouse_name" id="spouse_name"
                                    class="form-control form-control-solid" value="{{ $dead->spouse_name }}"
                                    placeholder="Eş Adı" autocomplete="off">
                            </div>
                            <div class="row">
                                <div class="form-group mb-5 col-md-4">
                                    <label for="day_of_birth" class="form-label">Doğum Günü</label>
                                    <select name="day_of_birth" id="day_of_birth" class="form-select form-select-solid"
                                        data-control="select2" data-placeholder="Doğum Günü">
                                        <option @if ($dead->day_of_birth == '01') selected @endif value="01">01
                                        </option>
                                        <option @if ($dead->day_of_birth == '02') selected @endif value="02">02
                                        </option>
                                        <option @if ($dead->day_of_birth == '03') selected @endif value="03">03
                                        </option>
                                        <option @if ($dead->day_of_birth == '04') selected @endif value="04">04
                                        </option>
                                        <option @if ($dead->day_of_birth == '05') selected @endif value="05">05
                                        </option>
                                        <option @if ($dead->day_of_birth == '06') selected @endif value="06">06
                                        </option>
                                        <option @if ($dead->day_of_birth == '07') selected @endif value="07">07
                                        </option>
                                        <option @if ($dead->day_of_birth == '08') selected @endif value="08">08
                                        </option>
                                        <option @if ($dead->day_of_birth == '09') selected @endif value="09">09
                                        </option>
                                        <option @if ($dead->day_of_birth == '10') selected @endif value="10">10
                                        </option>
                                        <option @if ($dead->day_of_birth == '11') selected @endif value="11">11
                                        </option>
                                        <option @if ($dead->day_of_birth == '12') selected @endif value="12">12
                                        </option>
                                        <option @if ($dead->day_of_birth == '13') selected @endif value="13">13
                                        </option>
                                        <option @if ($dead->day_of_birth == '14') selected @endif value="14">14
                                        </option>
                                        <option @if ($dead->day_of_birth == '15') selected @endif value="15">15
                                        </option>
                                        <option @if ($dead->day_of_birth == '16') selected @endif value="16">16
                                        </option>
                                        <option @if ($dead->day_of_birth == '17') selected @endif value="17">17
                                        </option>
                                        <option @if ($dead->day_of_birth == '18') selected @endif value="18">18
                                        </option>
                                        <option @if ($dead->day_of_birth == '19') selected @endif value="19">19
                                        </option>
                                        <option @if ($dead->day_of_birth == '20') selected @endif value="20">20
                                        </option>
                                        <option @if ($dead->day_of_birth == '21') selected @endif value="21">21
                                        </option>
                                        <option @if ($dead->day_of_birth == '22') selected @endif value="22">22
                                        </option>
                                        <option @if ($dead->day_of_birth == '23') selected @endif value="23">23
                                        </option>
                                        <option @if ($dead->day_of_birth == '24') selected @endif value="24">24
                                        </option>
                                        <option @if ($dead->day_of_birth == '25') selected @endif value="25">25
                                        </option>
                                        <option @if ($dead->day_of_birth == '26') selected @endif value="26">26
                                        </option>
                                        <option @if ($dead->day_of_birth == '27') selected @endif value="27">27
                                        </option>
                                        <option @if ($dead->day_of_birth == '28') selected @endif value="28">28
                                        </option>
                                        <option @if ($dead->day_of_birth == '29') selected @endif value="29">29
                                        </option>
                                        <option @if ($dead->day_of_birth == '30') selected @endif value="30">30
                                        </option>
                                        <option @if ($dead->day_of_birth == '31') selected @endif value="31">31
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group mb-5 col-md-4">
                                    <label for="month_of_birth" class="form-label">Doğum Ayı</label>
                                    <select name="month_of_birth" id="month_of_birth"
                                        class="form-select form-select-solid" data-control="select2"
                                        data-placeholder="Doğum Ayı">
                                        <option @if ($dead->month_of_birth == '01') selected @endif value="01">Ocak
                                        </option>
                                        <option @if ($dead->month_of_birth == '02') selected @endif value="02">Şubat
                                        </option>
                                        <option @if ($dead->month_of_birth == '03') selected @endif value="03">Mart
                                        </option>
                                        <option @if ($dead->month_of_birth == '04') selected @endif value="04">Nisan
                                        </option>
                                        <option @if ($dead->month_of_birth == '05') selected @endif value="05">Mayıs
                                        </option>
                                        <option @if ($dead->month_of_birth == '06') selected @endif value="06">Haziran
                                        </option>
                                        <option @if ($dead->month_of_birth == '07') selected @endif value="07">Temmuz
                                        </option>
                                        <option @if ($dead->month_of_birth == '08') selected @endif value="08">Ağusots
                                        </option>
                                        <option @if ($dead->month_of_birth == '09') selected @endif value="09">Eylül
                                        </option>
                                        <option @if ($dead->month_of_birth == '10') selected @endif value="10">Ekim
                                        </option>
                                        <option @if ($dead->month_of_birth == '11') selected @endif value="11">Kasım
                                        </option>
                                        <option @if ($dead->month_of_birth == '12') selected @endif value="12">Aralık
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group mb-5 col-md-4">
                                    <label for="year_of_birth" class="form-label">Doğum Yılı</label>
                                    <input id="year_of_birth" name="year_of_birth"
                                        class="form-control form-control-solid" value="{{ $dead->year_of_birth }}"
                                        placeholder="Doğum Yılı" autocomplete="off">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group mb-5 col-md-4">
                                    <label for="day_of_death" class="form-label">Ölüm Günü</label>
                                    <select name="day_of_death" id="day_of_death" class="form-select form-select-solid"
                                        data-control="select2" data-placeholder="Ölüm Günü">
                                        <option @if ($dead->day_of_death == '01') selected @endif value="01">01
                                        </option>
                                        <option @if ($dead->day_of_death == '02') selected @endif value="02">02
                                        </option>
                                        <option @if ($dead->day_of_death == '03') selected @endif value="03">03
                                        </option>
                                        <option @if ($dead->day_of_death == '04') selected @endif value="04">04
                                        </option>
                                        <option @if ($dead->day_of_death == '05') selected @endif value="05">05
                                        </option>
                                        <option @if ($dead->day_of_death == '06') selected @endif value="06">06
                                        </option>
                                        <option @if ($dead->day_of_death == '07') selected @endif value="07">07
                                        </option>
                                        <option @if ($dead->day_of_death == '08') selected @endif value="08">08
                                        </option>
                                        <option @if ($dead->day_of_death == '09') selected @endif value="09">09
                                        </option>
                                        <option @if ($dead->day_of_death == '10') selected @endif value="10">10
                                        </option>
                                        <option @if ($dead->day_of_death == '11') selected @endif value="11">11
                                        </option>
                                        <option @if ($dead->day_of_death == '12') selected @endif value="12">12
                                        </option>
                                        <option @if ($dead->day_of_death == '13') selected @endif value="13">13
                                        </option>
                                        <option @if ($dead->day_of_death == '14') selected @endif value="14">14
                                        </option>
                                        <option @if ($dead->day_of_death == '15') selected @endif value="15">15
                                        </option>
                                        <option @if ($dead->day_of_death == '16') selected @endif value="16">16
                                        </option>
                                        <option @if ($dead->day_of_death == '17') selected @endif value="17">17
                                        </option>
                                        <option @if ($dead->day_of_death == '18') selected @endif value="18">18
                                        </option>
                                        <option @if ($dead->day_of_death == '19') selected @endif value="19">19
                                        </option>
                                        <option @if ($dead->day_of_death == '20') selected @endif value="20">20
                                        </option>
                                        <option @if ($dead->day_of_death == '21') selected @endif value="21">21
                                        </option>
                                        <option @if ($dead->day_of_death == '22') selected @endif value="22">22
                                        </option>
                                        <option @if ($dead->day_of_death == '23') selected @endif value="23">23
                                        </option>
                                        <option @if ($dead->day_of_death == '24') selected @endif value="24">24
                                        </option>
                                        <option @if ($dead->day_of_death == '25') selected @endif value="25">25
                                        </option>
                                        <option @if ($dead->day_of_death == '26') selected @endif value="26">26
                                        </option>
                                        <option @if ($dead->day_of_death == '27') selected @endif value="27">27
                                        </option>
                                        <option @if ($dead->day_of_death == '28') selected @endif value="28">28
                                        </option>
                                        <option @if ($dead->day_of_death == '29') selected @endif value="29">29
                                        </option>
                                        <option @if ($dead->day_of_death == '30') selected @endif value="30">30
                                        </option>
                                        <option @if ($dead->day_of_death == '31') selected @endif value="31">31
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group mb-5 col-md-4">
                                    <label for="month_of_death" class="form-label">Ölüm Ayı</label>
                                    <select name="month_of_death" id="month_of_death"
                                        class="form-select form-select-solid" data-control="select2"
                                        data-placeholder="Ölüm Ayı">
                                        <option @if ($dead->month_of_death == '01') selected @endif value="01">Ocak
                                        </option>
                                        <option @if ($dead->month_of_death == '02') selected @endif value="02">Şubat
                                        </option>
                                        <option @if ($dead->month_of_death == '03') selected @endif value="03">Mart
                                        </option>
                                        <option @if ($dead->month_of_death == '04') selected @endif value="04">Nisan
                                        </option>
                                        <option @if ($dead->month_of_death == '05') selected @endif value="05">Mayıs
                                        </option>
                                        <option @if ($dead->month_of_death == '06') selected @endif value="06">Haziran
                                        </option>
                                        <option @if ($dead->month_of_death == '07') selected @endif value="07">Temmuz
                                        </option>
                                        <option @if ($dead->month_of_death == '08') selected @endif value="08">Ağusots
                                        </option>
                                        <option @if ($dead->month_of_death == '09') selected @endif value="09">Eylül
                                        </option>
                                        <option @if ($dead->month_of_death == '10') selected @endif value="10">Ekim
                                        </option>
                                        <option @if ($dead->month_of_death == '11') selected @endif value="11">Kasım
                                        </option>
                                        <option @if ($dead->month_of_death == '12') selected @endif value="12">Aralık
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group mb-5 col-md-4">
                                    <label for="year_of_death" class="form-label">Ölüm Yılı</label>
                                    <input id="year_of_death" name="year_of_death"
                                        class="form-control form-control-solid" value="{{ $dead->year_of_death }}"
                                        placeholder="Ölüm Yılı" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group mb-5">
                                <label for="place_of_birth" class="form-label">Doğum Yeri</label>
                                <input id="place_of_birth" name="place_of_birth" class="form-control form-control-solid"
                                    placeholder="Doğum Yeri" value="{{ $dead->place_of_birth }}" autocomplete="off">
                            </div>
                            <div class="form-group mb-5">
                                <label for="content" class="form-label">Mevta Hakkında</label>
                                <span class="text-danger d-block">{{ $errors->first('content') }}</span>
                                <textarea name="content" id="content" class="form-control form-control-solid">{{ $dead->content }}</textarea>
                            </div>
                            <div class="form-group mb-5">
                                <button type="submit" class="btn btn-success">Güncelle</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h3 class="card-title">Kurumlar</h3>
                        <div class="card-actions">
                            <a href="" class="btn btn-sm btn-icon btn-light-primary" data-bs-toggle="modal"
                                data-bs-target="#addOrganisation">
                                <i class="fas fa-plus"></i>
                            </a>
                        </div>
                    </div>
                    <div class="card-body py-3">
                        <div class="tab-content">
                            <!--begin::Tap pane-->
                            <div class="tab-pane fade show active" id="kt_table_widget_8_tab_1" role="tabpanel">
                                <!--begin::Table container-->
                                <div class="table-responsive">
                                    <!--begin::Table-->
                                    <table class="table align-middle gs-0 gy-3">
                                        <!--begin::Table head-->
                                        <thead>
                                            <tr>
                                                <th class="p-0 w-350px"></th>
                                                <th class="p-0 min-w-120px"></th>
                                            </tr>
                                        </thead>
                                        <!--end::Table head-->

                                        <!--begin::Table body-->
                                        <tbody>
                                            @foreach ($dead->organisations as $org)
                                                <tr>
                                                    <td>
                                                        <a href="#"
                                                            class="text-dark fw-bold text-hover-primary mb-1 fs-6">{{ $org->name }}</a>
                                                    </td>
                                                    <td class="text-end">
                                                        <input type="hidden" value="{{ $dead->id }}"
                                                            class="dead_id">
                                                        <input type="hidden" value="{{ $org->id }}"
                                                            class="organisation_id">
                                                        <button
                                                            class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary deleteOrganisation">
                                                            <span class="svg-icon svg-icon-3">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none">
                                                                    <path
                                                                        d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z"
                                                                        fill="black" />
                                                                    <path opacity="0.5"
                                                                        d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z"
                                                                        fill="black" />
                                                                    <path opacity="0.5"
                                                                        d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z"
                                                                        fill="black" />
                                                                </svg>
                                                            </span>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <!--end::Table body-->
                                    </table>
                                </div>
                                <!--end::Table-->
                            </div>
                            <!--end::Tap pane-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end::Post-->
    <div class="modal fade" tabindex="-1" id="addOrganisation" aria-hidden="true">
        <div class="modal-dialog mw-900px">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Kurum Ekle
                    </h5>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="fas fa-times fs-4"></i>
                    </div>
                    <!--end::Close-->
                </div>
                <form action="{{ route('deceased.addOrganisation', $dead->id) }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="organisation_id" class="form-label">Kurum</label>
                            <select name="organisation_id[]" id="organisation_id" class="form-select form-select-solid"
                                multiple="multiple" data-control="select2" data-placeholder="Kurum Seçiniz">
                                <option value=""></option>
                                @foreach ($organisations as $organisation)
                                    {{-- @foreach ($dead->organisations as $org) --}}
                                    <option value="{{ $organisation->id }}">
                                        {{ $organisation->name }}</option>
                                    {{-- @endforeach --}}
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Kapat</button>
                        <button type="submit" class="btn btn-primary">Kaydet</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css"
        rel="stylesheet" />
    <script>
        const isMarried = document.querySelector("#is_married")
        const spouseContainer = document.querySelector("#spouse_container")

        spouseContainer.style.display = "{{ $dead->is_married == 0 ? 'none' : 'block' }}";

        isMarried.addEventListener("change", (e) => {
            if (e.target.value == "1") {
                spouseContainer.style.display = "block";
            } else {
                spouseContainer.style.display = "none";
            }
        })
        $(".deleteOrganisation").click(function(e) {
            e.preventDefault();

            var deadId = $(this).closest("tr").find(".dead_id").val();
            var organisationId = $(this).closest("tr").find(".organisation_id").val();

            Swal.fire({
                title: 'Emin misniz?',
                text: "Mevtayı silmek istiyor musunuz? Bu işlem geri alınamaz!",
                icon: 'warning',
                showCancelButton: true,
                cancelButtonText: "İptal et",
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Evet, sil!'
            }).then((result) => {
                if (result.isConfirmed) {

                    var data = {
                        "_token": $("input[name=_token]").val(),
                        "deadId": deadId,
                        "organisationId": organisationId,
                    };

                    $.ajax({
                        type: "GET",
                        url: "/panel/vefat-edenler/" + deadId + "/kurum-sil/" + organisationId,
                        data: data,
                        success: function() {
                            Swal.fire({
                                title: 'Silindi!',
                                text: 'Mevta başarıyla silindi.',
                                icon: 'success',
                                confirmButtonText: 'Tamam'
                            }).then(result => {
                                location.reload();
                            });
                        }
                    });
                }
            })
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#content').summernote();
        });
        $("#image").change(function() {
            let file = URL.createObjectURL(this.files[0]);
            $("#image_preview").attr("src", file)
        });
    </script>
    @if ($dead->country_id === '190')
        <script>
            $("#selectValue").show();
            $("#noneSelectValue").hide();

            $("#selectCemetery").show();
            $("#noneSelectCemetery").hide();
        </script>
    @else
        <script>
            $("#selectValue").hide();
            $("#noneSelectValue").show();

            $("#selectCemetery").hide();
            $("#noneSelectCemetery").show();
        </script>
    @endif

    <script>
        $("#country_id").change(e => {
            if (e.target.value === "190") {
                $("#selectValue").show();
                $("#noneSelectValue").hide();
                $("#selectCemetery").show();
                $("#noneSelectCemetery").hide();
            } else {
                $("#selectValue").hide();
                $("#noneSelectValue").show();
                $("#selectCemetery").hide();
                $("#noneSelectCemetery").show();
            }
        })
    </script>

    @if (Auth::user()->province_district_customization == 0)
        <script>
            $(document).ready(function() {
                // $("#district_id").prop("disabled", true);
                // $("#cemetery_id").prop("disabled", true)
                // $("#neighborhood_id").prop("disabled", true)
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
                            // $("#district_id").prop("disabled", false);
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
                                    // $("#neighborhood_id").prop(
                                    //     "disabled", false)
                                    $("#neighborhood_id").html(
                                        value)
                                    var neighborhoodId = $("#neighborhood_id").val();
                                    $.ajax({
                                        type: "POST",
                                        url: "{{ route('cemeteries') }}",
                                        data: {
                                            "province_id": provinceId,
                                            "_token": "{{ csrf_token() }}"
                                        },
                                        success: function(
                                            value) {
                                            // $("#cemetery_id")
                                            //     .prop(
                                            //         "disabled",
                                            //         false
                                            //     )
                                            $("#cemetery_id")
                                                .html(
                                                    value
                                                )
                                                .trigger(
                                                    "change"
                                                )
                                        }
                                    })
                                }
                            })
                        }
                    });
                });
            });
            $(document).ready(function() {
                // $("#cemetery_id").prop("disabled", true)
                // $("#neighborhood_id").prop("disabled", true)
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
                            // $("#neighborhood_id").prop("disabled", false);
                            $("#neighborhood_id").html(value)
                            // var neighborhoodId = $("#neighborhood_id").val();
                            $.ajax({
                                type: "POST",
                                url: "{{ route('cemeteries') }}",
                                data: {
                                    "district_id": districtId,
                                    "_token": "{{ csrf_token() }}"
                                },
                                success: function(value) {
                                    $("#cemetery_id").html(
                                        value)
                                }
                            })
                        }
                    });
                });
            });
            // $(document).ready(function() {
            //     $("#cemetery_id").prop("disabled", true)
            //     $("#neighborhood_id").change(function() {
            //         var neighborhoodId = $(this).val();
            //         $.ajax({
            //             type: "POST",
            //             url: "{{ route('cemeteries') }}",
            //             data: {
            //                 "neighborhood_id": neighborhoodId,
            //                 "_token": "{{ csrf_token() }}"
            //             },
            //             success: function(value) {
            //                 $("#cemetery_id").prop("disabled", false);
            //                 $("#cemetery_id").html(value)
            //                 var neighborhoodId = $("#neighborhood_id").val();
            //             }
            //         });
            //     });
            // });
        </script>
    @elseif (Auth::user()->province_district_customization == 1)
        <script>
            $(document).ready(function() {
                // $("#cemetery_id").prop("disabled", true);
                // $("#neighborhood_id").prop("disabled", true);
                $("#province_id").change(function() {
                    var provinceId = $(this).val();
                    $.ajax({
                        type: "POST",
                        url: "{{ route('neighborhoods') }}",
                        data: {
                            "province_id": provinceId,
                            "_token": "{{ csrf_token() }}"
                        },
                        success: function(value) {
                            // $("#neighborhood_id").prop(
                            //     "disabled", false)
                            $("#neighborhood_id").html(
                                value)
                            // var neighborhoodId = $("#neighborhood_id").val();
                            $.ajax({
                                type: "POST",
                                url: "{{ route('cemeteries') }}",
                                data: {
                                    "province_id": provinceId,
                                    "_token": "{{ csrf_token() }}"
                                },
                                success: function(
                                    value) {
                                    // $("#cemetery_id")
                                    //     .prop(
                                    //         "disabled",
                                    //         false
                                    //     )
                                    $("#cemetery_id")
                                        .html(
                                            value
                                        )
                                        .trigger(
                                            "change"
                                        )
                                }
                            })
                        }
                    })
                });
            });
            // $(document).ready(function() {
            //     $("#cemetery_id").prop("disabled", true)
            //     $("#neighborhood_id").change(function() {
            //         var neighborhoodId = $(this).val();
            //         $.ajax({
            //             type: "POST",
            //             url: "{{ route('cemeteries') }}",
            //             data: {
            //                 "neighborhood_id": neighborhoodId,
            //                 "_token": "{{ csrf_token() }}"
            //             },
            //             success: function(value) {
            //                 $("#cemetery_id").prop("disabled", false);
            //                 $("#cemetery_id").html(value)
            //                 var neighborhoodId = $("#neighborhood_id").val();
            //             }
            //         });
            //     });
            // });
        </script>
    @elseif (Auth::user()->province_district_customization == 2)
        <script>
            $(document).ready(function() {
                // $("#district_id").prop("disabled", true);
                // $("#cemetery_id").prop("disabled", true)
                // $("#neighborhood_id").prop("disabled", true)
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
                            // $("#district_id").prop("disabled", false);
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
                                    // $("#neighborhood_id").prop(
                                    //     "disabled", false)
                                    $("#neighborhood_id").html(
                                        value)
                                    // var neighborhoodId = $("#neighborhood_id").val();
                                    $.ajax({
                                        type: "POST",
                                        url: "{{ route('cemeteries') }}",
                                        data: {
                                            "province_id": provinceId,
                                            "_token": "{{ csrf_token() }}"
                                        },
                                        success: function(
                                            value) {
                                            // $("#cemetery_id")
                                            //     .prop(
                                            //         "disabled",
                                            //         false
                                            //     )
                                            $("#cemetery_id")
                                                .html(
                                                    value
                                                )
                                                .trigger(
                                                    "change"
                                                )
                                        }
                                    })
                                }
                            })
                        }
                    });
                });
            });
            $(document).ready(function() {
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
                            $("#neighborhood_id").html(value)
                            $.ajax({
                                type: "POST",
                                url: "{{ route('cemeteries') }}",
                                data: {
                                    "district_id": districtId,
                                    "_token": "{{ csrf_token() }}"
                                },
                                success: function(value) {
                                    $("#cemetery_id").html(
                                        value)
                                }
                            })
                        }
                    });
                });
            });
            // $(document).ready(function() {
            //     $("#cemetery_id").prop("disabled", true)
            //     $("#neighborhood_id").change(function() {
            //         var neighborhoodId = $(this).val();
            //         $.ajax({
            //             type: "POST",
            //             url: "{{ route('cemeteries') }}",
            //             data: {
            //                 "neighborhood_id": neighborhoodId,
            //                 "_token": "{{ csrf_token() }}"
            //             },
            //             success: function(value) {
            //                 $("#cemetery_id").prop("disabled", false);
            //                 $("#cemetery_id").html(value)
            //                 var neighborhoodId = $("#neighborhood_id").val();
            //             }
            //         });
            //     });
            // });
        </script>
    @endif
    @if ($dead->gender == 'Kadın')
        <script>
            $("#maidenNameContainer").show()
        </script>
    @else
        <script>
            $("#maidenNameContainer").hide()
        </script>
    @endif
    <script>
        $("#year_of_birth").datepicker({
            singleDatePicker: true,
            showDropdowns: true,
            format: "yyyy",
            viewMode: "years",
            minViewMode: "years"
        });
        $("#year_of_death").datepicker({
            singleDatePicker: true,
            showDropdowns: true,
            format: "yyyy",
            viewMode: "years",
            minViewMode: "years"
        });


        $("#gender").change(e => {
            if (e.target.value == 'Kadın') $("#maidenNameContainer").show()
            else $("#maidenNameContainer").hide()
        })
    </script>
@endsection
