@extends('front.layout.main')
@section('title', $cemetery->title)
@section('css')
    <style>
        #map {
            max-height: 600px;
        }
    </style>
@endsection
@section('content')
    <main>
        <div class="breadcrumb-area" style="background-image: url({{ $cemetery->image }})" data-overlay="dark" data-opacity="7">
            <div class="container pt-150 pb-150 position-relative">
                <div class="row justify-content-center">
                    <div class="col-xl-12">
                        <div class="breadcrumb-title">
                            <span class="sub-title">{{ $contact ? $contact->title : '' }}</span>
                            <h3 class="display-4 text-white font-weight-bolder">{{ $cemetery->title }}</h3>
                        </div>
                    </div>
                </div>
                <div class="breadcrumb-nav">
                    <ul>
                        <li><a href="{{ route('home') }}">Anasayfa</a></li>
                        <li class="active">{{ $cemetery->title }}</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- map-listing area start -->
        <div class="map-listing-area p-rel bg-gray pt-75 pb-70">
            <div class="map-left w-100">
                <div class="map-full-height map-height w-100" id="map">
                    @if ($cemetery->address_map != '')
                        {!! $cemetery->address_map !!}
                    @endif
                </div>
            </div>
            <div class="pl-80 pr-80 map-plr">
                <div class="row">
                    <div class="col-xl-6 offset-xl-6">
                        <div class="m-c-padding">
                            <div class="sidebar-widget pb-17">
                                <div class="contact-filter">
                                    <h4 class="widget-title">
                                        @foreach (explode(' ', $cemetery->title) as $title)
                                            {{ Str::ucfirst(Str::lower($title)) }}
                                        @endforeach
                                    </h4>
                                    <div class="news-meta mb-25">
                                        <span><i class="fal fa-bed"></i> {{ $cemetery->deceased->count() }} mevta
                                            sayısı</span>
                                        <span><i class="fal fa-location-arrow"></i>
                                            {{ $cemetery->province->name . ' ' . $cemetery->district->name . ' ' . $cemetery->neighborhood->name }}</span>
                                        @if ($cemetery->visiting_hours)
                                            <span><i class="fal fa-clock"></i>{{ $cemetery->visiting_hours }}</span>
                                        @endif
                                        @if ($cemetery->phone)
                                            <span><i class="fal fa-phone"></i>{{ $cemetery->phone }}</span>
                                        @endif
                                        <span><i class="fal fa-map-marker-alt"></i>{{ $cemetery->address }}</span>
                                    </div>
                                    {!! $cemetery->content !!}
                                </div>
                                <!-- /. contact filter -->
                            </div>
                            <!-- /. search-result -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- map-listing area end -->
    </main>
@endsection
@section('js')

@endsection
