@extends('front.layout.main')
@section('title', 'Yardım')
@section('css')

@endsection
@section('content')
    <main>
        <div class="breadcrumb-area breadcrumb-space mb-100" data-background="{{ $setting ? $setting->pages_image : '' }}"
            data-overlay="dark" data-opacity="7">
            <div class="container pt-150 pb-150 position-relative">
                <div class="row justify-content-center">
                    <div class="col-xl-12">
                        <div class="breadcrumb-title">
                            <span class="sub-title">{{ $contact ? $contact->title : '' }}</span>
                            <h3 class="display-4 text-white font-weight-bolder">Ölüm Sonrası Yapılması Gereken İşlemler</h3>
                        </div>
                    </div>
                </div>
                <div class="breadcrumb-nav">
                    <ul>
                        <li><a href="{{ route('home') }}">Anasayfa</a></li>
                        <li class="active">Yardım</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- faq area start -->
        <div class="faq-area pb-80">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12 col-lg-12">
                        <div class="faq-accordion faq-accordion-2">
                            <div id="accordion">
                                @foreach ($helpQuestions as $help)
                                    <div class="card">
                                        <div class="card-header" id="headingOne">
                                            <h5 class="mb-0">
                                                <button class="btn-link" data-toggle="collapse"
                                                    data-target="#col{{ $help->id }}" aria-expanded="true"
                                                    aria-controls="col{{ $help->id }}">
                                                    {{ $help->title }}
                                                </button>
                                            </h5>
                                        </div>

                                        <div id="col{{ $help->id }}"
                                            class="collapse {{ $loop->first ? 'show' : null }}"
                                            aria-labelledby="headingOne" data-parent="#accordion">
                                            <div class="card-body">
                                                {{ $help->content }}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- faq area end -->
    </main>
@endsection
@section('js')

@endsection
