@extends('front.layout.main')
@section('title', 'Cenaze İlanları')
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
                            <h3 class="display-4 text-white font-weight-bolder">Cenaze İlanları</h3>
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
                                        <span> {{ $funerals->total() }} kayıttan
                                            {{ $funerals->firstItem() }} ile {{ $funerals->lastItem() }} arası
                                            gösteriliyor</span>
                                    </div>
                                    <div class="col-md-3">
                                        <form method="get">
                                            <div class="input-group"
                                                style="padding: 12px 30px 0 30px; border-radius: 10px; background: #F4F4F4; height: 65px; ">
                                                <div class="input-group-append">
                                                    <i class="fas fa-search" style="padding-top: 12px;"></i>
                                                </div>
                                                <input type="date" name="olum_tarihi" id="olum_tarihi"
                                                    class="form-control border-0 bg-transparent" style="outline: none;"
                                                    onchange="this.form.submit()">
                                                @if (request()->get('olum_tarihi'))
                                                    <a href="" class="text-secondary" style="padding: 10px 10px 0 0">
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
                                            @foreach ($funerals as $funeral)
                                                <div class="col-xl-4 col-md-6 custom-col">
                                                    <div class="featured-wrap-3 mb-30 mb-30">
                                                        <div class="row">
                                                            <div class="col-md-4 pl-5"
                                                                style="display:flex; flex-direction:column; justify-content:center; text-align:center;">
                                                                <span
                                                                    style="font-size: 24px;">{{ $funeral->date_of_death->format('d') }}</span>
                                                                <span>{{ Str::limit($funeral->date_of_death->translatedFormat('l'), 3, '') .' ' .$funeral->date_of_death->format('Y') }}</span>
                                                                </span>
                                                            </div>

                                                            <div class="content content-update col-md-8">
                                                                <div class="author-info author-info-2">
                                                                    <div class="text">
                                                                        <h5>
                                                                            <a href="#" data-toggle="modal"
                                                                                data-target="#funeral_detail"
                                                                                data-funeralid="{{ $funeral->id }}"
                                                                                data-views="{{ $funeral->views }}"
                                                                                data-cemetery="{{ $funeral->cemetery }}"
                                                                                data-province="{{ $funeral->province->name ?? '' }}"
                                                                                data-district="{{ $funeral->district->name ?? '' }}"
                                                                                data-neighborhood="{{ $funeral->neighborhood->name ?? '' }}"
                                                                                data-firstname="{{ $funeral->first_name }}"
                                                                                data-lastname="{{ $funeral->last_name }}"
                                                                                data-fathername="{{ $funeral->father_name }}"
                                                                                data-mosque="{{ $funeral->mosque }}"
                                                                                data-address="{{ $funeral->funeral_address }}"
                                                                                data-time="{{ $funeral->funeral_time }}"
                                                                                data-dateofdeath="{{ $funeral->date_of_death->format('d.m.Y') }}">{{ $funeral->first_name . ' ' . $funeral->last_name }}</a>
                                                                        </h5>
                                                                    </div>
                                                                </div>
                                                                <div class="extra-info extra-info-update">
                                                                    <span>
                                                                        {{ $funeral->first_name . ' ' . $funeral->last_name . ' vefat etmiştir.' }}
                                                                    </span>
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
                                                    {{ $funerals->links('vendor.pagination.custom') }}
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
