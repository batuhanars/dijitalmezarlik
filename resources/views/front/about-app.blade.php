@extends('front.layout.main')
@section('title', 'Uygulama Hakkında')
@section('css')

@endsection
@section('content')
    <main>
        <div class="listing-details-area pb-100">
            <div class="news-slider mb-60">
                @if ($aboutApp)
                    @foreach (json_decode($aboutApp->images) as $image)
                        <div class="news-thumb">
                            <img src="{{ asset('/upload/aboutapp/' . $image) }}" alt="">
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="news-content">
                <div class="container">
                    <div class="news-description">
                        <div class="row">
                            <div class="col-xl-12 col-lg-12">
                                <div class="desc-box  mb-16">
                                    <h1>{{ $aboutApp ? $aboutApp->title : '' }}</h1>
                                    {!! $aboutApp ? $aboutApp->content : '' !!}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </main>
@endsection
@section('js')

@endsection
