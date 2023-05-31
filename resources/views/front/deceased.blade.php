@extends('front.layout.main')
@section('title', 'Vefat Edenler')
@section('css')
    <style>
        .sidebar-widget-wrapper .select2-selection,
        .sidebar-widget-wrapper .select2-selection--single {
            height: 65px !important;
            border: 1px solid #CED4DA !important;
            border-radius: 10px !important;
            padding: 16px 30px 0 30px;
        }

        .sidebar-widget-wrapper .select2-selection__arrow {
            margin: 16px 30px 0 30px;
        }
    </style>
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
                            <h3 class="display-4 text-white font-weight-bolder">Vefat Edenler</h3>
                        </div>
                    </div>
                </div>
                <div class="breadcrumb-nav">
                    <ul>
                        <li><a href="{{ route('home') }}">Anasayfa</a></li>
                        <li class="active">Vefat Edenler</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- map-listing area start -->
        <div class="map-listing-area p-rel bg-gray pt-75 pb-70">
            <div class="container">
                <div class="row">
                    <div class="col-xl-8 col-lg-8">
                        <div class="m-c-padding">
                        </div>
                        <div class="search-result">
                            <!-- /. search result top -->
                            <div class="d-flex justify-content-between mb-30 f-search-flex">
                                <div class="search-result-top  d-flex align-items-center">
                                    <span>{{ $deceased->total() }} kayıttan
                                        {{ $deceased->firstItem() }} ile {{ $deceased->lastItem() }} arası
                                        gösteriliyor</span>
                                </div>
                            </div>
                            <div class="search-result-bottom">
                                <div class="tab-content" id="pills-tabContent">
                                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel">
                                        <div class="row">
                                            @foreach ($deceased as $dead)
                                                <div class="col-xl-6 col-lg-6 col-md-6">
                                                    <div class="featured-wrap-3 mb-30 style-2 mb-30">
                                                        <div class="thumb">
                                                            @if ($dead->image)
                                                                <img src="{{ $dead->image }}" alt="{{ $dead->full_name }}"
                                                                    style="height: 250px;">
                                                            @else
                                                                @if ($dead->gender == 'Erkek')
                                                                    <img src="{{ asset('front/assets/img/male.jpg') }}"
                                                                        alt="Resim Yok" style="height: 250px;">
                                                                @else
                                                                    <img src="{{ asset('front/assets/img/female.jpeg') }}"
                                                                        alt="Resim Yok" style="height: 250px;">
                                                                @endif
                                                            @endif
                                                        </div>
                                                        <div class="content">
                                                            <div class="author-info">
                                                                <div class="text">
                                                                    <h5>
                                                                        <a href="{{ route('deceased.show', $dead->id) }}">
                                                                            {{ $dead->full_name }}
                                                                        </a>
                                                                    </h5>
                                                                    @if ($dead->country_id == '190')
                                                                        <p>
                                                                            {{ $dead->cemetery ? $dead->cemetery->title : $dead->cemetery_name }}
                                                                        </p>
                                                                    @else
                                                                        <p>
                                                                            {{ $dead->cemetery_name }}
                                                                        </p>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="extra-info">
                                                                <span><i class="fal fa-map-marker-alt"></i>Ülke:
                                                                    {{ $dead->country ? $dead->country->title : '-' }}</span>
                                                                @if ($dead->country_id == '190')
                                                                    <span><i class="fal fa-map-marker-alt"></i>İl:
                                                                        {{ $dead->province ? $dead->province->name : '' }}</span>
                                                                    <span><i class="fal fa-map-marker-alt"></i>İlçe:
                                                                        {{ $dead->district ? $dead->district->name : '' }}</span>
                                                                    <span><i class="fal fa-map-marker-alt"></i>Mahalle:
                                                                        {{ $dead->neighborhood ? $dead->neighborhood->name : '' }}</span>
                                                                @else
                                                                    <span><i class="fal fa-map-marker-alt"></i>İl:
                                                                        {{ $dead->province_name }}</span>
                                                                    <span><i class="fal fa-map-marker-alt"></i>İlçe:
                                                                        {{ $dead->district_name }}</span>
                                                                    <span><i class="fal fa-map-marker-alt"></i>Mahalle:
                                                                        {{ $dead->neighborhood_name }}</span>
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
                                                    {{ $deceased->links('vendor.pagination.custom') }}
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
                    <div class="col-xl-4 col-lg-4">
                        <div class="sidebar-widget-wrapper">
                            <div class="single-widget mb-30">
                                <h4 class="widget-title"><span>//</span> Filtreye Göre Ara</h4>
                                <form method="get">
                                    <div class="form-group">
                                        <input type="text" name="ad_soyad" id="full_name" class="form-control"
                                            style="height: 65px; border-radius: 10px; padding: 0 30px 0 30px;"
                                            value="{{ request()->get('ad_soyad') }}" placeholder="Ad Soyad">
                                    </div>
                                    <div class="form-group">
                                        <select name="il" id="search_province_id" class="form-control">
                                            <option value="" selected disabled>Tüm İller</option>
                                            @foreach ($selectboxProvinces as $province)
                                                <option @if (request()->get('il') == $province->id) selected @endif
                                                    value="{{ $province->id }}">
                                                    {{ $province->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <select name="ilce" id="search_district_id" class="form-control">
                                            <option value="" selected disabled>Tüm İlçeler</option>
                                            @empty(!$districts)
                                                @foreach ($districts as $district)
                                                    <option @if (request()->get('ilce') == $district->id) selected @endif
                                                        value="{{ $district->id }}">
                                                        {{ $district->name }}</option>
                                                @endforeach
                                            @endempty
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <select name="mahalle" id="search_neighborhood_id" class="form-control">
                                            <option value="" selected disabled>Tüm Mahalleler</option>
                                            @empty(!$neighborhoods)
                                                @foreach ($neighborhoods as $neighborhood)
                                                    <option @if (request()->get('mahalle') == $neighborhood->id) selected @endif
                                                        value="{{ $neighborhood->id }}">
                                                        {{ $neighborhood->name }}</option>
                                                @endforeach
                                            @endempty
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <select name="mezarlik" id="search_cemetery_id" class="form-control">
                                            <option value="" selected disabled>Tüm Mezarlıklar</option>
                                            @empty(!$selectboxCemeteries)
                                                @foreach ($selectboxCemeteries as $cemetery)
                                                    <option @if (request()->get('mezarlik') == $cemetery->id) selected @endif
                                                        value="{{ $cemetery->id }}">
                                                        {{ $cemetery->title }}</option>
                                                @endforeach
                                            @endempty
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <select name="kurum" id="search_organisation_id" class="form-control">
                                            <option value="" selected disabled>Tüm Kurumlar</option>
                                            @foreach ($selectboxOrganisations as $organisation)
                                                <option @if (request()->get('kurum') == $organisation->id) selected @endif
                                                    value="{{ $organisation->id }}">
                                                    {{ $organisation->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="baba_adi" id="father_name" class="form-control"
                                            style="height: 65px; border-radius: 10px; padding: 0 30px 0 30px;"
                                            value="{{ request()->get('baba_adi') }}" placeholder="Baba Adı">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="anne_adi" id="mother_name" class="form-control"
                                            style="height: 65px; border-radius: 10px; padding: 0 30px 0 30px;"
                                            value="{{ request()->get('anne_adi') }}" placeholder="Anne Adı">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="dogum_tarihi" id="date_of_birth"
                                            class="form-control"
                                            style="height: 65px; border-radius: 10px; padding: 0 30px 0 30px;"
                                            placeholder="Doğum Tarihi" value="{{ request()->get('dogum_tarihi') }}">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="olum_tarihi" id="date_of_death" class="form-control"
                                            style="height: 65px; border-radius: 10px; padding: 0 30px 0 30px;"
                                            placeholder="Ölüm Tarihi" value="{{ request()->get('olum_tarihi') }}">

                                    </div>
                                    <button type="submit" class="search-btn">Şimdi Ara <i
                                            class="fal fa-search"></i></button>
                                    @if (request()->get('ad_soyad') ||
                                            request()->get('il') ||
                                            request()->get('ilce') ||
                                            request()->get('mahalle') ||
                                            request()->get('mezarlik') ||
                                            request()->get('kurum') ||
                                            request()->get('baba_adi') ||
                                            request()->get('anne_adi') ||
                                            request()->get('dogum_tarihi') ||
                                            request()->get('olum_tarihi'))
                                        <a href="{{ route('home.deceased') }}" class="btn btn-light"><i
                                                class="fas fa-sync"></i></a>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- map-listing area end -->
    </main>
@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css"
        rel="stylesheet" />
    <script>
        $("#date_of_birth").datepicker();
        $("#date_of_death").datepicker();
    </script>
    <script>
        $(document).ready(function() {
            $('#search_province_id').select2();
        });
        $(document).ready(function() {
            $('#search_district_id').select2();
        });
        $(document).ready(function() {
            $('#search_neighborhood_id').select2();
        });
        $(document).ready(function() {
            $('#search_cemetery_id').select2();
        });
        $(document).ready(function() {
            $('#search_organisation_id').select2();
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
                        var districtId = $("#search_district_id").val();
                        $.ajax({
                            type: "POST",
                            url: "{{ route('homepage-neighborhoods') }}",
                            data: {
                                "district_id": districtId,
                                "_token": "{{ csrf_token() }}"
                            },
                            success: function(value) {
                                $("#search_neighborhood_id")
                                    .html(value)
                                // var neighborhoodId = $("#search_neighborhood_id")
                                //     .val();
                                $.ajax({
                                    type: "POST",
                                    url: "{{ route('homepage-cemeteries') }}",
                                    data: {
                                        "province_id": provinceId,
                                        "_token": "{{ csrf_token() }}"
                                    },
                                    success: function(value) {
                                        $("#search_cemetery_id").html(
                                            value)
                                    }
                                })
                            }
                        })

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
                        var neighborhoodId = $("#search_neighborhood_id").val();
                        // $.ajax({
                        //     type: "POST",
                        //     url: "{{ route('homepage-cemeteries') }}",
                        //     data: {
                        //         "neighborhood_id": neighborhoodId,
                        //         "_token": "{{ csrf_token() }}"
                        //     },
                        //     success: function(value) {
                        //         $("#search_cemetery_id").html(value)
                        //     }
                        // })
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
    </script>
@endsection
