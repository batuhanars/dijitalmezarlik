<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="{{ $setting ? $setting->keywords : '' }}">
    <meta name="description" content="{{ $setting ? $setting->description : '' }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ $setting ? $setting->favicon : '' }}">
    <link rel="stylesheet" href="{{ asset('front/assets/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('front/assets/css/fontawesome.min.css') }}">
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" /> --}}
    <link rel="stylesheet" href="{{ asset('front/assets/css/meanmenu.css') }}">
    <link rel="stylesheet" href="{{ asset('front/assets/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('front/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/assets/css/magnafic-popup.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/assets/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('front/assets/css/spacing.css') }}">
    <link rel="stylesheet" href="{{ asset('front/assets/css/main.css?ver=1') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css"
        rel="stylesheet" />
    @yield('css')
    <title>{{ $setting ? $setting->title : '' }} - @yield('title')</title>
    <style>
        .suggestion_complaint {
            width: 100%;
            height: 65px;
            border: none;
            border-radius: 15px;
            padding: 0 16px 0 0;
            background: #FFFFFF;
        }

        .suggestion_complaint_select {
            height: 65px;
            border: none;
            border-radius: 15px;
            padding: 0 0 0 25px;
        }

        .form-select {
            display: block;
            width: 100%;
            padding: .375rem 2.25rem .375rem .75rem;
            -moz-padding-start: calc(0.75rem - 3px);
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            background-color: #fff;
            background-repeat: no-repeat;
            background-position: right .75rem center;
            background-size: 16px 12px;
            border: 1px solid #ced4da;
            border-radius: .25rem;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        }

        .form-label {
            margin-bottom: .5rem;
            font-weight: 500;
            color: #3f4254;
        }

        #addDead .select2-selection,
        #addDead .select2-selection--single,
        #addFuneral .select2-selection,
        #addFuneral .select2-selection--single {
            display: block;
            width: 100%;
            height: calc(1.5em + .75rem + 2px);
            padding: .375rem 2.25rem .375rem .75rem;
            -moz-padding-start: calc(0.75rem - 3px);
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            background-color: #fff;
            background-repeat: no-repeat;
            background-position: right .75rem center;
            background-size: 16px 12px;
            border: 1px solid #ced4da;
            border-radius: .25rem;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        }

        #addDead .select2-selection__arrow,
        #addFuneral .select2-selection__arrow {
            margin: 5px 10px 0 10px;
        }
    </style>
</head>

