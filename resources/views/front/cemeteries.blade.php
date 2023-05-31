@extends('front.layout.main')
@section('title', 'Mezarlıklar')
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
                            <h3 class="display-4 text-white font-weight-bolder">Mezarlıklar</h3>
                        </div>
                    </div>
                </div>
                <div class="breadcrumb-nav">
                    <ul>
                        <li><a href="{{ route('home') }}">Anasayfa</a></li>
                        <li class="active">Mezarlıklar</li>
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
                                        <span>{{ $cemeteries->total() }} kayıttan
                                            {{ $cemeteries->firstItem() }} ile {{ $cemeteries->lastItem() }} arası
                                            gösteriliyor</span>
                                    </div>
                                    <div class="col-md-3">
                                        <form method="get">
                                            <div class="input-group"
                                                style="padding: 12px 30px 0 30px; border-radius: 10px; background: #F4F4F4; height: 65px; ">
                                                <div class="input-group-append">
                                                    <i class="fas fa-search" style="padding-top: 12px;"></i>
                                                </div>
                                                <input type="text" name="cemetery" id="cemetery"
                                                    class="form-control border-0 bg-transparent" style="outline: none;"
                                                    value="{{ request()->get('cemetery') }}" placeholder="Mezarlık Ara...">
                                                @if (request()->get('cemetery'))
                                                    <a href="{{ route('home.cemeteries.index') }}" class="text-secondary"
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
                                            @foreach ($cemeteries as $cemetery)
                                                <div class="col-xl-4 col-md-6 custom-col">
                                                    <div class="featured-wrap-3 mb-30 style-2 mb-30">
                                                        @if ($cemetery->image)
                                                            <div class="thumb" style="height: 200px;">
                                                                <img src="{{ $cemetery->image }}"
                                                                    alt="{{ $cemetery->title }}"
                                                                    style="height: 100%; width: 100%;">
                                                                <span class="rating  rating-2"><i
                                                                        class="fas fa-id-card-alt"></i>
                                                                    {{ $cemetery->deceased->count() }}</span>
                                                            </div>
                                                        @endif
                                                        <div class="content content-update">
                                                            <div class="author-info author-info-2">
                                                                <div class="text">
                                                                    <h5>
                                                                        <a
                                                                            href="{{ route('home.cemeteries.show', $cemetery->slug) }}">
                                                                            @foreach (explode(' ', $cemetery->title) as $title)
                                                                                {{ Str::ucfirst(Str::lower($title)) }}
                                                                            @endforeach
                                                                        </a>
                                                                    </h5>
                                                                </div>
                                                            </div>
                                                            <div class="extra-info extra-info-update">
                                                                <span><i class="fal fa-map-marker-alt"></i>
                                                                    {{ $cemetery->address }}</span>
                                                                @if ($cemetery->phone)
                                                                    <span><i class="fal fa-phone"></i>
                                                                        {{ $cemetery->phone }}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="row">
                                            <div class="col-xl-12">
                                                <div class="f-pagination mb-30 mb-xl-0">
                                                    {{ $cemeteries->links('vendor.pagination.custom') }}
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
