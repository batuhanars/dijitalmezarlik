@extends('back.layout.main')
@section('title', $cemetery->title)
@section('content')
    <!--begin::Toolbar-->
    <div class="toolbar mb-5 mb-lg-7" id="kt_toolbar">
        <!--begin::Page title-->
        <div class="page-title d-flex flex-column me-3">
            <!--begin::Title-->
            <h1 class="d-flex text-dark fw-bolder my-1 fs-3">{{ $cemetery->title }}</h1>
            <!--end::Title-->
            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-dot fw-bold text-gray-600 fs-7 my-1">
                <!--begin::Item-->
                <li class="breadcrumb-item text-gray-600">
                    <a href="{{ route('panel') }}" class="text-gray-600 text-hover-primary">Anasayfa</a>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item text-gray-600">Mezarlık Yönetimi</li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item text-gray-600">{{ $cemetery->title }}</li>
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
                <h3 class="card-title">Mezarlık Güncelle</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('cemeteries.update', $cemetery->id) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method("PUT")
                    <div class="form-group mb-5">
                        <label for="image" class="form-label">Mezarlık Resmi</label>
                        <div>
                            <img src="{{ $cemetery->image }}" id="image_preview" width="250" alt=""
                                class="mb-5">
                        </div>
                        <span class="text-danger d-block">{{ $errors->first('image') }}</span>
                        <input type="file" id="image" name="image" class="form-control form-control-solid">
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4 mb-5">
                            <label for="province_id" class="form-label">İl</label>
                            <span class="text-danger d-block">{{ $errors->first('province_id') }}</span>
                            <select name="province_id" id="province_id" class="form-select form-select-solid"
                                data-control="select2" data-placeholder="İl Seçiniz">
                                @foreach ($provinces as $province)
                                    <option @if ($cemetery->province_id == $province->id) selected @endif value="{{ $province->id }}">
                                        {{ $province->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4 mb-5">
                            <label for="district_id" class="form-label">İlçe</label>
                            <span class="text-danger d-block">{{ $errors->first('district_id') }}</span>
                            <select name="district_id" id="district_id" class="form-select form-select-solid"
                                data-control="select2" data-placeholder="İlçe Seçiniz">
                                <option value=""></option>
                                @foreach ($districts as $district)
                                    <option @if ($district->id == $cemetery->district_id) selected @endif
                                        value="{{ $district->id }}">
                                        {{ $district->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4 mb-5">
                            <label for="neighborhood_id" class="form-label">Mahalle</label>
                            <span class="text-danger d-block">{{ $errors->first('neighborhood_id') }}</span>
                            <select name="neighborhood_id" id="neighborhood_id" class="form-select form-select-solid"
                                data-control="select2" data-placeholder="Mahalle Seçiniz">
                                <option value=""></option>
                                @foreach ($neighborhoods as $neighborhood)
                                    <option @if ($neighborhood->id == $cemetery->neighborhood_id) selected @endif
                                        value="{{ $neighborhood->id }}">
                                        {{ $neighborhood->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6 mb-5">
                            <label for="title" class="form-label">Mezarlık Adı</label>
                            <span class="text-danger d-block">{{ $errors->first('title') }}</span>
                            <input type="text" name="title" id="title" value="{{ $cemetery->title }}"
                                class="form-control form-control-solid" placeholder="Mezarlık">
                        </div>
                        <div class="form-group col-md-6 mb-5">
                            <label for="type" class="form-label">Mezarlık Tipi</label>
                            <span class="text-danger d-block">{{ $errors->first('type') }}</span>
                            <select name="type" id="type" class="form-select form-select-solid" data-control="select2"
                                data-placeholder="Mezarlık Tipi Seçiniz">
                                <option value=""></option>
                                <option @if ($cemetery->type == 'cemetery') selected @endif value="cemetery">Mezarlık</option>
                                <option @if ($cemetery->type == 'monument') selected @endif value="monument">Anıt</option>
                                <option @if ($cemetery->type == 'martyrdom') selected @endif value="martyrdom">Şehitlik
                                </option>
                                <option @if ($cemetery->type == 'tomb') selected @endif value="tomb">Türbe</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group mb-5">
                        <label for="phone" class="form-label">Telefon</label>
                        <input type="text" name="phone" id="phone" class="form-control form-control-solid"
                            value="{{ $cemetery->phone }}" placeholder="Telefon Giriniz" autocomplete="off">
                    </div>
                    <div class="form-group mb-5">
                        <label for="address" class="form-label">Adres</label>
                        <span class="text-danger d-block">{{ $errors->first('address') }}</span>
                        <input type="text" name="address" id="address" value="{{ $cemetery->address }}"
                            class="form-control form-control-solid" placeholder="Adres Giriniz">
                    </div>
                    <div class="form-group mb-5">
                        <label for="address_map" class="form-label">Mezarlık Harita</label>
                        <span class="text-danger d-block">{{ $errors->first('address_map') }}</span>
                        <input type="text" id="address_map" name="address_map" class="form-control form-control-solid"
                            value="{{ $cemetery->address_map }}" placeholder="Mezarlık Harita" autocomplete="off">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-5">
                                <label for="opening_time" class="form-label">Açılış Saati</label>
                                <input type="time" id="opening_time" name="opening_time"
                                    class="form-control form-control-solid" placeholder="Ziyaret Saati" autocomplete="off"
                                    value="{{ $cemetery->opening_time }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-5">
                                <label for="closing_time" class="form-label">Kapanış Saati</label>
                                <input type="time" id="colsing_time" name="closing_time"
                                    class="form-control form-control-solid" placeholder="Ziyaret Saati" autocomplete="off"
                                    value="{!! $cemetery->closing_time !!}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-5">
                        <label for="content" class="form-label">İçerik</label>
                        <span class="text-danger d-block">{{ $errors->first('content') }}</span>
                        <textarea name="content" id="content" class="form-control form-control-solid">{{ $cemetery->content }}</textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Güncelle</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--end::Post-->
@endsection
@section('js')
    <script>
        $("#image").change(function() {
            let file = URL.createObjectURL(this.files[0]);
            $("#image_preview").attr("src", file)
        });
        Inputmask({
            "mask": "(999) 999-9999"
        }).mask("#phone");
        $(document).ready(function() {
            $('#content').summernote();
        });

        $(document).ready(function() {
            // $("#district_id").prop("disabled", true);
            // $("#neighborhood_id").prop("disabled", true);
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
                        // $("#district_id").prop("disabled", false)
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
                                // $("#neighborhood_id").prop("disabled", false)
                                $("#neighborhood_id").html(value)
                            }
                        })
                    }
                })
            });
        });
        $(document).ready(function() {
            // $("#neighborhood_id").prop("disabled", true);
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
                        // $("#neighborhood_id").prop("disabled", false)
                        $("#neighborhood_id").html(value)
                    }
                })
            });
        });
    </script>
@endsection