<body>
    <div id="loading" class="loading-1">
        <div id="loading-center">
            <div id="loading-center-absolute">
                <div class="object" id="object_four"></div>
                <div class="object" id="object_three"></div>
                <div class="object" id="object_two"></div>
                <div class="object" id="object_one"></div>
            </div>
        </div>
    </div>
    <!-- /. preloader -->
    <header class="header-area header-spacing">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-xl-2 col-lg-3 col-md-4 col-4">
                    <div class="logo">
                        <a href="{{ route('home') }}">
                            <img src="{{ $setting ? $setting->dark_logo : '' }}"
                                alt="{{ $setting ? $setting->title : '' }}">
                        </a>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-9 col-md-8 col-8 text-right">
                    <div class="d-none d-lg-inline-block">
                        <div class="main-menu">
                            <nav id="mobile-menu">
                                <ul id="menu-main-menu">
                                    <li class="has-dropdown">
                                        <a href="{{ route('home') }}">Anasayfa</a>
                                    </li>
                                    <li><a href="{{ route('home.products') }}">Ürünler</a></li>
                                    <li><a href="{{ route('home.prayers') }}">Dualar</a></li>
                                    <li class="has-dropdown"><a
                                            href="{{ route('home.cemeteries.index') }}">Mezarlıklar</a>
                                    </li>
                                    <li class="has-dropdown"><a href="{{ route('home.deceased') }}">Vefat
                                            Edenler</a>
                                    </li>
                                    <li><a href="{{ route('home.contact') }}">İletişim</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>

                </div>
                <div class="col-xl-4">

                    <div class="d-inline-block ">
                        <div class="btn btn-dark btn-sm" style="padding: 16px 17px; background: #43824f">
                            <a href="#" class="text-white" data-toggle="modal" data-target=".bd-example-modal-lg">
                                <i class="fas fa-plus mr-2"></i>
                                Cenazemi Kaydet
                            </a>
                        </div>
                        <div class="btn btn-dark btn-sm" style="padding: 16px 17px; background: #43824f">
                            <a href="#" class="text-white" data-toggle="modal"
                                data-target=".bd-example-modal-lg2">
                                <i class="fas fa-megaphone mr-2"></i>
                                Cenaze İlanı
                            </a>
                        </div>
                        <div class="sidebar-open open-mobile-menu ml-15 d-none d-lg-inline-block">
                            <a href="javascript:void(0)">
                                <svg xmlns="http://www.w3.org/2000/svg" width="23px" height="24px">
                                    <path fill-rule="evenodd" fill="rgb(24, 27, 29)"
                                        d="M22.375,12.635 L8.250,12.635 C7.905,12.635 7.625,12.350 7.625,12.000 C7.625,11.649 7.905,11.365 8.250,11.365 L22.375,11.365 C22.720,11.365 23.000,11.649 23.000,12.000 C23.000,12.350 22.720,12.635 22.375,12.635 ZM22.375,3.746 L8.250,3.746 C7.905,3.746 7.625,3.461 7.625,3.111 C7.625,2.760 7.905,2.476 8.250,2.476 L22.375,2.476 C22.720,2.476 23.000,2.760 23.000,3.111 C23.000,3.461 22.720,3.746 22.375,3.746 ZM3.062,24.000 C1.371,24.000 0.000,22.607 0.000,20.888 C0.000,19.170 1.371,17.777 3.062,17.777 C4.754,17.777 6.125,19.170 6.125,20.888 C6.125,22.607 4.754,24.000 3.062,24.000 ZM3.062,19.047 C2.061,19.047 1.250,19.872 1.250,20.888 C1.250,21.905 2.061,22.730 3.062,22.730 C4.063,22.730 4.875,21.905 4.875,20.888 C4.875,19.872 4.063,19.047 3.062,19.047 ZM3.062,15.111 C1.371,15.111 0.000,13.718 0.000,12.000 C0.000,10.282 1.371,8.888 3.062,8.888 C4.754,8.888 6.125,10.282 6.125,12.000 C6.125,13.718 4.754,15.111 3.062,15.111 ZM3.062,10.159 C2.061,10.159 1.250,10.983 1.250,12.000 C1.250,13.017 2.061,13.841 3.062,13.841 C4.063,13.841 4.875,13.017 4.875,12.000 C4.875,10.983 4.063,10.159 3.062,10.159 ZM3.062,6.222 C1.371,6.222 0.000,4.829 0.000,3.111 C0.000,1.393 1.371,-0.000 3.062,-0.000 C4.754,-0.000 6.125,1.393 6.125,3.111 C6.125,4.829 4.754,6.222 3.062,6.222 ZM3.062,1.270 C2.061,1.270 1.250,2.094 1.250,3.111 C1.250,4.128 2.061,4.952 3.062,4.952 C4.063,4.952 4.875,4.128 4.875,3.111 C4.875,2.094 4.063,1.270 3.062,1.270 ZM8.250,20.254 L22.375,20.254 C22.720,20.254 23.000,20.538 23.000,20.888 C23.000,21.239 22.720,21.524 22.375,21.524 L8.250,21.524 C7.905,21.524 7.625,21.239 7.625,20.888 C7.625,20.538 7.905,20.254 8.250,20.254 Z" />
                                </svg>
                            </a>
                        </div>
                        <div class="menu-open open-mobile-menu ml-20 d-inline-block d-lg-none">
                            <a href="javascript:void(0)">
                                <svg xmlns="http://www.w3.org/2000/svg" width="23px" height="24px">
                                    <path fill-rule="evenodd" fill="rgb(24, 27, 29)"
                                        d="M22.375,12.635 L8.250,12.635 C7.905,12.635 7.625,12.350 7.625,12.000 C7.625,11.649 7.905,11.365 8.250,11.365 L22.375,11.365 C22.720,11.365 23.000,11.649 23.000,12.000 C23.000,12.350 22.720,12.635 22.375,12.635 ZM22.375,3.746 L8.250,3.746 C7.905,3.746 7.625,3.461 7.625,3.111 C7.625,2.760 7.905,2.476 8.250,2.476 L22.375,2.476 C22.720,2.476 23.000,2.760 23.000,3.111 C23.000,3.461 22.720,3.746 22.375,3.746 ZM3.062,24.000 C1.371,24.000 0.000,22.607 0.000,20.888 C0.000,19.170 1.371,17.777 3.062,17.777 C4.754,17.777 6.125,19.170 6.125,20.888 C6.125,22.607 4.754,24.000 3.062,24.000 ZM3.062,19.047 C2.061,19.047 1.250,19.872 1.250,20.888 C1.250,21.905 2.061,22.730 3.062,22.730 C4.063,22.730 4.875,21.905 4.875,20.888 C4.875,19.872 4.063,19.047 3.062,19.047 ZM3.062,15.111 C1.371,15.111 0.000,13.718 0.000,12.000 C0.000,10.282 1.371,8.888 3.062,8.888 C4.754,8.888 6.125,10.282 6.125,12.000 C6.125,13.718 4.754,15.111 3.062,15.111 ZM3.062,10.159 C2.061,10.159 1.250,10.983 1.250,12.000 C1.250,13.017 2.061,13.841 3.062,13.841 C4.063,13.841 4.875,13.017 4.875,12.000 C4.875,10.983 4.063,10.159 3.062,10.159 ZM3.062,6.222 C1.371,6.222 0.000,4.829 0.000,3.111 C0.000,1.393 1.371,-0.000 3.062,-0.000 C4.754,-0.000 6.125,1.393 6.125,3.111 C6.125,4.829 4.754,6.222 3.062,6.222 ZM3.062,1.270 C2.061,1.270 1.250,2.094 1.250,3.111 C1.250,4.128 2.061,4.952 3.062,4.952 C4.063,4.952 4.875,4.128 4.875,3.111 C4.875,2.094 4.063,1.270 3.062,1.270 ZM8.250,20.254 L22.375,20.254 C22.720,20.254 23.000,20.538 23.000,20.888 C23.000,21.239 22.720,21.524 22.375,21.524 L8.250,21.524 C7.905,21.524 7.625,21.239 7.625,20.888 C7.625,20.538 7.905,20.254 8.250,20.254 Z" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div id="app">
        <div class="modal fade bd-example-modal-lg" id="addDead" tabindex="-1" role="dialog"
            aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Cenazemi Kaydet</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span style="font-size: 1.5em;" aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('home.deceased.store') }}" method="post" id="submitDead"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="image" class="form-label">Mevta Resmi</label>
                                <span class="text-danger d-block"
                                    id="imageError">{{ $errors->first('image') }}</span>
                                <input type="file" name="image" id="image"
                                    class="form-control form-control-solid">
                            </div>
                            <div class="form-group">
                                <label for="country_id" class="form-label">Ülke</label>
                                <select name="country_id" id="country_id" class="form-select" style="width: 100%">
                                    @foreach ($countries as $country)
                                        <option @if ($country->title == 'Türkiye') selected @endif
                                            value="{{ $country->id }}">{{ $country->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row" id="selectValue">
                                <div class="form-group col-md-4">
                                    <label for="province_id" class="form-label">İl</label>
                                    <span class="text-danger d-block"
                                        id="provinceError">{{ $errors->first('province_id') }}</span>
                                    <select name="province_id" id="province_id" class="form-select"
                                        style="width: 100%">
                                        <option selected disabled value="">İl Seçiniz</option>
                                        @foreach ($selectboxProvinces as $province)
                                            <option value="{{ $province->id }}">{{ $province->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="district_id" class="form-label">İlçe</label>
                                    <span class="text-danger d-block"
                                        id="districtError">{{ $errors->first('district_id') }}</span>
                                    <select name="district_id" id="district_id" class="form-select"
                                        style="width: 100%">
                                        <option selected disabled value="">İlçe Seçiniz</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="neighborhood_id" class="form-label">Mahalle</label>
                                    <span class="text-danger d-block"
                                        id="neighbothoodError">{{ $errors->first('neighborhood_id') }}</span>
                                    <select name="neighborhood_id" id="neighborhood_id" class="form-select"
                                        style="width: 100%">
                                        <option selected disabled value="">Mahalle Seçiniz</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row" id="noneSelectValue">
                                <div class="form-group col-md-4">
                                    <label for="province_id" class="form-label">İl</label>
                                    <input type="text" name="province_name" class="form-control"
                                        placeholder="İl">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="district_id" class="form-label">İlçe</label>
                                    <input type="text" name="district_name" class="form-control"
                                        placeholder="İlçe">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="neighborhood_id" class="form-label">Mahalle</label>
                                    <input type="text" name="neighborhood_name" class="form-control"
                                        placeholder="İl">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-group" id="selectCemetery">
                                    <label for="cemetery_id" class="form-label">Mezarlık</label>
                                    <span class="text-danger d-block"
                                        id="cemeteryIdError">{{ $errors->first('cemetery_id') }}</span>
                                    <select name="cemetery_id" id="cemetery_id" class="form-select"
                                        style="width: 100%">
                                        <option selected disabled value="0">Mezarlık Seçiniz</option>
                                    </select>
                                </div>
                                <div class="form-group" id="noneSelectCemetery">
                                    <label for="cemetery_name" class="form-label">Mezarlık Adı</label>
                                    <span class="text-danger d-block"
                                        id="cemeteryError">{{ $errors->first('cemetery') }}</span>
                                    <input type="text" name="cemetery_name" id="cemetery_name"
                                        class="form-control" placeholder="Mezarlık Adı">
                                </div>
                                <label class="mt-2" id="hasNotCemetery">
                                    <input type="checkbox" id="cemeteryIsAvailable">
                                    <span class="text-dark">
                                        Aradığınız mezarlık burada yok mu?
                                    </span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="organisation_id" class="form-label">Kurum</label>
                                <select name="organisation_id[]" id="organisation_id" class="form-select"
                                    style="width: 100%">
                                    @foreach ($selectboxOrganisations as $organisation)
                                        <option value="{{ $organisation->id }}">{{ $organisation->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="first_name" class="form-label">Mevta Adı</label>
                                    <span class="text-danger d-block"
                                        id="lastNameError">{{ $errors->first('first_name') }}</span>
                                    <input type="text" name="first_name" id="first_name"
                                        class="form-control form-control-solid" placeholder="Mevta Adı"
                                        autocomplete="off" value="{{ old('first_name') }}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="last_name" class="form-label">Mevta Soyadı</label>
                                    <span class="text-danger d-block"
                                        id="lastNameError">{{ $errors->first('last_name') }}</span>
                                    <input type="text" name="last_name" id="last_name"
                                        class="form-control form-control-solid" placeholder="Mevta Soyadı"
                                        autocomplete="off" value="{{ old('last_name') }}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="job" class="form-label">Meslek</label>
                                    <select name="job" id="job" class="form-select" style="width: 100%">
                                        <option selected disabled value="">Meslek Seçiniz</option>
                                        @foreach ($jobs as $job)
                                            <option value="{{ $job->title }}">{{ $job->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="gender" class="form-label">Cinsiyet</label>
                                <select name="gender" id="gender" class="form-select" style="width: 100%">
                                    <option value="Erkek">Erkek</option>
                                    <option value="Kadın">Kadın</option>
                                </select>
                            </div>
                            <div class="form-group" id="maidenNameContainer">
                                <label for="maiden_name" class="form-label">Kızlık Soyadı</label>
                                <input type="text" name="maiden_name" id="maiden_name"
                                    class="form-control form-control-solid" placeholder="Kızlık Soyadı"
                                    autocomplete="off" value="{{ old('maiden_name') }}">
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="father_name" class="form-label">Baba Adı</label>
                                    <span class="text-danger d-block"
                                        id="fatherNameError">{{ $errors->first('father_name') }}</span>
                                    <input type="text" name="father_name" id="father_name"
                                        class="form-control form-control-solid" placeholder="Baba Adı"
                                        autocomplete="off" value="{{ old('father_name') }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="mother_name" class="form-label">Anne Adı</label>
                                    <span class="text-danger d-block"
                                        id="motherNameError">{{ $errors->first('mother_name') }}</span>
                                    <input type="text" name="mother_name" id="mother_name"
                                        class="form-control form-control-solid" placeholder="Anne Adı"
                                        autocomplete="off" value="{{ old('mother_name') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="is_married" class="form-label">Medeni Hali</label>
                                <select name="is_married" id="is_married" class="form-select" style="width: 100%">
                                    <option value="0">Bekar</option>
                                    <option value="1">Evli</option>
                                </select>
                            </div>
                            <div class="form-group" id="spouse_container">
                                <label for="spouse_name" class="form-label">Eş Adı</label>
                                <input type="text" name="spouse_name" id="spouse_name"
                                    class="form-control form-control-solid" placeholder="Eş Adı" autocomplete="off"
                                    value="{{ old('spouse_name') }}">
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="day_of_birth" class="form-label">Doğum Günü</label>
                                    <select name="day_of_birth" id="day_of_birth" class="form-select">
                                        <option value=""></option>
                                        <option value="01">01</option>
                                        <option value="02">02</option>
                                        <option value="03">03</option>
                                        <option value="04">04</option>
                                        <option value="05">05</option>
                                        <option value="06">06</option>
                                        <option value="07">07</option>
                                        <option value="08">08</option>
                                        <option value="09">09</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                        <option value="13">13</option>
                                        <option value="14">14</option>
                                        <option value="15">15</option>
                                        <option value="16">16</option>
                                        <option value="17">17</option>
                                        <option value="18">18</option>
                                        <option value="19">19</option>
                                        <option value="20">20</option>
                                        <option value="21">21</option>
                                        <option value="22">22</option>
                                        <option value="23">23</option>
                                        <option value="24">24</option>
                                        <option value="25">25</option>
                                        <option value="26">26</option>
                                        <option value="27">27</option>
                                        <option value="28">28</option>
                                        <option value="29">29</option>
                                        <option value="30">30</option>
                                        <option value="31">31</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="month_of_birth" class="form-label">Doğum Ayı</label>
                                    <select name="month_of_birth" id="month_of_birth" class="form-select">
                                        <option value=""></option>
                                        <option value="01">Ocak</option>
                                        <option value="02">Şubat</option>
                                        <option value="03">Mart</option>
                                        <option value="04">Nisan</option>
                                        <option value="05">Mayıs</option>
                                        <option value="06">Haziran</option>
                                        <option value="07">Temmuz</option>
                                        <option value="08">Ağusots</option>
                                        <option value="09">Eylül</option>
                                        <option value="10">Ekim</option>
                                        <option value="11">Kasım</option>
                                        <option value="12">Aralık</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="year_of_birth" class="form-label">Doğum Yılı</label>
                                    <input id="year_of_birth" name="year_of_birth" class="form-control "
                                        placeholder="Doğum Yılı" autocomplete="off">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="day_of_death" class="form-label">Ölüm Günü</label>
                                    <select name="day_of_death" id="day_of_death" class="form-select">
                                        <option value=""></option>
                                        <option value="01">01</option>
                                        <option value="02">02</option>
                                        <option value="03">03</option>
                                        <option value="04">04</option>
                                        <option value="05">05</option>
                                        <option value="06">06</option>
                                        <option value="07">07</option>
                                        <option value="08">08</option>
                                        <option value="09">09</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                        <option value="13">13</option>
                                        <option value="14">14</option>
                                        <option value="15">15</option>
                                        <option value="16">16</option>
                                        <option value="17">17</option>
                                        <option value="18">18</option>
                                        <option value="19">19</option>
                                        <option value="20">20</option>
                                        <option value="21">21</option>
                                        <option value="22">22</option>
                                        <option value="23">23</option>
                                        <option value="24">24</option>
                                        <option value="25">25</option>
                                        <option value="26">26</option>
                                        <option value="27">27</option>
                                        <option value="28">28</option>
                                        <option value="29">29</option>
                                        <option value="30">30</option>
                                        <option value="31">31</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="month_of_death" class="form-label">Ölüm Ayı</label>
                                    <select name="month_of_death" id="month_of_death" class="form-select">
                                        <option value=""></option>
                                        <option value="01">Ocak</option>
                                        <option value="02">Şubat</option>
                                        <option value="03">Mart</option>
                                        <option value="04">Nisan</option>
                                        <option value="05">Mayıs</option>
                                        <option value="06">Haziran</option>
                                        <option value="07">Temmuz</option>
                                        <option value="08">Ağusots</option>
                                        <option value="09">Eylül</option>
                                        <option value="10">Ekim</option>
                                        <option value="11">Kasım</option>
                                        <option value="12">Aralık</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="year_of_death" class="form-label">Ölüm Yılı</label>
                                    <input id="year_of_death" name="year_of_death"
                                        class="form-control form-control-solid" placeholder="Ölüm Yılı"
                                        autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="place_of_birth" class="form-label">Doğum Yeri</label>
                                <input id="place_of_birth" name="place_of_birth"
                                    class="form-control form-control-solid" placeholder="Doğum Yeri"
                                    autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="content" class="form-label">Mevta Hakkında</label>
                                <span class="text-danger d-block"
                                    id="aboutError">{{ $errors->first('content') }}</span>
                                <textarea name="content" id="content" class="form-control form-control-solid">{{ old('content') }}</textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">Kaydet</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade bd-example-modal-lg2" tabindex="-1" role="dialog" id="addFuneral"
            aria-labelledby="myLargeModalLabel2" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Cenaze İlanı</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span style="font-size: 1.5em;" aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('home.funeral-notices.store') }}" id="addFuneralNotice"
                            method="post">
                            @csrf
                            <div class="form-group">
                                <label for="owner" class="form-label">İlan Sahibi</label>
                                <span class="text-danger error d-block" id="ownerError"></span>
                                <input type="text" name="owner" id="owner" class="form-control"
                                    placeholder="Ad Soyad">
                            </div>
                            <div class="form-group">
                                <label for="funeral_country_id" class="form-label">Ülke</label>
                                <select name="country_id" id="funeral_country_id" class="form-select"
                                    style="width: 100%">
                                    @foreach ($countries as $country)
                                        <option @if ($country->title == 'Türkiye') selected @endif
                                            value="{{ $country->id }}">{{ $country->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row" id="funeralSelectValue">
                                <div class="form-group col-md-4">
                                    <label for="province_id" class="form-label">İl</label>
                                    <span class="text-danger error d-block"
                                        id="funeralProvinceError">{{ $errors->first('province_id') }}</span>
                                    <select name="province_id" id="funeral_province_id" class="form-select"
                                        style="width: 100%">
                                        <option selected disabled value="">İl Seçiniz</option>
                                        @foreach ($selectboxProvinces as $province)
                                            <option value="{{ $province->id }}">{{ $province->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="district_id" class="form-label">İlçe</label>
                                    <span class="text-danger error d-block"
                                        id="funeralDistrictError">{{ $errors->first('district_id') }}</span>
                                    <select name="district_id" id="funeral_district_id" class="form-select"
                                        style="width: 100%">
                                        <option selected disabled value="">İlçe Seçiniz</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="neighborhood_id" class="form-label">Mahalle</label>
                                    <span class="text-danger error d-block"
                                        id="funeralNeighborhoodError">{{ $errors->first('neighborhood_id') }}</span>
                                    <select name="neighborhood_id" id="funeral_neighborhood_id" class="form-select"
                                        style="width: 100%">
                                        <option selected disabled value="">Mahalle Seçiniz</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row" id="noneFuneralSelectValue">
                                <div class="form-group col-md-4">
                                    <label for="province_id" class="form-label">İl</label>
                                    <input type="text" name="province_name" id="funeral_province_name"
                                        class="form-control" placeholder="İl">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="district_id" class="form-label">İlçe</label>
                                    <input type="text" name="district_name" id="funeral_district_name"
                                        class="form-control" placeholder="İlçe">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="neighborhood_id" class="form-label">Mahalle</label>
                                    <input type="text" name="neighborhood_name" id="funeral_neighborhood_name"
                                        class="form-control" placeholder="İl">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="cemetery" class="form-label">Mezarlık</label>
                                <span class="text-danger error d-block"
                                    id="cemeteryError">{{ $errors->first('cemetery') }}</span>
                                <input type="text" name="cemetery" id="cemetery" class="form-control"
                                    placeholder="Mezarlık">
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="first_name" class="form-label">Mevta Adı</label>
                                    <span class="text-danger error d-block"
                                        id="firstNameError">{{ $errors->first('first_name') }}</span>
                                    <input type="text" name="first_name" id="funeral_first_name"
                                        class="form-control" placeholder="Ad">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="last_name" class="form-label">Mevta Soyadı</label>
                                    <span class="text-danger error d-block"
                                        id="lastNameError">{{ $errors->first('last_name') }}</span>
                                    <input type="text" name="last_name" id="funeral_last_name"
                                        class="form-control" placeholder="Soyad">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="gender" class="form-label">Cinsiyet</label>
                                <select name="gender" id="funeral_gender" class="form-select" style="width: 100%">
                                    <option value="Erkek">Erkek</option>
                                    <option value="Kadın">Kadın</option>
                                </select>
                            </div>
                            <div class="form-group" id="funeralMaidenNameContainer">
                                <label for="maiden_name" class="form-label">Kızlık Soyadı</label>
                                <input type="text" name="maiden_name" id="funeral_maiden_name"
                                    class="form-control form-control-solid" placeholder="Kızlık Soyadı"
                                    autocomplete="off" value="{{ old('maiden_name') }}">
                            </div>
                            <div class="form-group">
                                <label for="father_name" class="form-label">Baba Adı</label>
                                <input type="text" name="father_name" id="father_name" class="form-control"
                                    placeholder="Baba Adı">
                            </div>
                            <div class="form-group">
                                <label for="mosque" class="form-label">Cenazenin Kaldırılacağı Camii</label>
                                <span class="text-danger error d-block"
                                    id="mosqueError">{{ $errors->first('mosque') }}</span>
                                <input type="text" name="mosque" id="mosque" class="form-control"
                                    placeholder="Cenazenin Kaldırılacağı Camii">
                            </div>
                            <div class="form-group">
                                <label for="funeral_time" class="form-label">Cenaze Vakti</label>
                                <span class="text-danger error d-block"
                                    id="funeralTimeError">{{ $errors->first('funeral_time') }}</span>
                                <select name="funeral_time" id="funeral_time" class="form-control">
                                    <option value="" selected disabled>Cenaze Vakti Seçiniz</option>
                                    <option value="Öğle namazına müteakip">Öğle namazına müteakip</option>
                                    <option value="İkindi namazına müteakip">İkindi namazına müteakip</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="funeral_hour" class="form-label">Cenaze Saati</label>
                                <span class="text-danger error d-block"
                                    id="funeralHourError">{{ $errors->first('funeral_hour') }}</span>
                                <input type="time" name="funeral_hour" id="funeral_hour" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="funeral_address" class="form-label">Taziye Adresi</label>
                                <input type="text" name="funeral_address" id="funeral_address"
                                    class="form-control" placeholder="Taziye Adresi">
                            </div>
                            <div class="form-group">
                                <label for="date_of_death" class="form-label">Ölüm Tarihi</label>
                                <span class="text-danger error d-block"
                                    id="dateOfDeathError">{{ $errors->first('date_of_death') }}</span>
                                <input type="date" name="date_of_death" id="date_of_death" class="form-control"
                                    placeholder="Ölüm Tarihi"
                                    min="{{ Carbon\Carbon::now()->subDays(3)->format('Y-m-d') }}"
                                    max="{{ Carbon\Carbon::now()->format('Y-m-d') }}">
                            </div>
                            <div class="form-group">
                                <button type="submit" id="submitFuneralNotice"
                                    class="btn btn-success">Kaydet</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" tabindex="-1" id="funeral_detail">
            <div class="modal-dialog mw-900px">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="title"></h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span style="font-size: 1.5em;" aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <strong>İlan Sahibi: </strong>
                        <p class="owner"></p>
                        <strong>Baba Adı: </strong>
                        <p class="fathername"></p>
                        <strong>Mevta Ad Soyad: </strong>
                        <p class="full_name"></p>
                        <strong>Defin Zamanı: </strong>
                        <p class="time"></p>
                        <strong>Camii: </strong>
                        <p class="mosque"></p>
                        <strong>Mezarlık: </strong>
                        <p class="cemetery"></p>
                        <strong>Konum: </strong>
                        <p class="location"></p>
                        <strong>Cenaze Adresi: </strong>
                        <p class="address"></p>
                        <strong>Ölüm Tarihi: </strong>
                        <p class="dateofdeath"></p>
                    </div>

                    <div class="modal-footer">
                        <p class="content" style="font-size: 1.2em;">
                            <span class="funeral_detail_content"></span>
                            {{-- <span class="full_name"></span> vefat etmiştir.
                            Cenazesi

                            <span class="time"></span>

                            <span class="mosque ml-1"></span>'nden alınarak

                            <span class="cemetery"></span>'na defnedilecektir.

                            Allah'tan rahmet ailesi ve yakınlarına
                            başsağlığı dileriz <span class="dateofdeath"></span> --}}
                        </p>
                    </div>

                    <div class="modal-footer">
                        <div class="row">
                            <div class="col-md-4">
                                <a href="http://www.facebook.com/sharer.php?u=https://www.dijitalmezarlik.com.tr"
                                    target="_blank">
                                    <i class="fab fa-facebook"></i>
                                </a>
                            </div>
                            {{-- <div class="col-md-4">
                                <a href="" target="_blank">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            </div> --}}
                            {{-- <div class="col-md-4">
                                <a href="http://twitter.com/share?url=https://www.dijitalmezarlik.com.tr&text=Simple Share Buttons&hashtags=simplesharebuttons"
                                    target="_blank">
                                    <i class="fab fa-twitter"></i>
                                </a>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- slide-bar start -->
    <div class="fix">
        <div class="side-info d-lg-none">
            <button class="side-info-close"><i class="fal fa-times"></i></button>

            <div class="side__logo mb-25">
                <a href="index.html"><img src="{{ $setting ? $setting->dark_logo : '' }}"
                        alt="{{ $setting ? $setting->title : '' }}" /></a>
            </div>

            <div class="mobile-menu"></div>

            <div class="contact-infos mt-30 mb-30">
                <div class="contact-list mb-30">
                    <h4>İletişim</h4>
                    <ul class="p-0">
                        <li><i class="fal fa-map"></i>{{ $contact ? $contact->address : '' }}</li>
                        <li><i class="flaticon-phone-call"></i><a
                                href="tell:+876864764764">{{ $contact ? $contact->phone : '' }}</a></li>
                        <li><i class="flaticon-email-1"></i><a
                                href="https://themepure.net/cdn-cgi/l/email-protection#5a33343c351a2d3f38373b333674393537"><span
                                    class="__cf_email__"
                                    data-cfemail="8ee7e0e8e1cef9ebece3efe7e2a0ede1e3">{{ $contact ? $contact->email : '' }}</span></a>
                        </li>
                    </ul>
                    <div class="sidebar__menu--social">
                        @if ($socialMedia)
                            @if ($socialMedia->facebook)
                                <a href="{{ $socialMedia ? $socialMedia->facebook : '' }}" target="_blank"><i
                                        class="fab fa-facebook-f"></i></a>
                            @endif
                            @if ($socialMedia->twitter)
                                <a href="{{ $socialMedia ? $socialMedia->twitter : '' }}" target="_blank"><i
                                        class="fab fa-twitter"></i></a>
                            @endif
                            @if ($socialMedia->instagram)
                                <a href="{{ $socialMedia ? $socialMedia->instagram : '' }}" target="_blank"><i
                                        class="fab fa-instagram"></i></a>
                            @endif
                            @if ($socialMedia->youtube)
                                <a href="{{ $socialMedia ? $socialMedia->youtube : '' }}" target="_blank"><i
                                        class="fab fa-youtube"></i></a>
                            @endif
                        @endif
                    </div>
                </div>
            </div>

        </div>

        <div class="side-info d-none d-lg-block text-center">
            <button class="side-info-close"><i class="fal fa-times"></i></button>

            <div class="side__logo mb-25">
                <a href="{{ route('home') }}"><img src="{{ $setting ? $setting->dark_logo : '' }}"
                        style="width: 285px" alt="{{ $setting ? $setting->title : '' }}" /></a>
            </div>

            <div class="info-text mb-30" style="font-size: 14px;">
                <p>{!! $aboutApp ? Str::limit($aboutApp->content, 1890) : '' !!}</p>
            </div>
            <div class="row side-row">
                @if ($aboutApp)
                    @foreach (json_decode($aboutApp->images) as $image)
                        <div class="col-4 mb-15">
                            <a class="popup-image" href="{{ asset('upload/aboutapp/' . $image) }}"><img
                                    alt="#" src="{{ asset('upload/aboutapp/' . $image) }}"></a>
                        </div>
                    @break

                    ($loop->iteration >= 6)
                @endforeach
            @endif
        </div>

        <div class="contact-infos mt-30 mb-30">
            <div class="contact-list mb-30">
                <div class="sidebar__menu--social">
                    @if ($socialMedia)
                        @if ($socialMedia->facebook)
                            <a href="{{ $socialMedia ? $socialMedia->facebook : '' }}" target="_blank"><i
                                    class="fab fa-facebook-f"></i></a>
                        @endif
                        @if ($socialMedia->twitter)
                            <a href="{{ $socialMedia ? $socialMedia->twitter : '' }}" target="_blank"><i
                                    class="fab fa-twitter"></i></a>
                        @endif
                        @if ($socialMedia->instagram)
                            <a href="{{ $socialMedia ? $socialMedia->instagram : '' }}" target="_blank"><i
                                    class="fab fa-instagram"></i></a>
                        @endif
                        @if ($socialMedia->youtube)
                            <a href="{{ $socialMedia ? $socialMedia->youtube : '' }}" target="_blank"><i
                                    class="fab fa-youtube"></i></a>
                        @endif
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>
<div class="offcanvas-overlay"></div>
<!-- slide-bar end -->
@yield('content')
<!-- back to top start -->
<div class="progress-wrap">
    <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
        <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
    </svg>
</div>
<!-- back to top end -->
<footer class="footer-area footer-1">
    <div class="container-fluid px-0">
        <div class="row no-gutters">
            <div class="col-xl-3 col-md-12">
                <div class="footer-widget f-w-space widget-spacing about-widget">
                    <div class="footer-logo">
                        <a href="{{ route('home') }}">
                            <img src="{{ $setting ? $setting->white_logo : '' }}"
                                alt="{{ $setting ? $setting->title : '' }}">
                        </a>
                    </div>
                    <span style="font-size: 14px;">
                        {!! $aboutApp ? Str::limit($aboutApp->content, 610) : '' !!}
                    </span>
                    @if ($aboutApp)
                        <span style="float:left; font-size: 14px;">
                            <a href="{{ route('home.about-app') }}">Devamını Oku</a>
                        </span>
                    @endif
                    <div class="social-logo">
                        @if ($socialMedia)
                            @if ($socialMedia->facebook)
                                <a href="{{ $socialMedia ? $socialMedia->facebook : '' }}"
                                    style="background-color: rgb(59, 89, 152); width: 50px; height: 50px; line-height: 50px;"><i
                                        class="fab fa-facebook-f"></i></a>
                            @endif
                            @if ($socialMedia->twitter)
                                <a href="{{ $socialMedia ? $socialMedia->twitter : '' }}"
                                    style="background-color: rgb(29, 161, 242); width: 50px; height: 50px; line-height: 50px;"><i
                                        class="fab fa-twitter"></i></a>
                            @endif
                            @if ($socialMedia->instagram)
                                <a href="{{ $socialMedia ? $socialMedia->instagram : '' }}"
                                    style="background: #7239EA; width: 50px; height: 50px; line-height: 50px;"><i
                                        class="fab fa-instagram"></i></a>
                            @endif
                            @if ($socialMedia->youtube)
                                <a href="{{ $socialMedia ? $socialMedia->youtube : '' }}"
                                    style="background: red; width: 50px; height: 50px; line-height: 50px;"><i
                                        class="fab fa-youtube"></i></a>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="footer-widget-wrap position-relative">
                    <div class="row no-gutters">
                        <div class="col-xl-6 col-md-6">
                            <div class="footer-widget widget-spacing menu-widget">
                                <h3 class="widget-title widget-title-1 border-0 mb-0">
                                    Hızlı Bağlantılar
                                </h3>
                                <ul>
                                    <li><a href="{{ route('home.products') }}">Ürünler</a></li>
                                    <li><a href="{{ route('home.prayers') }}">Dualar</a></li>
                                    <li><a href="{{ route('home.cemeteries.index') }}">Mezarlıklar</a></li>
                                    <li><a href="{{ route('home.deceased') }}">Vefat Edenler</a></li>
                                    <li><a href="{{ route('home.contact') }}">İletişim</a></li>
                                    <li><a href="{{ route('login') }}">Giriş Yap</a></li>
                                    <li><a href="{{ route('register') }}">Üye Ol</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-6">
                            <div class="footer-widget widget-spacing menu-widget-2">
                                <h3 class="widget-title border-0 mb-0">
                                    Sayfalar
                                </h3>
                                <ul>
                                    <li><a href="{{ route('home.cemetery-service') }}">Mezarlık Hizmetleri</a>
                                    </li>
                                    <li><a href="{{ route('home.cemetery-etiquette') }}">Mezarlık Adabı</a></li>
                                    <li><a href="{{ route('home.burial-procedures') }}">Defin İşlemleri</a></li>
                                    <li><a href="{{ route('home.funeral-notices') }}">Cenaze İlanları</a></li>
                                    <li><a href="{{ route('home.about-app') }}">Uygulama Hakkında</a></li>
                                    <li><a href="{{ route('home.cookie-policy') }}">Çerez Politikası</a></li>
                                    <li><a href="{{ route('home.help') }}">Yardım</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="footer-copyright d-none d-xl-block">
                        <p>Copyright ©️ 2021 - reklamlarim.com - Dijital Reklam Ajansı</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-12">
                <div class="footer-widget f-w-space widget-spacing contact-widget pb-200 pb-xl-0">
                    <h3 class="widget-title border-0  widget-title-1 mb-0">
                        Öneri ve Şikayet
                    </h3>
                    @if ($errors->first('name') || $errors->first('email') || $errors->first('title') || $errors->first('topic'))
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>
                                        {{ $error }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('suggestions-complaints.store') }}" method="post">
                        @csrf
                        <div class="input-wrap">
                            <input type="text" name="name" id="name" placeholder="Ad Soyad giriniz">
                        </div>
                        <div class="input-wrap">
                            <input type="text" name="email" id="email"
                                placeholder="Email adresi giriniz">
                        </div>
                        <div class="input-wrap suggestion_complaint">
                            <select name="title" id="suggestion_complaint"
                                class="suggestion_complaint_select form-control border-0">
                                <option value="" selected disabled>Öneri mi Şikayet mi?</option>
                                <option value=" suggestion">Öneri</option>
                                <option value="complaint">Şikayet</option>
                            </select>
                        </div>
                        <div class="input-wrap">
                            <textarea name="topic" id="topic" placeholder="Konu giriniz"></textarea>
                        </div>
                        <div class="input-wrap">
                            <input type="submit" class="submit-btn" value="Şimdi Gönder">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row no-gutters d-block d-xl-none">
            <div class="col-xl-12">
                <div class="footer-copyright">
                    <p>Copyright ©️ 2021 - reklamlarim.com - Dijital Reklam Ajansı</p>
                </div>
            </div>
        </div>
    </div>
</footer>


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="{{ asset('front/assets/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('front/assets/js/meanmenu.min.js') }}"></script>
<script src="{{ asset('front/assets/js/back-to-top.min.js') }}"></script>
<script src="{{ asset('front/assets/js/popper.min.js') }}"></script>
<script src="{{ asset('front/assets/js/nice-select.min.js') }}"></script>
<script src="{{ asset('front/assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('front/assets/js/slick.min.js') }}"></script>
<script src="{{ asset('front/assets/js/magnafic.popup.min.js') }}"></script>
<script src="{{ asset('front/assets/js/script.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://unpkg.com/vue@3"></script>
<script>
    Vue.createApp({
        data() {
            return {
                show: true,
            }
        }
    }).mount("#app");
    $("#maidenNameContainer").hide()
    $("#gender").change(e => {
        if (e.target.value == 'Kadın') $("#maidenNameContainer").show()
        else $("#maidenNameContainer").hide()
    })

    $("#funeralMaidenNameContainer").hide()
    $("#funeral_gender").change(e => {
        if (e.target.value == 'Kadın') $("#funeralMaidenNameContainer").show()
        else $("#funeralMaidenNameContainer").hide()
    })

    // $("#selectValue");
    $("#noneSelectValue").hide();
    // $("#funeralSelectValue");
    $("#noneFuneralSelectValue").hide();
    // $("#selectCemetery");
    $("#noneSelectCemetery").hide();

    $("#cemeteryIsAvailable").change(e => {
        if (e.target.checked === true) {
            $("#selectCemetery").hide();
            $("#noneSelectCemetery").show();
        }
        if (e.target.checked === false) {
            $("#selectCemetery").show();
            $("#noneSelectCemetery").hide();
        }
    })

    $("#country_id").select2({
        dropdownParent: "#addDead",
    })

    $("#funeral_country_id").select2({
        dropdownParent: "#addFuneral",
    })

    $("#country_id").change(e => {
        if (e.target.value === "190") {
            $("#selectValue").show();
            $("#noneSelectValue").hide();
            $("#selectCemetery").show();
            $("#noneSelectCemetery").hide();
            $("#hasNotCemetery").show()
        } else {
            $("#selectValue").hide();
            $("#noneSelectValue").show();
            $("#selectCemetery").hide();
            $("#noneSelectCemetery").show();
            $("#hasNotCemetery").hide()
        }
    })

    $("#funeral_country_id").change(e => {
        if (e.target.value === "190") {
            $("#funeralSelectValue").show();
            $("#noneFuneralSelectValue").hide();
        } else {
            $("#funeralSelectValue").hide();
            $("#noneFuneralSelectValue").show();
        }
    })

    // $("#addFuneralNotice").submit(function(e) {
    //     e.preventDefault()
    //     const owner = $("#owner").val()
    //     const country_id = $("#funeral_country_id").val()
    //     const province_id = $("#funeral_province_id").val()
    //     const district_id = $("#funeral_district_id").val()
    //     const neighborhood_id = $("#funeral_neighborhood_id").val()
    //     const province_name = $("#funeral_province_name").val()
    //     const district_name = $("#funeral_district_name").val()
    //     const neighborhood_name = $("#funeral_neighborhood_name").val()
    //     const cemetery = $("#cemetery").val()
    //     const first_name = $("#funeral_first_name").val()
    //     const last_name = $("#funeral_last_name").val()
    //     const father_name = $("#father_name").val()
    //     const gender = $("#gender").val()
    //     const maiden_name = $("#maiden_name").val()
    //     const mosque = $("#mosque").val()
    //     const funeral_time = $("#funeral_time").val()
    //     const funeral_hour = $("#funeral_hour").val()
    //     const funeral_address = $("#funeral_address").val()
    //     const date_of_death = $("#date_of_death").val()

    //     const owner_error = $("#ownerError");
    //     const funeral_province_error = $("#funeralProvinceError");
    //     const funeral_district_error = $("#funeralDistrictError");
    //     const funeral_neighborhood_error = $("#funeralNeighborhoodError");
    //     const cemetery_error = $("#cemeteryError");
    //     const first_name_error = $("#firstNameError");
    //     const last_name_error = $("#lastNameError");
    //     const father_name_error = $("#fatherNameError");
    //     const mosque_name_error = $("#mosqueError");
    //     const funeral_time_error = $("#funeralTimeError");
    //     const funeral_hour_error = $("#funeralHourError");
    //     const funeral_address_error = $("#funeralAddressError");
    //     const date_of_death_error = $("#dateOfDeathError");

    //     $.ajax({
    //         type: "POST",
    //         url: "{{ route('home.funeral-notices.store') }}",
    //         data: {
    //             "owner": owner,
    //             "country_id": country_id,
    //             "province_id": province_id,
    //             "district_id": district_id,
    //             "neighborhood_id": neighborhood_id,
    //             "province_name": province_name,
    //             "district_name": district_name,
    //             "neighborhood_name": neighborhood_name,
    //             "cemetery": cemetery,
    //             "first_name": first_name,
    //             "last_name": last_name,
    //             "gender": gender,
    //             "maiden_name": maiden_name,
    //             "father_name": father_name,
    //             "mosque": mosque,
    //             "funeral_time": funeral_time,
    //             "funeral_hour": funeral_hour,
    //             "funeral_address": funeral_address,
    //             "date_of_death": date_of_death,
    //             "_token": "{{ csrf_token() }}",
    //         },
    //         success: data => {
    //             owner_error.text("")
    //             funeral_province_error.text("")
    //             funeral_district_error.text("")
    //             funeral_neighborhood_error.text("")
    //             cemetery_error.text("")
    //             first_name_error.text("")
    //             last_name_error.text("")
    //             mosque_name_error.text("")
    //             funeral_time_error.text("")
    //             funeral_hour_error.text("")
    //             date_of_death_error.text("")
    //             Swal.fire({
    //                 position: 'center',
    //                 icon: 'success',
    //                 text: data.success,
    //                 showConfirmButton: false,
    //                 timer: 1500
    //             })
    //         },
    //         error: error => {
    //             if (error.status == 422) {
    //                 owner_error.text(error.responseJSON.errors.owner)
    //                 funeral_province_error.text(error.responseJSON.errors.province_id)
    //                 funeral_district_error.text(error.responseJSON.errors.district_id)
    //                 funeral_neighborhood_error.text(error.responseJSON.errors.neighborhood_id)
    //                 cemetery_error.text(error.responseJSON.errors.cemetery)
    //                 first_name_error.text(error.responseJSON.errors.first_name)
    //                 last_name_error.text(error.responseJSON.errors.last_name)
    //                 mosque_name_error.text(error.responseJSON.errors.mosque)
    //                 funeral_time_error.text(error.responseJSON.errors.funeral_time)
    //                 funeral_hour_error.text(error.responseJSON.errors.funeral_hour)
    //                 date_of_death_error.text(error.responseJSON.errors.date_of_death)
    //             }
    //         }
    //     });
    // })
    // $("#submitDead").submit(function(e) {
    //     e.preventDefault()
    //     const image = $("#image").val()
    //     const province_id = $("#province_id").val()
    //     const district_id = $("#district_id").val()
    //     const neighborhood_id = $("#neighborhood_id").val()
    //     const cemetery_id = $("#cemetery_id").val()
    //     const cemetery = $("#cemetery").val()
    //     const first_name = $("#first_name").val()
    //     const last_name = $("#last_name").val()
    //     const father_name = $("#father_name").val()
    //     const mother_name = $("#mother_name").val()
    //     const about = $("#about").val()

    //     const imageError = $("#imageError");
    //     const provinceError = $("#provinceError");
    //     const districtError = $("#districtError");
    //     const neighborhoodError = $("#neighborhoodError");
    //     const cemeteryIdError = $("#cemeteryIdError");
    //     const cemeteryError = $("#cemeteryError");
    //     const firstNameError = $("#firstNameError");
    //     const lastNameError = $("#lastNameError");
    //     const fatherNameError = $("#fatherNameError");
    //     const motherNameError = $("#motherNameError");
    //     const aboutError = $("#aboutError");

    //     $.ajax({
    //         type: "POST",
    //         url: "{{ route('home.funeral-notices.store') }}",
    //         data: {
    //             "image": image,
    //             "province_id": province_id,
    //             "district_id": district_id,
    //             "neighborhood_id": neighborhood_id,
    //             "cemetery_id": cemetery_id,
    //             "cemetery": cemetery,
    //             "first_name": first_name,
    //             "last_name": last_name,
    //             "father_name": father_name,
    //             "mother_name": mother_name,
    //             "about": about,
    //             "_token": "{{ csrf_token() }}",
    //         },
    //         success: data => {
    //             imageError.text("")
    //             provinceError.text("")
    //             districtError.text("")
    //             neighborhoodError.text("")
    //             cemeteryIdError.text("")
    //             cemeteryError.text("")
    //             firstNameError.text("")
    //             lastNameError.text("")
    //             fatherNamErrore.text("")
    //             motherNameError.text("")
    //             aboutError.text("")
    //             Swal.fire({
    //                 position: 'center',
    //                 icon: 'success',
    //                 text: data.success,
    //                 showConfirmButton: false,
    //                 timer: 1500
    //             })
    //         },
    //         error: error => {
    //             if (error.status == 422) {
    //                 imageError.text(error.responseJSON.error.image)
    //                 provinceError.text(error.responseJSON.error.province_id)
    //                 districtError.text(error.responseJSON.error.district_id)
    //                 neighborhoodError.text(error.responseJSON.error.neighborhood_id)
    //                 cemeteryIdError.text(error.responseJSON.error.cemetery_id)
    //                 cemeteryError.text(error.responseJSON.error.cemetery)
    //                 firstNameError.text(error.responseJSON.error.first_name)
    //                 lastNameError.text(error.responseJSON.error.last_name)
    //                 fatherNamErrore.text(error.responseJSON.error.father_name)
    //                 motherNameError.text(error.responseJSON.error.mother_name)
    //                 aboutError.text(error.responseJSON.error.about)
    //             }
    //         }
    //     });
    // })


    $('#province_id').select2({
        dropdownParent: "#addDead",
    });
    $('#district_id').select2({
        dropdownParent: "#addDead",
    });
    $('#neighborhood_id').select2({
        dropdownParent: "#addDead",
    });
    $('#cemetery_id').select2({
        dropdownParent: "#addDead",
    });
    $('#organisation_id').select2({
        dropdownParent: "#addDead",
        multiple: true,
        placeholder: "Kurum Seçiniz",
    });

    $('#funeral_province_id').select2({
        dropdownParent: "#addFuneral",
    });
    $('#funeral_district_id').select2({
        dropdownParent: "#addFuneral",
    });
    $('#funeral_neighborhood_id').select2({
        dropdownParent: "#addFuneral",
    });
    $('#job').select2({
        dropdownParent: "#addDead",
    });
    $("#funeral_detail").on("shown.bs.modal", function(event) {
        var button = $(event.relatedTarget)

        var owner = button.data("owner")
        var cemetery = button.data("cemetery")
        var country = button.data("country")
        var province = button.data("province")
        var district = button.data("district")
        var neighborhood = button.data("neighborhood")
        var provinceName = button.data("province_name")
        var districtName = button.data("district_name")
        var neighborhoodName = button.data("neighborhood_name")
        var firstname = button.data("firstname")
        var lastname = button.data("lastname")
        var fathername = button.data("fathername")
        var mosque = button.data("mosque")
        var address = button.data("address")
        var time = button.data("time")
        var dateofdeath = button.data("dateofdeath")
        var fullname = firstname + " " + lastname
        var modal = $(this)

        modal.find(".modal-header .title").html(fullname)
        // modal.find(".modal-footer .content .fathername").html(fathername)
        // modal.find(".modal-footer .content .full_name").html(fullname)
        // modal.find(".modal-footer .content .time").html(time)
        // modal.find(".modal-footer .content .mosque").html(mosque)
        // modal.find(".modal-footer .content .cemetery").html(cemetery)
        // modal.find(".modal-footer .content .dateofdeath").html(dateofdeath)

        modal.find(".modal-footer .funeral_detail_content").html(fullname + " vefat etmiştir. Cenazesi " +
            time +
            " " + mosque + "\n'nden alınarak " + cemetery +
            " defnedilecektir. Allah\n'tan Rahmet ailesi ve yakınlarına başsağlığı dileriz. " + dateofdeath)

        modal.find(".modal-body .owner").html(owner)
        modal.find(".modal-body .fathername").html(fathername)
        modal.find(".modal-body .full_name").html(fullname)
        modal.find(".modal-body .time").html(time)
        modal.find(".modal-body .mosque").html(mosque)
        modal.find(".modal-body .cemetery").html(cemetery)

        if (country == 'Türkiye') {
            modal.find(".modal-body .location").html(country + " " + province + " " + district + " " +
                neighborhood)
        } else {
            modal.find(".modal-body .location").html(country + " " + province_name + " " + district_name + " " +
                neighborhood_name)
        }
        modal.find(".modal-body .dateofdeath").html(dateofdeath)
        modal.find(".modal-body .address").html(address)

        var funeralId = button.data("funeralid");

        $.ajax({
            type: "POST",
            url: "/view-count",
            data: {
                "funeral_id": funeralId,
                "_token": "{{ csrf_token() }}",
            },
        });
    });
    $(document).ready(function() {
        $('#content').summernote();
    });
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
    $(document).ready(function() {
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
                            $("#neighborhood_id")
                                .html(value)
                            // var neighborhoodId = $("#neighborhood_id")
                            //     .val();
                            $.ajax({
                                type: "POST",
                                url: "{{ route('cemeteries') }}",
                                data: {
                                    "province_id": provinceId,
                                    "_token": "{{ csrf_token() }}"
                                },
                                success: function(value) {
                                    $("#cemetery_id").html(
                                        value)
                                }
                            })
                        }
                    })

                }
            })
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
                    // var neighborhoodId = $("#neighborhood_id").val();
                    $.ajax({
                        type: "POST",
                        url: "{{ route('cemeteries') }}",
                        data: {
                            "district_id": districtId,
                            "_token": "{{ csrf_token() }}"
                        },
                        success: function(value) {
                            $("#cemetery_id").html(value)
                        }
                    })
                }
            })
        });
    });
    // $(document).ready(function() {
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
    //                 $("#cemetery_id").html(value)
    //             }
    //         })
    //     });
    // });
    $(document).ready(function() {
        $("#funeral_province_id").change(function() {
            var provinceId = $(this).val();
            $.ajax({
                type: "POST",
                url: "{{ route('districts') }}",
                data: {
                    "province_id": provinceId,
                    "_token": "{{ csrf_token() }}"
                },
                success: function(value) {
                    $("#funeral_district_id").html(value)
                    var districtId = $("#funeral_district_id").val();
                    $.ajax({
                        type: "POST",
                        url: "{{ route('neighborhoods') }}",
                        data: {
                            "district_id": districtId,
                            "_token": "{{ csrf_token() }}"
                        },
                        success: function(value) {
                            $("#funeral_neighborhood_id")
                                .html(value)
                            var neighborhoodId = $("#funeral_neighborhood_id")
                                .val();
                            $.ajax({
                                type: "POST",
                                url: "{{ route('cemeteries') }}",
                                data: {
                                    "neighborhood_id": neighborhoodId,
                                    "_token": "{{ csrf_token() }}"
                                },
                                success: function(value) {
                                    $("#funeral_cemetery_id").html(
                                        value)
                                }
                            })
                        }
                    })

                }
            })
        });
    });
    $(document).ready(function() {
        $("#funeral_district_id").change(function() {
            var districtId = $(this).val();
            $.ajax({
                type: "POST",
                url: "{{ route('neighborhoods') }}",
                data: {
                    "district_id": districtId,
                    "_token": "{{ csrf_token() }}"
                },
                success: function(value) {
                    $("#funeral_neighborhood_id").html(value)
                    var neighborhoodId = $("#funeral_neighborhood_id").val();
                    $.ajax({
                        type: "POST",
                        url: "{{ route('cemeteries') }}",
                        data: {
                            "neighborhood_id": neighborhoodId,
                            "_token": "{{ csrf_token() }}"
                        },
                        success: function(value) {
                            $("#funeral_cemetery_id").html(value)
                        }
                    })
                }
            })
        });
    });
    $(document).ready(function() {
        $("#funeral_neighborhood_id").change(function() {
            var neighborhoodId = $(this).val();
            $.ajax({
                type: "POST",
                url: "{{ route('cemeteries') }}",
                data: {
                    "neighborhood_id": neighborhoodId,
                    "_token": "{{ csrf_token() }}"
                },
                success: function(value) {
                    $("#funeral_cemetery_id").html(value)
                }
            })
        });
    });

    const isMarried = document.querySelector("#is_married")
    const spouseContainer = document.querySelector("#spouse_container")

    spouseContainer.style.display = "none";

    isMarried.addEventListener("change", (e) => {
        if (e.target.value == "1") {
            spouseContainer.style.display = "block";
        } else {
            spouseContainer.style.display = "none";
        }
    })
