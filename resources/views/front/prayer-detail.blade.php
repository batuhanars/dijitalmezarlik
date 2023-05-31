@extends('front.layout.main')
@section('title', $prayer->title)
@section('css')

@endsection
@section('content')
    {{-- <main>
        <div class="video-area f-video-area pt-150 pb-150 overflow-hidden"
            style="background-image: url({{ $prayer->video_image }})" data-overlay="dark" data-opacity="6">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-6 col-lg-9">
                        <div class="video-content-wrap">
                            <div class="section-title-5 white-title">
                                <h3 class="display-4 text-white font-weight-bolder">{{ $prayer->title }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-3 mt-md-80 mt-xs-80 text-center text-lg-right">
                        <div class="video-btn">
                            <a href="{{ 'https://www.youtube.com/watch?v=' . $prayer->embed_code }}"
                                class="popup-video"><i class="fas fa-play"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="pt-100 pb-80">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-8 col-lg-8">
                        <div class="about-text-wrap f-about-text pt-md-50 mt-xs-50">
                            <div class="section-title-5">
                                {!! $prayer->content !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4">
                        <div class="sidebar-widget-wrapper">
                            <div class="single-widget mb-30">
                                <h4 class="widget-title"><span>//</span> Search by filter</h4>
                                <div class="search-form">
                                    <form action="#">
                                        <div class="form-group">
                                            <input type="text" class="map-input" placeholder="Search with keyword">
                                        </div>
                                        <div class="form-group">
                                            <select name="search-select" id="search-select">
                                                <option value="all">All categories</option>
                                                <option value="all">Education</option>
                                                <option value="all">News</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <div class="map-input">
                                                <input type="text" placeholder="Location">
                                            </div>
                                        </div>
                                        <button class="search-btn">Search Now <i class="fal fa-search"></i></button>
                                    </form>
                                </div>
                            </div>
                            <div class="single-widget widget-pb mb-30">
                                <h4 class="widget-title"><span>//</span> Filter by tags</h4>
                                <div class="tagcloud">
                                    <a href="listings-grid-right-sidebar.html"> Filter by tags</a>
                                    <a href="listings-grid-right-sidebar.html"> Car Rent</a>
                                    <a href="listings-grid-right-sidebar.html">House Cleaning</a>
                                    <a href="listings-grid-right-sidebar.html">Business</a>
                                    <a href="listings-grid-right-sidebar.html">Hotel</a>
                                    <a href="listings-grid-right-sidebar.html">Food</a>
                                    <a href="listings-grid-right-sidebar.html">Cook</a>
                                </div>
                            </div>
                            <div class="single-widget widget-pb mb-30">
                                <h4 class="widget-title"><span>//</span> Around Distance: <span
                                        class="price-count">60</span> <span>km</span></h4>
                                <div class="slider-range">
                                    <div class="cat-title">
                                        <h6>Filter By Price</h6>
                                    </div>
                                    <div id="slider-range"></div>
                                    <p>
                                        <label for="amount">Price :</label>
                                        <input type="text" id="amount" readonly>
                                    </p>
                                </div>
                            </div>
                            <div class="single-widget single-widget-2 mb-30">
                                <div class="price-select">
                                    <select name="price-select" id="price-select">
                                        <option value="#">Price Range</option>
                                        <option>100usd </option>
                                        <option>200usd</option>
                                        <option>100usd</option>
                                        <option>500usd </option>
                                        <option>900usd </option>
                                    </select>
                                </div>
                            </div>
                            <div class="single-widget border-0 p-0">
                                <div class="banner-thumb">
                                    <a href="listings-half-screen-map-grid.html"><img src="assets/img/banner/banner-1.jpg"
                                            class="img-fluid" alt=""></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main> --}}
    <main>
        <div class="video-area f-video-area pt-150 pb-150 overflow-hidden mb-100"
            style="background-image: url({{ $prayer->video_image }})" data-overlay="dark" data-opacity="6">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-6 col-lg-9">
                        <div class="video-content-wrap">
                            <div class="section-title-5 white-title">
                                <h3 class="display-4 text-white font-weight-bolder">{{ $prayer->title }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-3 mt-md-80 mt-xs-80 text-center text-lg-right">
                        <div class="video-btn">
                            <a href="{{ 'https://www.youtube.com/watch?v=' . $prayer->embed_code }}"
                                class="popup-video"><i class="fas fa-play"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- news area start -->
        <div class="news-area pb-100">
            <div class="container">
                <div class="row">
                    <div class="col-xl-8">
                        <div class="single-news-area mb-30 mb-xl-0">
                            <div class="single-news-wrapper">
                                <div class="news-details">
                                    {!! $prayer->content !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="widget-wrapper pl-20">

                            <div class="single-widget padding-list mb-40">
                                <h4 class="widget-title"><span>//</span> Dualar</h4>
                                <div class="widget-list">
                                    @foreach ($prayers as $prayerItem)
                                        @if ($prayerItem->id != $prayer->id)
                                            <a href="{{ route('home.prayers.show', $prayerItem->slug) }}"
                                                class="p-3"><span>{{ $prayerItem->title }}</span></a>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- news area end -->
    </main>
@endsection
@section('js')

@endsection
