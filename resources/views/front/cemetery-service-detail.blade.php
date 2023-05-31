@extends('front.layout.main')
@section('title', $cemeteryService->title)
@section('css')

@endsection
@section('content')
    <main>
        <div class="breadcrumb-area breadcrumb-space mb-100" data-background="{{ $cemeteryService->image }}"
            data-overlay="dark" data-opacity="7">
            <div class="container pt-150 pb-150 position-relative">
                <div class="row justify-content-center">
                    <div class="col-xl-12">
                        <div class="breadcrumb-title">
                            <span class="sub-title">{{ $contact ? $contact->title : '' }}</span>
                            <h3 class="display-4 text-white font-weight-bolder">{{ $cemeteryService->title }}</h3>
                        </div>
                    </div>
                </div>
                <div class="breadcrumb-nav">
                    <ul>
                        <li><a href="{{ route('home') }}">Anasayfa</a></li>
                        <li class="active">{{ $cemeteryService->title }}</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- news area start -->
        <div class="news-area pb-100">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="single-news-area mb-30 mb-xl-0">
                            <div class="single-news-wrapper">
                                <div class="news-details">
                                    <h3 class="s-news-title">{{ $cemeteryService->title }}
                                    </h3>
                                    {!! $cemeteryService->content !!}
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