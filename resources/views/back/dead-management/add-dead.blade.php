@extends('back.layout.main')
@section('title', 'Mevta Ekle')
@section('content')
    <!--begin::Toolbar-->
    <div class="toolbar mb-5 mb-lg-7" id="kt_toolbar">
        <!--begin::Page title-->
        <div class="page-title d-flex flex-column me-3">
            <!--begin::Title-->
            <h1 class="d-flex text-dark fw-bolder my-1 fs-3">Mevta Ekle</h1>
            <!--end::Title-->
            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-dot fw-bold text-gray-600 fs-7 my-1">
                <!--begin::Item-->
                <li class="breadcrumb-item text-gray-600">
                    <a href="{{ route('panel') }}" class="text-gray-600 text-hover-primary">Anasayfa</a>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item text-gray-600">Mevta Yönetimi</li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item text-gray-600">Mevta Ekle</li>
                <!--end::Item-->
            </ul>
            <!--end::Breadcrumb-->
        </div>
        <!--end::Page title-->
    </div>
    <!--end::Toolbar-->
    <!--begin::Post-->
    <div class="content flex-column-fluid" id="kt_content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Mevta Ekle</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('deceased.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="creator_id" value="{{ Auth::user()->id }}">
                    <div class="form-group mb-5">
                        <label for="image" class="form-label">Mevta Resmi</label>
                        <span class="text-danger d-block">{{ $errors->first('image') }}</span>
                        <input type="file" name="image" id="image" class="form-control form-control-solid">
                    </div>
                    <div class="form-group mb-5">
                        <label for="country_id" class="form-label">Ülke</label>
                        <select name="country_id" id="country_id" data-control="select2"
                            class="form-select form-select-solid" style="width: 100%">
                            @foreach ($countries as $country)
                                <option @if ($country->title == 'Türkiye') selected @endif value="{{ $country->id }}">
                                    {{ $country->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row" id="selectValue">
                        @if (Auth::user()->province_district_customization == 0)
                            <div class="form-group col-md-6 mb-5">
                                <label for="province_id" class="form-label">İl</label>
                                <span class="text-danger d-block">{{ $errors->first('province_id') }}</span>
                                <select name="province_id" id="province_id" class="form-select form-select-solid"
                                    data-control="select2" data-placeholder="İl Seçiniz" data-dropdown-parent="#add_dead">
                                    <option value=""></option>
                                    @foreach ($provinces as $province)
                                        <option value="{{ $province->id }}">{{ $province->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6 mb-5">
                                <label for="district_id" class="form-label">İlçe</label>
                                <span class="text-danger d-block">{{ $errors->first('district_id') }}</span>
                                <select name="district_id" id="district_id" class="form-select form-select-solid"
                                    data-control="select2" data-placeholder="İlçe Seçiniz" data-dropdown-parent="#add_dead">
                                    <option value=""></option>
                                </select>
                            </div>
                        @elseif(Auth::user()->province_district_customization == 1)
                            <div class="form-group col-md-12 mb-5">
                                <label for="province_id" class="form-label">İl</label>
                                <span class="text-danger d-block">{{ $errors->first('province_id') }}</span>
                                <select name="province_id" id="province_id" class="form-select form-select-solid"
                                    data-control="select2" data-placeholder="İl Seçiniz" data-dropdown-parent="#add_dead">
                                    <option value=""></option>
                                    @foreach (Auth::user()->provinces as $province)
                                        <option value="{{ $province->id }}">{{ $province->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @elseif(Auth::user()->province_district_customization == 2)
                            <div class="form-group col-md-4 mb-5">
                                <label for="province_id" class="form-label">İl</label>
                                <span class="text-danger d-block">{{ $errors->first('province_id') }}</span>
                                <select name="province_id" id="province_id" class="form-select form-select-solid"
                                    data-control="select2" data-placeholder="İl Seçiniz" data-dropdown-parent="#add_dead">
                                    <option value=""></option>
                                    @foreach (Auth::user()->provinces as $province)
                                        <option value="{{ $province->id }}">{{ $province->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4 mb-5">
                                <label for="district_id" class="form-label">İlçe</label>
                                <span class="text-danger d-block">{{ $errors->first('district_id') }}</span>
                                <select name="district_id" id="district_id" class="form-select form-select-solid"
                                    data-control="select2" data-placeholder="İlçe Seçiniz" data-dropdown-parent="#add_dead">
                                    <option value=""></option>
                                    @foreach (Auth::user()->districts as $district)
                                        <option value="{{ $district->id }}">{{ $district->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                        <div class="form-group mb-5">
                            <label for="neighborhood_id" class="form-label">Mahalle</label>
                            <span class="text-danger d-block">{{ $errors->first('neighborhood_id') }}</span>
                            <select name="neighborhood_id" id="neighborhood_id" class="form-select form-select-solid"
                                data-control="select2" data-dropdown-parent="#add_dead"
                                data-placeholder="Mahalle Seçiniz">
                                <option value=""></option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-5" id="noneSelectValue">
                        <div class="form-group col-md-4">
                            <label for="province_id" class="form-label">İl</label>
                            <input type="text" name="province_name" id="province_name"
                                class="form-control form-control-solid" placeholder="İl">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="district_id" class="form-label">İlçe</label>
                            <input type="text" name="district_name" id="district_name"
                                class="form-control form-control-solid" placeholder="İlçe">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="neighborhood_id" class="form-label">Mahalle</label>
                            <input type="text" name="neighborhood_name" id="neighborhood_name"
                                class="form-control form-control-solid" placeholder="İl">
                        </div>
                    </div>
                    <div class="form-group mb-5" id="selectCemetery">
                        <label for="cemetery_id" class="form-label">Mezarlık</label>
                        <span class="text-danger d-block">{{ $errors->first('cemetery_id') }}</span>
                        <select name="cemetery_id" id="cemetery_id" class="form-select form-select-solid"
                            data-control="select2" data-placeholder="Mezarlık Seçiniz" data-dropdown-parent="#add_dead">
                            <option value=""></option>
                        </select>
                    </div>
                    <div class="form-group mb-5" id="noneSelectCemetery">
                        <label for="cemetery_name" class="form-label">Mezarlık Adı</label>
                        <span class="text-danger d-block" id="cemeteryError">{{ $errors->first('cemetery') }}</span>
                        <input type="text" name="cemetery_name" id="cemetery_name"
                            class="form-control form-control-solid" placeholder="Mezarlık Adı">
                    </div>
                    <div class="form-group mb-5">
                        <label for="organisation_id" class="form-label">Kurum</label>
                        <select name="organisation_id[]" id="organisation_id" class="form-select form-select-solid"
                            multiple data-control="select2" data-placeholder="Kurum Seçiniz">
                            <option value=""></option>
                            @foreach ($organisations as $organisation)
                                <option value="{{ $organisation->id }}">{{ $organisation->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row">
                        <div class="form-group mb-5 col-md-4">
                            <label for="first_name" class="form-label">Mevta Adı</label>
                            <span class="text-danger d-block">{{ $errors->first('first_name') }}</span>
                            <input type="text" name="first_name" id="first_name"
                                class="form-control form-control-solid" placeholder="Mevta Adı" autocomplete="off"
                                value="{{ old('first_name') }}">
                        </div>
                        <div class="form-group mb-5 col-md-4">
                            <label for="last_name" class="form-label">Mevta Soyadı</label>
                            <span class="text-danger d-block">{{ $errors->first('last_name') }}</span>
                            <input type="text" name="last_name" id="last_name"
                                class="form-control form-control-solid" placeholder="Mevta Soyadı" autocomplete="off"
                                value="{{ old('last_name') }}">
                        </div>
                        <div class="form-group mb-5 col-md-4">
                            <label for="job" class="form-label">Meslek</label>
                            {{-- <input type="text" name="job" id="job" class="form-control form-control-solid"
                                placeholder="Meslek" autocomplete="off" value="{{ old('job') }}"> --}}
                            <select name="job" id="job" class="form-select form-select-solid"
                                data-control="select2" data-placeholder="Meslek Seçiniz">
                                <option value=""></option>
                                @foreach ($jobs as $job)
                                    <option value="{{ $job->title }}">{{ $job->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group mb-5">
                        <label for="gender" class="form-label">Cinsiyet</label>
                        <select name="gender" id="gender" class="form-select form-select-solid" style="width: 100%">
                            <option value="Erkek">Erkek</option>
                            <option value="Kadın">Kadın</option>
                        </select>
                    </div>
                    <div class="form-group mb-5" id="maidenNameContainer">
                        <label for="maiden_name" class="form-label">Kızlık Soyadı</label>
                        <input type="text" name="maiden_name" id="maiden_name"
                            class="form-control form-control-solid" placeholder="Kızlık Soyadı" autocomplete="off">
                    </div>
                    <div class="row">
                        <div class="form-group mb-5 col-md-6">
                            <label for="father_name" class="form-label">Baba Adı</label>
                            <span class="text-danger d-block">{{ $errors->first('father_name') }}</span>
                            <input type="text" name="father_name" id="father_name"
                                class="form-control form-control-solid" placeholder="Baba Adı" autocomplete="off"
                                value="{{ old('father_name') }}">
                        </div>
                        <div class="form-group mb-5 col-md-6">
                            <label for="mother_name" class="form-label">Anne Adı</label>
                            <span class="text-danger d-block">{{ $errors->first('mother_name') }}</span>
                            <input type="text" name="mother_name" id="mother_name"
                                class="form-control form-control-solid" placeholder="Anne Adı" autocomplete="off"
                                value="{{ old('mother_name') }}">
                        </div>
                    </div>
                    <div class="form-group mb-5">
                        <label for="is_married" class="form-label">Medeni Hali</label>
                        <select name="is_married" id="is_married" class="form-select form-select-solid"
                            style="width: 100%">
                            <option value="0">Bekar</option>
                            <option value="1">Evli</option>
                        </select>
                    </div>
                    <div class="form-group mb-5" id="spouse_container">
                        <label for="spouse_name" class="form-label">Eş Adı</label>
                        <span class="text-danger d-block">{{ $errors->first('spouse_name') }}</span>
                        <input type="text" name="spouse_name" id="spouse_name"
                            class="form-control form-control-solid" placeholder="Eş Adı" autocomplete="off"
                            value="{{ old('spouse_name') }}">
                    </div>
                    <div class="row">
                        <div class="form-group mb-5 col-md-4">
                            <label for="day_of_birth" class="form-label">Doğum Günü</label>
                            <select name="day_of_birth" id="day_of_birth" class="form-select form-select-solid"
                                data-control="select2" data-placeholder="Doğum Günü">
                                <option value=""></option>
                                <option value=""></option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                <option value="16">16</option>
                                <option value="17">17</option>
                                <option value="18">18</option>
                                <option value="19">19</option>
                                <option value="20">20</option>
                                <option value="21">21</option>
                                <option value="22">22</option>
                                <option value="23">23</option>
                                <option value="24">24</option>
                                <option value="25">25</option>
                                <option value="26">26</option>
                                <option value="27">27</option>
                                <option value="28">28</option>
                                <option value="29">29</option>
                                <option value="30">30</option>
                                <option value="31">31</option>
                            </select>
                        </div>
                        <div class="form-group mb-5 col-md-4">
                            <label for="month_of_birth" class="form-label">Doğum Ayı</label>
                            <select name="month_of_birth" id="month_of_birth" class="form-select form-select-solid"
                                data-control="select2" data-placeholder="Doğum Ayı">
                                <option value=""></option>
                                <option value="01">Ocak</option>
                                <option value="02">Şubat</option>
                                <option value="03">Mart</option>
                                <option value="04">Nisan</option>
                                <option value="05">Mayıs</option>
                                <option value="06">Haziran</option>
                                <option value="07">Temmuz</option>
                                <option value="08">Ağusots</option>
                                <option value="09">Eylül</option>
                                <option value="10">Ekim</option>
                                <option value="11">Kasım</option>
                                <option value="12">Aralık</option>
                            </select>
                        </div>
                        <div class="form-group mb-5 col-md-4">
                            <label for="year_of_birth" class="form-label">Doğum Yılı</label>
                            <input id="year_of_birth" name="year_of_birth" class="form-control form-control-solid"
                                placeholder="Doğum Yılı" autocomplete="off">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group mb-5 col-md-4">
                            <label for="day_of_death" class="form-label">Ölüm Günü</label>
                            <select name="day_of_death" id="day_of_death" class="form-select form-select-solid"
                                data-control="select2" data-placeholder="Ölüm Günü">
                                <option value=""></option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                <option value="16">16</option>
                                <option value="17">17</option>
                                <option value="18">18</option>
                                <option value="19">19</option>
                                <option value="20">20</option>
                                <option value="21">21</option>
                                <option value="22">22</option>
                                <option value="23">23</option>
                                <option value="24">24</option>
                                <option value="25">25</option>
                                <option value="26">26</option>
                                <option value="27">27</option>
                                <option value="28">28</option>
                                <option value="29">29</option>
                                <option value="30">30</option>
                                <option value="31">31</option>
                            </select>
                        </div>
                        <div class="form-group mb-5 col-md-4">
                            <label for="month_of_death" class="form-label">Ölüm Ayı</label>
                            <select name="month_of_death" id="month_of_death" class="form-select form-select-solid"
                                data-control="select2" data-placeholder="Ölüm Ayı">
                                <option value=""></option>
                                <option value="01">Ocak</option>
                                <option value="02">Şubat</option>
                                <option value="03">Mart</option>
                                <option value="04">Nisan</option>
                                <option value="05">Mayıs</option>
                                <option value="06">Haziran</option>
                                <option value="07">Temmuz</option>
                                <option value="08">Ağusots</option>
                                <option value="09">Eylül</option>
                                <option value="10">Ekim</option>
                                <option value="11">Kasım</option>
                                <option value="12">Aralık</option>
                            </select>
                        </div>
                        <div class="form-group mb-5 col-md-4">
                            <label for="year_of_death" class="form-label">Ölüm Yılı</label>
                            <input id="year_of_death" name="year_of_death" class="form-control form-control-solid"
                                placeholder="Ölüm Yılı" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group mb-5">
                        <label for="place_of_birth" class="form-label">Doğum Yeri</label>
                        <input id="place_of_birth" name="place_of_birth" class="form-control form-control-solid"
                            placeholder="Doğum Yeri" autocomplete="off">
                    </div>
                    <div class="form-group mb-5">
                        <label for="content" class="form-label">Mevta Hakkında</label>
                        <span class="text-danger d-block">{{ $errors->first('content') }}</span>
                        <textarea name="content" id="content" class="form-control form-control-solid">{{ old('content') }}</textarea>
                    </div>
                    <div class="form-group mb-5">
                        <button type="submit" class="btn btn-success">Kaydet</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--end::Post-->
@endsection
@section('js')
    <script>
        const isMarried = document.querySelector("#is_married")
        const spouseContainer = document.querySelector("#spouse_container")

        spouseContainer.style.display = "none";

        isMarried.addEventListener("change", (e) => {
            if (e.target.value == "1") {
                spouseContainer.style.display = "block";
            } else {
                spouseContainer.style.display = "none";
            }
        })

        $(document).ready(function() {
            $('#content').summernote();
        });
    </script>

    <script>
        $("#noneSelectValue").hide();
        $("#noneSelectCemetery").hide();
        $("#country_id").change(e => {
            if (e.target.value === "190") {
                $("#selectValue").show();
                $("#noneSelectValue").hide();
                $("#selectCemetery").show();
                $("#noneSelectCemetery").hide();
            } else {
                $("#selectValue").hide();
                $("#noneSelectValue").show();
                $("#selectCemetery").hide();
                $("#noneSelectCemetery").show();
            }
        })
    </script>
    @if (Auth::user()->province_district_customization == 0)
        <script>
            $(document).ready(function() {
                // $("#district_id").prop("disabled", true);
                // $("#cemetery_id").prop("disabled", true)
                // $("#neighborhood_id").prop("disabled", true)
                $("#province_id").change(function() {
                    var provinceId = $(this).val();
                    $.ajax({
                        type: "POST",
                        url: "{{ route('districts') }}",
                        data: {
                            "province_id": provinceId,
                            "_token": "{{ csrf_token() }}"
                        },
                        success: function(value) {
                            // $("#district_id").prop("disabled", false);
                            $("#district_id").html(value)
                            var districtId = $("#district_id").val();
                            $.ajax({
                                type: "POST",
                                url: "{{ route('neighborhoods') }}",
                                data: {
                                    "district_id": districtId,
                                    "_token": "{{ csrf_token() }}"
                                },
                                success: function(value) {
                                    // $("#neighborhood_id").prop(
                                    //     "disabled", false)
                                    $("#neighborhood_id").html(
                                        value)
                                    var neighborhoodId = $("#neighborhood_id").val();
                                    $.ajax({
                                        type: "POST",
                                        url: "{{ route('cemeteries') }}",
                                        data: {
                                            "province_id": provinceId,
                                            "_token": "{{ csrf_token() }}"
                                        },
                                        success: function(
                                            value) {
                                            // $("#cemetery_id")
                                            //     .prop(
                                            //         "disabled",
                                            //         false
                                            //     )
                                            $("#cemetery_id")
                                                .html(
                                                    value
                                                )
                                        }
                                    })
                                }
                            })
                        }
                    });
                });
            });
            $(document).ready(function() {
                // $("#cemetery_id").prop("disabled", true)
                // $("#neighborhood_id").prop("disabled", true)
                $("#district_id").change(function() {
                    var districtId = $(this).val();
                    $.ajax({
                        type: "POST",
                        url: "{{ route('neighborhoods') }}",
                        data: {
                            "district_id": districtId,
                            "_token": "{{ csrf_token() }}"
                        },
                        success: function(value) {
                            // $("#neighborhood_id").prop("disabled", false);
                            $("#neighborhood_id").html(value)
                            // var neighborhoodId = $("#neighborhood_id").val();
                            $.ajax({
                                type: "POST",
                                url: "{{ route('cemeteries') }}",
                                data: {
                                    "district_id": districtId,
                                    "_token": "{{ csrf_token() }}"
                                },
                                success: function(value) {
                                    $("#cemetery_id").prop(
                                        "disabled", false)
                                    $("#cemetery_id").html(
                                        value)
                                }
                            })
                        }
                    });
                });
            });
            // $(document).ready(function() {
            //     $("#cemetery_id").prop("disabled", true)
            //     $("#neighborhood_id").change(function() {
            //         var neighborhoodId = $(this).val();
            //         $.ajax({
            //             type: "POST",
            //             url: "{{ route('cemeteries') }}",
            //             data: {
            //                 "neighborhood_id": neighborhoodId,
            //                 "_token": "{{ csrf_token() }}"
            //             },
            //             success: function(value) {
            //                 $("#cemetery_id").prop("disabled", false);
            //                 $("#cemetery_id").html(value)
            //                 var neighborhoodId = $("#neighborhood_id").val();
            //             }
            //         });
            //     });
            // });
        </script>
    @elseif (Auth::user()->province_district_customization == 1)
        <script>
            $(document).ready(function() {
                $("#cemetery_id").prop("disabled", true);
                $("#neighborhood_id").prop("disabled", true);
                $("#province_id").change(function() {
                    var provinceId = $(this).val();
                    $.ajax({
                        type: "POST",
                        url: "{{ route('neighborhoods') }}",
                        data: {
                            "province_id": provinceId,
                            "_token": "{{ csrf_token() }}"
                        },
                        success: function(value) {
                            $("#neighborhood_id").prop(
                                "disabled", false)
                            $("#neighborhood_id").html(
                                value)
                            // var neighborhoodId = $("#neighborhood_id").val();
                            $.ajax({
                                type: "POST",
                                url: "{{ route('cemeteries') }}",
                                data: {
                                    "province_id": provinceId,
                                    "_token": "{{ csrf_token() }}"
                                },
                                success: function(
                                    value) {
                                    $("#cemetery_id")
                                        .prop(
                                            "disabled",
                                            false
                                        )
                                    $("#cemetery_id")
                                        .html(
                                            value
                                        )
                                }
                            })
                        }
                    })
                });
            });
            // $(document).ready(function() {
            //     $("#cemetery_id").prop("disabled", true)
            //     $("#neighborhood_id").change(function() {
            //         var neighborhoodId = $(this).val();
            //         $.ajax({
            //             type: "POST",
            //             url: "{{ route('cemeteries') }}",
            //             data: {
            //                 "neighborhood_id": neighborhoodId,
            //                 "_token": "{{ csrf_token() }}"
            //             },
            //             success: function(value) {
            //                 $("#cemetery_id").prop("disabled", false);
            //                 $("#cemetery_id").html(value)
            //             }
            //         });
            //     });
            // });
        </script>
    @elseif (Auth::user()->province_district_customization == 2)
        <script>
            $(document).ready(function() {
                $("#district_id").prop("disabled", true);
                $("#cemetery_id").prop("disabled", true)
                $("#neighborhood_id").prop("disabled", true)
                $("#province_id").change(function() {
                    var provinceId = $(this).val();
                    $.ajax({
                        type: "POST",
                        url: "{{ route('districts') }}",
                        data: {
                            "province_id": provinceId,
                            "_token": "{{ csrf_token() }}"
                        },
                        success: function(value) {
                            $("#district_id").prop("disabled", false);
                            $("#district_id").html(value)
                            var districtId = $("#district_id").val();
                            $.ajax({
                                type: "POST",
                                url: "{{ route('neighborhoods') }}",
                                data: {
                                    "district_id": districtId,
                                    "_token": "{{ csrf_token() }}"
                                },
                                success: function(value) {
                                    $("#neighborhood_id").prop(
                                        "disabled", false)
                                    $("#neighborhood_id").html(
                                        value)
                                    // var neighborhoodId = $("#neighborhood_id").val();
                                    $.ajax({
                                        type: "POST",
                                        url: "{{ route('cemeteries') }}",
                                        data: {
                                            "province_id": provinceId,
                                            "_token": "{{ csrf_token() }}"
                                        },
                                        success: function(
                                            value) {
                                            $("#cemetery_id")
                                                .prop(
                                                    "disabled",
                                                    false
                                                )
                                            $("#cemetery_id")
                                                .html(
                                                    value
                                                )
                                                .trigger(
                                                    "change"
                                                )
                                        }
                                    })
                                }
                            })
                        }
                    });
                });
            });
            $(document).ready(function() {
                $("#cemetery_id").prop("disabled", true)
                $("#neighborhood_id").prop("disabled", true)
                $("#district_id").change(function() {
                    var districtId = $(this).val();
                    $.ajax({
                        type: "POST",
                        url: "{{ route('neighborhoods') }}",
                        data: {
                            "district_id": districtId,
                            "_token": "{{ csrf_token() }}"
                        },
                        success: function(value) {
                            $("#neighborhood_id").prop("disabled", false);
                            $("#neighborhood_id").html(value)
                            var neighborhoodId = $("#neighborhood_id").val();
                            $.ajax({
                                type: "POST",
                                url: "{{ route('cemeteries') }}",
                                data: {
                                    "district_id": districtId,
                                    "_token": "{{ csrf_token() }}"
                                },
                                success: function(value) {
                                    $("#cemetery_id").prop(
                                        "disabled", false)
                                    $("#cemetery_id").html(
                                        value)
                                }
                            })
                        }
                    });
                });
            });
            // $(document).ready(function() {
            //     $("#cemetery_id").prop("disabled", true)
            //     $("#neighborhood_id").change(function() {
            //         var neighborhoodId = $(this).val();
            //         $.ajax({
            //             type: "POST",
            //             url: "{{ route('cemeteries') }}",
            //             data: {
            //                 "neighborhood_id": neighborhoodId,
            //                 "_token": "{{ csrf_token() }}"
            //             },
            //             success: function(value) {
            //                 $("#cemetery_id").prop("disabled", false);
            //                 $("#cemetery_id").html(value)
            //             }
            //         });
            //     });
            // });
        </script>
    @endif
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css"
        rel="stylesheet" />
    <script>
        $("#year_of_birth").datepicker({
            singleDatePicker: true,
            showDropdowns: true,
            format: "yyyy",
            viewMode: "years",
            minViewMode: "years"
        });
        $("#year_of_death").datepicker({
            singleDatePicker: true,
            showDropdowns: true,
            format: "yyyy",
            viewMode: "years",
            minViewMode: "years"
        });

        $("#maidenNameContainer").hide()
        $("#gender").change(e => {
            if (e.target.value == 'Kadın') $("#maidenNameContainer").show()
            else $("#maidenNameContainer").hide()
        })
    </script>
@endsection
