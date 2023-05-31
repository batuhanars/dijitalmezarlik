@extends('front.layout.main')
@section('title', 'İletişim')
@section('css')
    <style>
        #map iframe {
            height: 650px;
            max-height: 650px;
        }

    </style>
@endsection
@section('content')
    <main>
        <div class="breadcrumb-area breadcrumb-space mb-160" data-background="{{ $setting ? $setting->pages_image : '' }}"
            data-overlay="dark" data-opacity="7">
            <div class="container pt-150 pb-150 position-relative">
                <div class="row justify-content-center">
                    <div class="col-xl-12">
                        <div class="breadcrumb-title">
                            <span class="sub-title">{{ $contact ? $contact->title : '' }}</span>
                            <h3 class="display-4 text-white font-weight-bolder">İletişim</h3>
                        </div>
                    </div>
                </div>
                <div class="breadcrumb-nav">
                    <ul>
                        <li><a href="{{ route('home') }}">Anasayfa</a></li>
                        <li class="active">İletişim</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- address area start -->
        <div class="address-area mb-160">
            <div class="container">
                <div class="row">
                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="single-address mb-130 text-center">
                            <div class="shape">
                                <img src="/front/assets/img/bg/pattern.jpg" alt="">
                            </div>
                            <div class="address-icon">
                                <i class="flaticon-email-1"></i>
                            </div>
                            <div class="address-desc">
                                <h4>
                                    {{ $contact ? $contact->email : '' }}
                                </h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="single-address mb-130 text-center">
                            <div class="shape">
                                <img src="/front/assets/img/bg/pattern.jpg" alt="">
                            </div>
                            <div class="address-icon">
                                <i class="flaticon-phone-call"></i>
                            </div>
                            <div class="address-desc">
                                <h4>{{ $contact ? $contact->phone : '' }}
                                </h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="single-address mb-130 text-center">
                            <div class="shape">
                                <img src="/front/assets/img/bg/pattern.jpg" alt="">
                            </div>
                            <div class="address-icon">
                                <i class="flaticon-location-1"></i>
                            </div>
                            <div class="address-desc">
                                <h4>{{ $contact ? $contact->address : '' }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- address area end -->
        <div class="answare-area pb-160">
            <div class="container">
                <div class="row">
                    <div class="col-xl-123" id="map">
                        {!! $contact ? $contact->address_map : '' !!}
                        <div class="answere-box answere-box-2">
                            <div class="answere-form">
                                <span>Mesajlar</span>
                                <h3>Daha Fazla Mesaj</h3>
                                <form action="{{ route('messages.store') }}" method="post">
                                    @csrf
                                    <div class="row row-20">
                                        <div class="col-xl-6">
                                            <span class="text-danger">{{ $errors->first('name') }}</span>
                                            <div class="input-group mb-20">
                                                <input type="text" name="name" id="name" placeholder="Ad soyad giriniz">
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <span class="text-danger">{{ $errors->first('email') }}</span>
                                            <div class="input-group mb-20">
                                                <input type="email" name="email" id="email"
                                                    placeholder="Email adresi giriniz">
                                            </div>
                                        </div>
                                        <div class="col-xl-12">
                                            <span class="text-danger">{{ $errors->first('phone') }}</span>
                                            <div class="input-group mb-20">
                                                <input type="tel" name="phone" id="phone" placeholder="Telefon giriniz">
                                            </div>
                                        </div>
                                        <div class="col-xl-12">
                                            <span class="text-danger">{{ $errors->first('topic') }}</span>
                                            <div class="input-group mb-20">
                                                <input type="text" name="topic" id="topic" placeholder="Konu giriniz">
                                            </div>
                                        </div>
                                        <div class="col-xl-12">
                                            <span class="text-danger">{{ $errors->first('message') }}</span>
                                            <div class="input-gruop mb-15">
                                                <textarea name="message" id="message" cols="30" rows="10"
                                                    placeholder="Mesaj giriniz"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-xl-12">
                                            <div class="text-centers">
                                                <button type="submit"><i class="fal fa-envelope"></i>Gönder</button>
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
    </main>
@endsection
@section('js')
    <script src="{{ asset('back/assets/plugins/global/plugins.bundle.js') }}"></script>
    <script>
        Inputmask({
            "mask": "(999) 999-9999"
        }).mask("#phone");
    </script>
@endsection
