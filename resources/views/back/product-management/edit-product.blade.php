@extends('back.layout.main')
@section('title', $product->title)
@section('content')
    <!--begin::Toolbar-->
    <div class="toolbar mb-5 mb-lg-7" id="kt_toolbar">
        <!--begin::Page title-->
        <div class="page-title d-flex flex-column me-3">
            <!--begin::Title-->
            <h1 class="d-flex text-dark fw-bolder my-1 fs-3">{{ $product->title }}</h1>
            <!--end::Title-->
            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-dot fw-bold text-gray-600 fs-7 my-1">
                <!--begin::Item-->
                <li class="breadcrumb-item text-gray-600">
                    <a href="{{ route('panel') }}" class="text-gray-600 text-hover-primary">Anasayfa</a>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item text-gray-600">Ürün Yönetimi</li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item text-gray-600">{{ $product->title }}</li>
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
                <h3 class="card-title">Ürün Güncelle</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('products.update', $product->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group mb-5">
                        <label for="title" class="form-label">Başlık</label>
                        <span class="text-danger d-block">{{ $errors->first('title') }}</span>
                        <input type="text" name="title" id="title" class="form-control form-control-solid"
                            placeholder="Başlık Giriniz" autocomplete="off" value="{{ $product->title }}">
                    </div>
                    <div class="form-group mb-5">
                        <label for="price" class="form-label">Fiyat</label>
                        <span class="text-danger d-block">{{ $errors->first('price') }}</span>
                        <input type="number" name="price" id="price" class="form-control form-control-solid"
                            placeholder="Adres Giriniz" autocomplete="off" value="{{ $product->price }}">
                    </div>
                    <div class="form-group mb-5">
                        <label for="status" class="form-label">Durum</label>
                        <select name="status" id="status" class="form-select form-select-solid">
                            <option @if ($product->status == 1) selected @endif value="1">Aktif</option>
                            <option @if ($product->status == 0) selected @endif value="0">Pasif</option>
                        </select>
                    </div>
                    <div class="form-group mb-5">
                        <label for="description" class="form-label">Kısa Açıklama</label>
                        <span class="text-danger d-block">{{ $errors->first('description') }}</span>
                        <textarea name="description" id="description" class="form-control form-control-solid">{{ $product->description }}</textarea>
                    </div>
                    <div class="form-group mb-5">
                        <label for="content" class="form-label">İçerik</label>
                        <span class="text-danger d-block">{{ $errors->first('content') }}</span>
                        <textarea name="content" id="content" class="form-control form-control-solid">{{ $product->content }}</textarea>
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