</script>
@if (session('success'))
    <script>
        Swal.fire({
            position: 'center',
            icon: 'success',
            text: "{{ session('success') }}",
            showConfirmButton: false,
            timer: 1500
        })
    </script>
@endif
@if (session('error'))
    <script>
        Swal.fire({
            position: 'center',
            icon: 'error',
            text: "{{ session('error') }}",
            showConfirmButton: false,
            timer: 1500
        })
    </script>
@endif
@if (
    $errors->first('provine_id') ||
        $errors->first('district_id') ||
        $errors->first('neighborhood_id') ||
        $errors->first('cemetery_id') ||
        $errors->first('cemetery') ||
        $errors->first('first_name') ||
        $errors->first('last_name') ||
        $errors->first('father_name') ||
        $errors->first('mother_name') ||
        $errors->first('content'))
    <script>
        Swal.fire({
            position: 'center',
            icon: 'error',
            text: "Cenaze kayıt işlemi başarısız! Alanlardan biri eksik olabilir.",
            showConfirmButton: false,
            timer: 1500
        })
    </script>
@endif
@if (
    $errors->first('provine_id') ||
        $errors->first('district_id') ||
        $errors->first('neighborhood_id') ||
        $errors->first('cemetery_id') ||
        $errors->first('cemetery') ||
        $errors->first('first_name') ||
        $errors->first('last_name') ||
        $errors->first('father_name') ||
        $errors->first('mosque') ||
        $errors->first('funeral_time') ||
        $errors->first('date_of_death'))
    <script>
        Swal.fire({
            position: 'center',
            icon: 'error',
            text: "Cenaze ilanı gönderilemedi! Alanlardan biri eksik olabilir.",
            showConfirmButton: false,
            timer: 1500
        })
    </script>
@endif

@yield('js')
</body>

</html>
