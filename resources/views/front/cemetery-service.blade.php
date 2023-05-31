@extends('front.layout.main')
@section('title', 'Mezarlık Hizmetleri')
@section('css')

@endsection
@section('content')
    <main>
        <div class="breadcrumb-area" data-background="{{ $setting ? $setting->pages_image : '' }}" data-overlay="dark"
            data-opacity="7">
            <div class="container pt-150 pb-150 position-relative">
                <div class="row justify-content-center">
                    <div class="col-xl-12">
                        <div class="breadcrumb-title">
                            <span class="sub-title">{{ $contact ? $contact->title : '' }}</span>
                            <h3 class="display-4 text-white font-weight-bolder">Mezarlık Hizmetleri</h3>
                        </div>
                    </div>
                </div>
                <div class="breadcrumb-nav">
                    <ul>
                        <li><a href="{{ route('home') }}">Anasayfa</a></li>
                        <li class="active">Mezarlık Hizmetleri</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- map-listing area start -->
        <div class="map-listing-area-2 p-rel bg-gray pt-75 pb-70">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="m-c-padding">
                        </div>
                        <div class="search-result">
                            <!-- /. search result top -->
                            <div class="search-result-bottom">
                                <div class="row mb-30">
                                    <div class="search-result-top  d-flex align-items-center col-md-9">
                                        <span>{{ $cemeteryServices->total() }} kayıttan
                                            {{ $cemeteryServices->firstItem() }} ile
                                            {{ $cemeteryServices->lastItem() }} arası
                                            gösteriliyor</span>
                                    </div>
                                    <div class="col-md-3">
                                        <form method="get">
                                            <div class="input-group"
                                                style="padding: 12px 30px 0 30px; border-radius: 10px; background: #F4F4F4; height: 65px; ">
                                                <div class="input-group-append">
                                                    <i class="fas fa-search" style="padding-top: 12px;"></i>
                                                </div>
                                                <input type="text" name="hizmet" id="cemetery-service"
                                                    class="form-control border-0 bg-transparent" style="outline: none;"
                                                    value="{{ request()->get('hizmet') }}" placeholder="Hizmet Ara...">
                                                @if (request()->get('hizmet'))
                                                    <a href="{{ route('home.cemetery-service') }}" class="text-secondary"
                                                        style="padding: 10px 10px 0 0">
                                                        <i class="fas fa-times"></i>
                                                    </a>
                                                @endif
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="tab-content" id="pills-tabContent">
                                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel">
                                        <div class="row custom-row pb-10">
                                            @foreach ($cemeteryServices as $cemeteryService)
                                                <div class="col-xl-4 col-md-6 custom-col">
                                                    <div class="featured-wrap-3 mb-30 style-2 mb-30">
                                                        <div class="content content-update">
                                                            <div class="author-info author-info-2">
                                                                <div class="text">
                                                                    <h5>
                                                                        <a
                                                                            href="{{ route('home.cemetery-service.show', $cemeteryService->slug) }}">{{ $cemeteryService->title }}</a>
                                                                    </h5>
                                                                    <p>{{ $cemeteryService->short_description }}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="row">
                                            <div class="col-xl-12">
                                                <div class="f-pagination mb-30 mb-xl-0">
                                                    {{ $cemeteryServices->links('vendor.pagination.custom') }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /. search result bottom -->
                        </div>
                        <!-- /. search-result -->
                    </div>
                </div>
            </div>
        </div>
        <!-- map-listing area end -->
    </main>
@endsection
@section('js')

@endsection
