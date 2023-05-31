@extends('front.layout.main')
@section('title', 'Anasayfa')
@section('css')
    <style>
        .newsletter-video {
            width: 46.2%;
            height: 574px;
        }

        .newsletter-video img {
            width: 100%;
            height: 100%;
        }
    </style>
@endsection
@section('content')
    <main>
        <div class="hero-area f-header-space fix pt-232 pb-155  pt-md-100 pb-md-100 pt-xs-100 pb-md-100">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-text mb-50">
                            <span class="sub-title"></span>
                            <h3 class="title">Dijital Cenaze</h3>
                            <h4 class="animated-title">
                                Bilgi
                                <span>
                                    Sistemi
                                    <svg xmlns="http://www.w3.org/2000/svg" width="316px" height="32px">
                                        <path fill-rule="evenodd" stroke="rgb(67, 130, 79)" stroke-width="4px"
                                            stroke-linecap="butt" stroke-linejoin="miter" fill="none"
                                            d="M2.000,24.000 C2.000,24.000 225.929,-3.528 350.000,3.000 " />
                                    </svg>
                                </span>
                            </h4>
                        </div>
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="filter-area filter-padding mb-23">
                                    <form action="{{ route('home.deceased') }}" method="get">
                                        <div class="filter-form-wrap">
                                            <div class="form-left">
                                                <div class="input-wrap wrap-custom">
                                                    <div class="wrap-inner has-wrap-padding">
                                                        <label for="full_name">Ad Soyad <i
                                                                class="far fa-angle-down"></i></label>
                                                        <input type="text" name="ad_soyad" id="full_name"
                                                            placeholder="Mevta" style="width: 125px;">
                                                    </div>
                                                </div>
                                                <div class="input-wrap wrap-custom">
                                                    <div class="wrap-inner has-wrap-padding">
                                                        <label for="search_province_id">İl <i
                                                                class="far fa-angle-down"></i></label>
                                                        <select id="search_province_id" name="il" class="form-control"
                                                            style="width: 125px !important;">
                                                            <option value="" selected disabled>Tüm İller</option>
                                                            @foreach ($selectboxProvinces as $province)
                                                                <option value="{{ $province->id }}">
                                                                    {{ $province->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="input-wrap wrap-custom">
                                                    <div class="wrap-inner has-wrap-padding">
                                                        <label for="search_district_id">İlçe <i
                                                                class="far fa-angle-down"></i></label>
                                                        <select id="search_district_id" name="ilce" class="form-control"
                                                            style="width: 125px !important;">
                                                            <option value="" selected disabled>Tüm İlçeler</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="input-wrap wrap-custom">
                                                    <div class="wrap-inner has-wrap-padding">
                                                        <label for="search_neighborhood_id">Mahalle <i
                                                                class="far fa-angle-down"></i></label>
                                                        <select id="search_neighborhood_id" name="mahalle"
                                                            class="form-control" style="width: 125px !important;">
                                                            <option value="" selected disabled>Tüm Mahalleler</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="input-wrap wrap-custom">
                                                    <div class="wrap-inner has-wrap-padding">
                                                        <label for="search_cemetery_id">Mezarlık <i
                                                                class="far fa-angle-down"></i></label>
                                                        <select id="search_cemetery_id" name="mezarlik" class="form-control"
                                                            style="width: 125px !important;">
                                                            <option value="" selected disabled>Tüm Mezarlıklar
                                                            </option>
                                                            @foreach ($selectboxCemeteries as $cemetery)
                                                                <option value="{{ $cemetery->id }}">
                                                                    {{ $cemetery->title }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="input-wrap wrap-custom">
                                                    <div class="wrap-inner has-wrap-padding">
                                                        <label for="search_organisation_id">Kurum <i
                                                                class="far fa-angle-down"></i></label>
                                                        <select id="search_organisation_id" name="kurum"
                                                            class="form-control" style="width: 125px !important;">
                                                            <option value="" selected disabled>Tüm Kurumlar</option>
                                                            @foreach ($selectboxOrganisations as $organisation)
                                                                <option value="{{ $organisation->id }}">
                                                                    {{ $organisation->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-right">
                                                <div class="input-submit">
                                                    <button type="submit" class="submit-btn">
                                                        Şimdi Ara <i class="far fa-search"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hero-thumb-1">
                <div class="relative_box">
                    @foreach ($sliders->slice(0, $sliders->count() / 2) as $slider)
                        <img src="{{ $slider->image }}" class="img1">
                    @endforeach
                </div>
            </div>
            <div class="hero-thumb-2">
                <div class="relative_box">
                    @foreach ($sliders->slice($sliders->count() / 2, $sliders->count()) as $slider)
                        <img src="{{ $slider->image }}" class="img1">
                    @endforeach
                </div>
            </div>
        </div>
        @if ($funeralAddedToday->count() != 0)
            <div class="featured-area pb-70">
                <div class="container">
                    <div class="row mb-45">
                        <div class="col-xl-12 text-center">
                            <div class="section-title">
                                <h3 class="animated-title" style="margin-bottom: 40px;">
                                    Bugünkü
                                    <span>
                                        <a href="" class="">
                                            Cenaze İlanları
                                            <svg xmlns="http://www.w3.org/2000/svg" width="192px" height="22px">
                                                <path fill-rule="evenodd" stroke="rgb(67, 130, 79)" stroke-width="4px"
                                                    stroke-linecap="butt" stroke-linejoin="miter" fill="none"
                                                    d="M2.000,14.000 C2.000,14.000 101.929,-2.529 188.000,4.000 " />
                                            </svg>
                                        </a>
                                    </span>
                                </h3>
                                <a href="{{ route('home.funeral-notices') }}" class="text-muted"
                                    style="font-size: 20px;">Tüm
                                    Cenaze
                                    İlanları</a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @foreach ($funeralAddedToday as $funeral)
                            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                                <div class="featured-wrap mb-30">
                                    <div class="row">
                                        <div class="col-md-4 pl-5"
                                            style="display:flex; flex-direction:column; justify-content:center; text-align:center;">
                                            <span
                                                style="font-size: 24px;">{{ $funeral->date_of_death->format('d') }}</span>
                                            <div class="d-flex">
                                                <span
                                                    class="mr-1">{{ Str::limit($funeral->date_of_death->format('m'), 3, '') }}</span>
                                                <span>{{ $funeral->date_of_death->format('Y') }}</span>
                                            </div>
                                            </span>
                                        </div>
                                        <div class="content f-content col-md-8">
                                            <h4 class="title f-title">
                                                <a href="#" data-toggle="modal" data-target="#funeral_detail"
                                                    data-owner="@foreach (explode(' ', $funeral->owner) as $name) {{ Str::ucfirst(Str::lower($name)) }} @endforeach"
                                                    data-funeralid="{{ $funeral->id }}"
                                                    data-views="{{ $funeral->views }}"
                                                    data-cemetery="{{ $funeral->cemetery }}"
                                                    data-province="{{ $funeral->province->name }}"
                                                    data-district="{{ $funeral->district->name }}"
                                                    data-country="{{ $funeral->country->title }}"
                                                    data-neighborhood="{{ $funeral->neighborhood->name }}"
                                                    data-province_name="{{ $funeral->province_name }}"
                                                    data-district_name="{{ $funeral->district_name }}"
                                                    data-neighborhood_name="{{ $funeral->neighborhood_name }}"
                                                    data-firstname="{{ Str::ucfirst(Str::lower($funeral->first_name)) }}"
                                                    data-lastname="{{ Str::ucfirst(Str::lower($funeral->last_name)) }}"
                                                    data-fathername="@foreach (explode(' ', $funeral->father_name) as $name) {{ Str::ucfirst(Str::lower($name)) }} @endforeach"
                                                    data-mosque="{{ $funeral->mosque }}"
                                                    data-address="{{ $funeral->funeral_address }}"
                                                    data-time="{{ $funeral->funeral_time }}"
                                                    data-dateofdeath="{{ $funeral->date_of_death }}">{{ $funeral->first_name . ' ' . $funeral->last_name }}</a>
                                            </h4>
                                            <div class=" extra-info f-extra-info">
                                                <span>{{ $funeral->first_name . ' ' . $funeral->last_name . ' vefat etmiştir' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
        <div class="categories-area">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="categories-slider row">
                            @foreach ($provinces->slice(0, $provinces->count() / 2) as $province)
                                @if ($province->dead->count() > 0)
                                    <div class="category-slide">
                                        <div class="category-wrap f-cat-wrap custom-cat-wrap mb-30">
                                            <div class="content">
                                                <h5>{{ $province->name }}</h5>
                                                <a href="{{ route('home.deceased', ['il' => $province->id]) }}"
                                                    class="more-btn">
                                                    <span>{{ $province->dead->count() }}</span>
                                                    <i class="far fa-arrow-right"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="categories-area pb-80">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="categories-slider row">
                            @foreach ($provinces->slice($provinces->count() / 2, $provinces->count()) as $province)
                                @if ($province->dead->count() > 0)
                                    <div class="category-slide">
                                        <div class="category-wrap f-cat-wrap custom-cat-wrap mb-30">
                                            <div class="content">
                                                <h5>{{ $province->name }}</h5>
                                                <a href="{{ route('home.deceased', ['il' => $province->id]) }}"
                                                    class="more-btn">
                                                    <span>{{ $province->dead->count() }}</span>
                                                    <i class="far fa-arrow-right"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="categories-area pb-80">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="section-title text-center">
                            <h3 class="animated-title">
                                <span>
                                    İstatistikler
                                    <svg xmlns="http://www.w3.org/2000/svg" width="192px" height="22px">
                                        <path fill-rule="evenodd" stroke="rgb(67, 130, 79)" stroke-width="4px"
                                            stroke-linecap="butt" stroke-linejoin="miter" fill="none"
                                            d="M2.000,14.000 C2.000,14.000 101.929,-2.529 188.000,4.000 " />
                                    </svg>
                                </span>
                            </h3>
                        </div>
                        <div class="categories-slider row">
                            <div class="category-slide">
                                <div class="category-wrap f-cat-wrap custom-cat-wrap mb-30">
                                    <div class="content">
                                        <h5>Toplam Mevta</h5>
                                        <span class="more-btn">{{ $totalDeceased }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="category-slide">
                                <div class="category-wrap f-cat-wrap custom-cat-wrap mb-30">
                                    <div class="content">
                                        <h5>Toplam Mezarlık</h5>
                                        <span class="more-btn">{{ $totalCemetery }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="category-slide">
                                <div class="category-wrap f-cat-wrap custom-cat-wrap mb-30">
                                    <div class="content">
                                        <h5>Toplam Türbe</h5>
                                        <span class="more-btn">{{ $totalTomb }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="category-slide">
                                <div class="category-wrap f-cat-wrap custom-cat-wrap mb-30">
                                    <div class="content">
                                        <h5>Toplam Şehitlik</h5>
                                        <span class="more-btn">{{ $totalMartyrdom }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="category-slide">
                                <div class="category-wrap f-cat-wrap custom-cat-wrap mb-30">
                                    <div class="content">
                                        <h5>Toplam Anıt</h5>
                                        <span class="more-btn">{{ $totalMonument }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if ($cemeteries->count() != 0)
            <div class="featured-area pb-70">
                <div class="container">
                    <div class="row mb-45">
                        <div class="col-xl-12 text-center">
                            <div class="section-title">
                                <h3 class="animated-title">
                                    En Son Eklenen
                                    <span>
                                        Mezarlıklar
                                        <svg xmlns="http://www.w3.org/2000/svg" width="192px" height="22px">
                                            <path fill-rule="evenodd" stroke="rgb(67, 130, 79)" stroke-width="4px"
                                                stroke-linecap="butt" stroke-linejoin="miter" fill="none"
                                                d="M2.000,14.000 C2.000,14.000 101.929,-2.529 188.000,4.000 " />
                                        </svg>
                                    </span>
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @foreach ($cemeteries as $cemetery)
                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                                <div class="featured-wrap mb-30">
                                    @if ($cemetery->image)
                                        <div class="thumb" style="height: 200px;">
                                            <img src="{{ $cemetery->image }}" alt="{{ $cemetery->title }}"
                                                style="height: 100%; width: 100%;">
                                        </div>
                                    @endif
                                    <div class="content f-content">
                                        <div class="icon">
                                            <i class="fas fa-quran"></i>
                                        </div>
                                        <h4 class="title f-title">
                                            <a
                                                href="{{ route('home.cemeteries.show', $cemetery->slug) }}">{{ $cemetery->title }}</a>
                                        </h4>
                                        <div class="extra-info f-extra-info">
                                            <span><i class="fal fa-map-marker-alt"></i>
                                                {{ ($cemetery->province ? $cemetery->province->name : '') . ' ' . ($cemetery->district ? $cemetery->district->name : '') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
        {{-- @if ($whoDiedToday->count() != 0)
            <div class="featured-area pb-70">
                <div class="container">
                    <div class="row mb-45">
                        <div class="col-xl-12 text-center">
                            <div class="section-title">
                                <h3 class="animated-title">
                                    Bugün
                                    <span>
                                        Vefat Edenler
                                        <svg xmlns="http://www.w3.org/2000/svg" width="192px" height="22px">
                                            <path fill-rule="evenodd" stroke="rgb(67, 130, 79)" stroke-width="4px"
                                                stroke-linecap="butt" stroke-linejoin="miter" fill="none"
                                                d="M2.000,14.000 C2.000,14.000 101.929,-2.529 188.000,4.000 " />
                                        </svg>
                                    </span>
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @foreach ($whoDiedToday as $dead)
                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                                <div class="featured-wrap mb-30">
                                    <div class="content f-content">
                                        <h4 class="title f-title">
                                            <a
                                                href="{{ route('deceased.show', $dead->id) }}">{{ $dead->full_name }}</a>
                                        </h4>
                                        <div class="extra-info f-extra-info">
                                            <span><i class="fal fa-map-marker-alt"></i>
                                                {{ $dead->province->name . ' ' . ($dead->district ? $dead->district->name : '') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif --}}
        <div class="newsletter-area pt-120 pb-120">
            <div class="container">
                <div class="row justify-content-xl-end">
                    <div class="col-xl-6 col-lg-10">
                        <div class="section-title newsletter-content">
                            <h3 class="animated-title">
                                Uygulama Hakkında
                                <span>
                                    {{ $aboutApp ? $aboutApp->title : '' }}
                                    <svg xmlns="http://www.w3.org/2000/svg" width="303px" height="33px">
                                        <path fill-rule="evenodd" stroke="rgb(67, 130, 79)" stroke-width="4px"
                                            stroke-linecap="butt" stroke-linejoin="miter" fill="none"
                                            d="M2.000,25.000 C2.000,25.000 212.929,-3.528 299.000,3.000 " />
                                    </svg>
                                </span>
                            </h3>
                            <span style="font-size:14px;">
                                {!! $aboutApp ? Str::limit($aboutApp->content, 950) : '' !!}
                            </span>
                            <span style="float:left; font-size: 14px;">
                                <a href="{{ route('home.about-app') }}">Devamını Oku</a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="newsletter-video">
                @if ($aboutApp->video_image !== null)
                    <img src="{{ $aboutApp->video_image }}">
                    <a href="{{ $aboutApp->video }}" class="play-btn popup-video"><i class="fas fa-play"></i></a>
                @else
                    <span></span>
                @endif
            </div>
        </div>
        <div class="how-work-area pt-100 pb-120">
            <div class="container">
                <div class="row mb-30">
                    <div class="col-xl-12 text-center">
                        <div class="section-title">
                            <h3 class="animated-title">
                                İstatistikler
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 mb-5">
                        <!--begin::Charts Widget 2-->
                        <div class="card card-xl-stretch mb-xl-8">
                            <div class="card-header">
                                <h4 class="card-title">Yıllık Vefat İstatistiği</h4>
                            </div>
                            <div class="card-body">
                                <div id="chart3"></div>
                            </div>
                        </div>
                        <!--end::Charts Widget 2-->
                    </div>
                    <div class="col-lg-6">
                        <!--begin::Charts Widget 1-->
                        <div class="card card-xl-stretch mb-xl-8">
                            <div class="card-header">
                                <h4 class="card-title">Aylık Vefat İstatistiği</h4>
                            </div>
                            <div class="card-body">
                                <div id="chart2"></div>
                            </div>
                        </div>
                        <!--end::Charts Widget 1-->
                    </div>

                    <div class="col-lg-6">
                        <!--begin::Row-->
                        <div class="row g-5 g-xl-8" style="margin-bottom: 27px;">
                            <div class="col-lg-6">
                                <!--begin: Statistics Widget 6-->
                                <div class="card bg-light-success card-xl-stretch mb-xl-8">
                                    <!--begin::Body-->
                                    <div class="card-body my-3">
                                        <a href="#"
                                            class="card-title fw-bolder text-success fs-5 mb-3 d-block fs-3">Bugün Vefat
                                            Edenler</a>
                                        <div class="py-1">
                                            <span
                                                class="text-dark fs-1 fw-bolder me-2">{{ $deceasedInfo->whoDiedToday() }}</span>
                                            <span class="fw-bold text-muted fs-6">Kişi</span>
                                        </div>
                                        <div class="progress h-7px bg-success bg-opacity-50 mt-7">
                                            <div class="progress-bar bg-success" role="progressbar"
                                                style="width: {{ $deceasedInfo->whoDiedToday() }}%"
                                                aria-valuenow="{{ $deceasedInfo->whoDiedToday() }}" aria-valuemin="0"
                                                aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <!--end:: Body-->
                                </div>
                                <!--end: Statistics Widget 6-->
                            </div>
                            <div class="col-lg-6">
                                <!--begin: Statistics Widget 6-->
                                <div class="card bg-light-warning card-xl-stretch mb-xl-8">
                                    <!--begin::Body-->
                                    <div class="card-body my-3">
                                        <a href="#"
                                            class="card-title fw-bolder text-warning fs-5 mb-3 d-block fs-3">Dün Vefat
                                            Edenler</a>
                                        <div class="py-1">
                                            <span
                                                class="text-dark fs-1 fw-bolder me-2">{{ $deceasedInfo->thoseWhoDiedYesterday() }}</span>
                                            <span class="fw-bold text-muted fs-6">Kişi</span>
                                        </div>
                                        <div class="progress h-7px bg-warning bg-opacity-50 mt-7">
                                            <div class="progress-bar bg-warning" role="progressbar"
                                                style="width: {{ $deceasedInfo->thoseWhoDiedYesterday() }}%"
                                                aria-valuenow="{{ $deceasedInfo->thoseWhoDiedYesterday() }}"
                                                aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <!--end:: Body-->
                                </div>
                                <!--end: Statistics Widget 6-->
                            </div>
                        </div>
                        <!--end::Row-->
                        <!--begin::Row-->
                        <div class="row g-5 g-xl-8">
                            <div class="col-lg-6">
                                <!--begin: Statistics Widget 6-->
                                <div class="card bg-light-danger card-xl-stretch mb-xl-8">
                                    <!--begin::Body-->
                                    <div class="card-body my-3">
                                        <a href="#"
                                            class="card-title fw-bolder text-danger fs-5 mb-3 d-block fs-3">Bu Ay Vefat
                                            Edenler</a>
                                        <div class="py-1">
                                            <span
                                                class="text-dark fs-1 fw-bolder me-2">{{ $deceasedInfo->whoDiedThisMonth() }}</span>
                                            <span class="fw-bold text-muted fs-6">Kişi</span>
                                        </div>
                                        <div class="progress h-7px bg-danger bg-opacity-50 mt-7">
                                            <div class="progress-bar bg-danger" role="progressbar"
                                                style="width: {{ $deceasedInfo->whoDiedThisMonth() }}%"
                                                aria-valuenow="{{ $deceasedInfo->whoDiedThisMonth() }}" aria-valuemin="0"
                                                aria-valuemax="100">
                                            </div>
                                        </div>
                                    </div>
                                    <!--end:: Body-->
                                </div>
                                <!--end: Statistics Widget 6-->
                            </div>
                            <div class="col-lg-6">
                                <!--begin: Statistics Widget 6-->
                                <div class="card bg-light-info card-xl-stretch mb-xl-8">
                                    <!--begin::Body-->
                                    <div class="card-body my-3">
                                        <a href="#" class="card-title fw-bolder text-info fs-5 mb-3 d-block fs-3">Bu
                                            Yıl Vefat Edenler</a>
                                        <div class="py-1">
                                            <span
                                                class="text-dark fs-1 fw-bolder me-2">{{ $deceasedInfo->whoDiedThisYear() }}
                                            </span>
                                            <span class="fw-bold text-muted fs-6">Kişi</span>
                                        </div>
                                        <div class="progress h-7px bg-info bg-opacity-50 mt-7">
                                            <div class="progress-bar bg-info" role="progressbar"
                                                style="width: {{ $deceasedInfo->whoDiedThisYear() }}%"
                                                aria-valuenow="{{ $deceasedInfo->whoDiedThisYear() }}" aria-valuemin="0"
                                                aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <!--end:: Body-->
                                </div>
                                <!--end: Statistics Widget 6-->
                            </div>
                        </div>
                        <!--end::Row-->
                    </div>
                </div>
            </div>
        </div>
        <div class="how-work-area pt-100 pb-120">
            @if ($appFeatures->count() != 0)
                <div class="container">
                    <div class="row mb-30">
                        <div class="col-xl-12 text-center">
                            <div class="section-title">
                                <h3 class="animated-title">
                                    Uygulama
                                    <span>
                                        Özellikleri
                                        <svg xmlns="http://www.w3.org/2000/svg" width="178px" height="22px">
                                            <path fill-rule="evenodd" stroke="rgb(67, 130, 79)" stroke-width="4px"
                                                stroke-linecap="butt" stroke-linejoin="miter" fill="none"
                                                d="M2.000,14.000 C2.000,14.000 87.929,-2.528 174.000,4.000 " />
                                        </svg>
                                    </span>
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @foreach ($appFeatures as $appFeature)
                            <div class="col-xl-4 col-lg-4 col-md-6">
                                <div class="work-wrap mb-30">
                                    <div class="icon">
                                        <img width="80" src="{{ $appFeature->icon }}"
                                            alt="{{ $appFeature->title }}">
                                        <span class="num">{{ $loop->iteration }}</span>
                                    </div>
                                    <div class="content f-content">
                                        <h4>{{ $appFeature->title }}</h4>
                                        <p>
                                            {{ $appFeature->description }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </main>
@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        $(document).ready(function() {
            $('#search_province_id').select2({
                selectionCssClass: "border-0",
            });
        });
        $(document).ready(function() {
            $('#search_district_id').select2({
                selectionCssClass: "border-0"
            });
        });
        $(document).ready(function() {
            $('#search_neighborhood_id').select2({
                selectionCssClass: "border-0"
            });
        });
        $(document).ready(function() {
            $('#search_cemetery_id').select2({
                selectionCssClass: "border-0"
            });
        });
        $(document).ready(function() {
            $('#search_organisation_id').select2({
                selectionCssClass: "border-0"
            });
        });
        $(document).ready(function() {
            $("#search_province_id").change(function() {
                var provinceId = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "{{ route('homepage-districts') }}",
                    data: {
                        "province_id": provinceId,
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function(value) {
                        $("#search_district_id").html(value)
                    }
                })
            });
        });
        $(document).ready(function() {
            $("#search_province_id").change(function() {
                var provinceId = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "{{ route('homepage-cemeteries') }}",
                    data: {
                        "province_id": provinceId,
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function(value) {
                        $("#search_cemetery_id").html(value)
                    }
                })
            });
        });
        $(document).ready(function() {
            $("#search_district_id").change(function() {
                var districtId = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "{{ route('homepage-neighborhoods') }}",
                    data: {
                        "district_id": districtId,
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function(value) {
                        $("#search_neighborhood_id").html(value)
                    }
                })
            });
        });
        // $(document).ready(function() {
        //     $("#search_neighborhood_id").change(function() {
        //         var neighborhoodId = $(this).val();
        //         $.ajax({
        //             type: "POST",
        //             url: "{{ route('homepage-cemeteries') }}",
        //             data: {
        //                 "neighborhood_id": neighborhoodId,
        //                 "_token": "{{ csrf_token() }}"
        //             },
        //             success: function(value) {
        //                 $("#search_cemetery_id").html(value)
        //             }
        //         })
        //     });
        // });

        var options2 = {
            series: [{
                name: 'Vefat Sayısı',
                data: [
                    {{ $deceasedInfo->thoseWhoDiedInJanuary() }},
                    {{ $deceasedInfo->thoseWhoDiedInFebruary() }},
                    {{ $deceasedInfo->thoseWhoDiedInMarch() }},
                    {{ $deceasedInfo->thoseWhoDiedInApril() }},
                    {{ $deceasedInfo->thoseWhoDiedInMay() }},
                    {{ $deceasedInfo->thoseWhoDiedInJune() }},
                    {{ $deceasedInfo->thoseWhoDiedInJuly() }},
                    {{ $deceasedInfo->thoseWhoDiedInAugust() }},
                    {{ $deceasedInfo->thoseWhoDiedInSeptember() }},
                    {{ $deceasedInfo->thoseWhoDiedInOctober() }},
                    {{ $deceasedInfo->thoseWhoDiedInNovember() }},
                    {{ $deceasedInfo->thoseWhoDiedInDecember() }}
                ]
            }],
            chart: {
                height: 230,
                type: 'bar',
            },
            plotOptions: {
                bar: {
                    columnWidth: '27.5%',
                    dataLabels: {
                        position: 'top', // top, center, bottom
                    },
                }
            },
            dataLabels: {
                enabled: true,
                formatter: function(val) {
                    return val;
                },
                offsetY: -20,
                style: {
                    fontSize: '12px',
                    colors: ["#304758"]
                }
            },

            xaxis: {
                categories: ["Oca", "Şub", "Mar", "Nis", "May", "Haz", "Tem", "Ağu", "Eyl", "Eki", "Kas", "Ara"]
            },
            yaxis: {
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false,
                },
                labels: {
                    show: false,
                    formatter: function(val) {
                        return val;
                    }
                }

            },
        };
        var options3 = {
            series: [{
                name: 'Vefat Sayısı',
                data: [
                    {{ $deceasedInfo->whoDiedInTwoThousandTen() }},
                    {{ $deceasedInfo->whoDiedInTwoThousandEleven() }},
                    {{ $deceasedInfo->whoDiedInTwoThousandTwelve() }},
                    {{ $deceasedInfo->whoDiedInTwoThousandThirteen() }},
                    {{ $deceasedInfo->whoDiedInTwoThousandFourteen() }},
                    {{ $deceasedInfo->whoDiedInTwoThousandFifteen() }},
                    {{ $deceasedInfo->whoDiedInTwoThousandSixteen() }},
                    {{ $deceasedInfo->whoDiedInTwoThousandSeventeen() }},
                    {{ $deceasedInfo->whoDiedInTwoThousandEighteen() }},
                    {{ $deceasedInfo->whoDiedInTwoThousandNineteen() }},
                    {{ $deceasedInfo->whoDiedInTwoThousandTwenty() }},
                    {{ $deceasedInfo->whoDiedInTwoThousandTwentyOne() }}
                ]
            }],
            chart: {
                height: 245,
                type: 'bar',
            },
            plotOptions: {
                bar: {
                    columnWidth: "25%",
                    dataLabels: {
                        position: 'top', // top, center, bottom
                    },
                }
            },
            dataLabels: {
                enabled: true,
                formatter: function(val) {
                    return val;
                },
                offsetY: -20,
                style: {
                    fontSize: '12px',
                    colors: ["#304758"]
                }
            },

            xaxis: {
                categories: ["2011", "2012", "2013", "2014", "2015", "2016", "2017", "2018", "2019", "2020", "2021",
                    "2022"
                ],
            },
            yaxis: {
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false,
                },
                labels: {
                    show: false,
                    formatter: function(val) {
                        return val;
                    }
                }

            },
        };

        var chart2 = new ApexCharts(document.querySelector("#chart2"), options2);
        chart2.render();
        var chart3 = new ApexCharts(document.querySelector("#chart3"), options3);
        chart3.render();
    </script>
@endsection
