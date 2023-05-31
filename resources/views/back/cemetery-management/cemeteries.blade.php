@extends('back.layout.main')
@section('title', 'Mezarlıklar')
@section('content')
    <!--begin::Toolbar-->
    <div class="toolbar mb-5 mb-lg-7" id="kt_toolbar">
        <!--begin::Page title-->
        <div class="page-title d-flex flex-column me-3">
            <!--begin::Title-->
            <h1 class="d-flex text-dark fw-bolder my-1 fs-3">Mezarlıklar</h1>
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
                <li class="breadcrumb-item text-gray-600">Mezarlıklar</li>
                <!--end::Item-->
            </ul>
            <!--end::Breadcrumb-->
        </div>
        <!--end::Page title-->
        <!--begin::Actions-->
        <div class="d-flex align-items-center py-2 py-md-1">
            <!--begin::Button-->
            <a href="#" class="btn btn-dark fw-bolder" data-bs-toggle="modal" data-bs-target="#add_cemetery"
                id="kt_toolbar_primary_button"><i class="fas fa-plus"></i> Mezarlık Ekle</a>
            <!--end::Button-->
        </div>
        <!--end::Actions-->
    </div>
    <!--end::Toolbar-->
    <!--begin::Post-->
    <div class="content flex-column-fluid" id="kt_content">
        <div class="row">
            <div class="card mb-5 mb-xl-8">
                <!--begin::Header-->
                <div class="card-header border-0 pt-5">
                    <div class="card-title">
                        <form id="search" method="get" class="d-flex">
                            <div class="d-flex">
                                <div class="mb-2 me-3">
                                    <input type="text" name="mezarlik" class="form-control form-control-solid"
                                        value="{{ request()->get('mezarlik') }}" placeholder="Mezarlık Ara...">
                                </div>
                                <div class="mb-2 me-3 w-200px">
                                    <select name="il" id="search_province" class="form-select form-select-solid"
                                        data-control="select2" data-placeholder="İl Seçiniz">
                                        <option value=""></option>
                                        @foreach ($provinces as $province)
                                            <option @if (request()->get('il') == $province->id) selected @endif
                                                value="{{ $province->id }}">
                                                {{ $province->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-2 me-3 w-200px">
                                    <select name="ilce" id="search_district" class="form-select form-select-solid"
                                        data-control="select2" data-placeholder="İlçe Seçiniz">
                                        <option value=""></option>
                                        @empty(!$districts)
                                            @foreach ($districts as $district)
                                                <option @if (request()->get('ilce') == $district->id) selected @endif
                                                    value="{{ $district->id }}">
                                                    {{ $district->name }}</option>
                                            @endforeach
                                        @endempty
                                    </select>
                                </div>
                                <div class="mb-2 me-3 w-200px">
                                    <select name="mahalle" id="search_neighborhood" class="form-select form-select-solid"
                                        data-control="select2" data-placeholder="Mahalle Seçiniz"
                                        onchange="this.form.submit()">
                                        <option value=""></option>
                                        @empty(!$neighborhoods)
                                            @foreach ($neighborhoods as $neighborhood)
                                                <option @if (request()->get('mahalle') == $neighborhood->id) selected @endif
                                                    value="{{ $neighborhood->id }}">
                                                    {{ $neighborhood->name }}</option>
                                            @endforeach
                                        @endempty
                                    </select>
                                </div>
                                <div>
                                    @if (request()->get('mezarlik') || request()->get('il') || request()->get('ilce'))
                                        <a href="{{ route('cemeteries.index') }}" class="btn btn-light"><i
                                                class="fas fa-sync"></i></a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body py-3">
                    <!--begin::Table container-->
                    <div class="table-responsive">
                        <!--begin::Table-->
                        <table class="table align-middle gs-0 gy-4">
                            <!--begin::Table head-->
                            <thead>
                                <tr class="fw-bolder text-muted bg-light">
                                    <th class="ps-4 min-w-200px rounded-start">Mezarlık</th>
                                    <th class="min-w-125px">Mevta Sayısı</th>
                                    <th class="min-w-125px">Mezarlık Tipi</th>
                                    <th class="min-w-125px">İl</th>
                                    <th class="min-w-125px">İlçe</th>
                                    <th class="min-w-125px">Mahalle</th>
                                    <th class="min-w-125px">Harita</th>
                                    <th class="min-w-200px text-end rounded-end"></th>
                                </tr>
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody>
                                @forelse ($cemeteries as $cemetery)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="symbol symbol-50px me-5">
                                                    @if ($cemetery->image !== null)
                                                        <img src="{{ $cemetery->image }}" class="" />
                                                    @else
                                                        <img style="width: 50px;"
                                                            src="{{ asset('back/assets/media/none-icon-1.jpg') }}"
                                                            class="" />
                                                    @endif
                                                </div>
                                                <div class="d-flex justify-content-start flex-column">
                                                    <a href="#"
                                                        class="text-dark fw-bolder text-hover-primary mb-1 fs-6">
                                                        @foreach (explode(' ', $cemetery->title) as $title)
                                                            {{ Str::ucfirst(Str::lower($title)) }}
                                                        @endforeach
                                                    </a>
                                                    <span
                                                        class="text-muted fw-bold text-muted d-block fs-7">{{ $cemetery->address }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span
                                                class="text-muted fw-bold text-muted d-block fs-7">{{ $cemetery->deceased->count() }}</span>
                                        </td>
                                        <td>
                                            @switch($cemetery->type)
                                                @case('cemetery')
                                                    <span class="text-muted fw-bold text-muted d-block fs-7">Mezarlık</span>
                                                @break

                                                @case('monument')
                                                    <span class="text-muted fw-bold text-muted d-block fs-7">Anıt</span>
                                                @break

                                                @case('martyrdom')
                                                    <span class="text-muted fw-bold text-muted d-block fs-7">Şehitlik</span>
                                                @break

                                                @case('tomb')
                                                    <span class="text-muted fw-bold text-muted d-block fs-7">Türbe</span>
                                                @break
                                            @endswitch
                                        </td>
                                        <td>
                                            <span
                                                class="text-muted fw-bold text-muted d-block fs-7">{{ $cemetery->province->name }}</span>
                                        </td>
                                        <td>
                                            <span
                                                class="text-muted fw-bold text-muted d-block fs-7">{{ $cemetery->district->name }}</span>
                                        </td>
                                        <td>
                                            <span
                                                class="text-muted fw-bold text-muted d-block fs-7">{{ $cemetery->neighborhood->name }}</span>
                                        </td>
                                        <td>
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#cemetery_detail"
                                                data-cemeterytitle="{{ $cemetery->title }}"
                                                data-cemeterymap="{{ $cemetery->address_map }}"
                                                class="fw-bolder text-primary mb-1 fs-7">Görüntüle</a>
                                        </td>
                                        <td class="text-end">
                                            <a href="{{ route('cemeteries.edit', $cemetery->slug) }}"
                                                class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                                <span class="svg-icon svg-icon-3">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none">
                                                        <path opacity="0.3"
                                                            d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z"
                                                            fill="black" />
                                                        <path
                                                            d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z"
                                                            fill="black" />
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon-->
                                            </a>
                                            <input type="hidden" value="{{ $cemetery->id }}" class="cemetery_id">
                                            <button
                                                class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm cemeteryDelete">
                                                <!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
                                                <span class="svg-icon svg-icon-3">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none">
                                                        <path
                                                            d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z"
                                                            fill="black" />
                                                        <path opacity="0.5"
                                                            d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z"
                                                            fill="black" />
                                                        <path opacity="0.5"
                                                            d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z"
                                                            fill="black" />
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon-->
                                            </button>
                                        </td>
                                    </tr>
                                    @empty
                                        <div class="alert alert-info"><i class="fas fa-info text-info"></i> Şu anda sisteme
                                            kayıtlı bir
                                            mezarlık yok!</div>
                                    @endforelse
                                </tbody>
                                <!--end::Table body-->
                            </table>
                            <!--end::Table-->
                        </div>
                        <!--end::Table container-->
                        <div class="d-flex flex-stack flex-wrap">
                            <div class="fs-6 fw-bold text-gray-700">{{ $cemeteries->total() }} kayıttan
                                {{ $cemeteries->firstItem() }} ile {{ $cemeteries->lastItem() }} arası
                                gösteriliyor </div>
                            <!--begin::Pages-->
                            {{ $cemeteries->links('vendor.pagination.bootstrap-4') }}
                            <!--end::Pages-->
                        </div>
                    </div>
                    <!--begin::Body-->
                </div>
            </div>
        </div>
        <!--end::Post-->
        <div class="modal fade" tabindex="-1" id="add_cemetery">
            <div class="modal-dialog mw-900px">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Mezarlık Ekle</h5>

                        <!--begin::Close-->
                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                            aria-label="Close">
                            <span class="svg-icon svg-icon-2x">
                                <i class="fas fa-times fs-4"></i>
                            </span>
                        </div>
                        <!--end::Close-->
                    </div>

                    <form id="saveCemetery" action="{{ route('cemeteries.store') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group mb-5">
                                <label for="image" class="form-label">Mezarlık Resmi</label>
                                <span class="text-danger d-block">{{ $errors->first('image') }}</span>
                                <input type="file" id="image" name="image" class="form-control form-control-solid">
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4 mb-5">
                                    <label for="province_id" class="form-label">İl</label>
                                    <span class="text-danger d-block">{{ $errors->first('province_id') }}</span>
                                    <select name="province_id" id="province_id" class="form-select form-select-solid"
                                        data-control="select2" data-placeholder="İl Seçiniz"
                                        data-dropdown-parent="#add_cemetery">
                                        <option value=""></option>
                                        @foreach ($provinces as $province)
                                            <option value="{{ $province->id }}">{{ $province->name }}</option>
                                        @endforeach
                                    </select>

                                </div>
                                <div class="form-group col-md-4 mb-5">
                                    <label for="district_id" class="form-label">İlçe</label>
                                    <span class="text-danger d-block">{{ $errors->first('district_id') }}</span>
                                    <select name="district_id" id="district_id" class="form-select form-select-solid"
                                        data-control="select2" data-placeholder="İlçe Seçiniz"
                                        data-dropdown-parent="#add_cemetery">
                                        <option value=""></option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4 mb-5">
                                    <label for="neighborhood_id" class="form-label">Mahalle</label>
                                    <span class="text-danger d-block">{{ $errors->first('neighborhood_id') }}</span>
                                    <select name="neighborhood_id" id="neighborhood_id" class="form-select form-select-solid"
                                        data-control="select2" data-placeholder="Mahalle Seçiniz"
                                        data-dropdown-parent="#add_cemetery">
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6 mb-5">
                                    <label for="title" class="form-label">Mezarlık Adı</label>
                                    <span class="text-danger d-block">{{ $errors->first('title') }}</span>
                                    <input type="text" name="title" id="title"
                                        class="form-control form-control-solid" placeholder="Mezarlık" autocomplete="off"
                                        value="{{ old('title') }}">
                                </div>
                                <div class="form-group col-md-6 mb-5">
                                    <label for="type" class="form-label">Mezarlık Tipi</label>
                                    <span class="text-danger d-block">{{ $errors->first('type') }}</span>
                                    <select name="type" id="type" class="form-select form-select-solid"
                                        data-control="select2" data-placeholder="Mezarlık Tipi Seçiniz"
                                        data-dropdown-parent="#add_cemetery">
                                        <option value=""></option>
                                        <option value="cemetery">Mezarlık</option>
                                        <option value="monument">Anıt</option>
                                        <option value="martyrdom">Şehitlik</option>
                                        <option value="tomb">Türbe</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group mb-5">
                                <label for="phone" class="form-label">Telefon</label>
                                <span class="text-danger d-block">{{ $errors->first('phone') }}</span>
                                <input type="text" name="phone" id="phone" class="form-control form-control-solid"
                                    placeholder="Telefon Giriniz" autocomplete="off" value="{{ old('phone') }}">
                            </div>
                            <div class="form-group mb-5">
                                <label for="address" class="form-label">Adres</label>
                                <span class="text-danger d-block">{{ $errors->first('address') }}</span>
                                <input type="text" name="address" id="address" class="form-control form-control-solid"
                                    placeholder="Adres Giriniz" autocomplete="off" value="{{ old('address') }}">
                            </div>
                            <div class="form-group mb-5">
                                <label for="address_map" class="form-label">Mezarlık Harita</label>
                                <span class="text-danger d-block">{{ $errors->first('address_map') }}</span>
                                <input type="text" name="address_map" id="address_map"
                                    class="form-control form-control-solid" placeholder="Mezarlık Harita" autocomplete="off"
                                    value="{{ old('address_map') }}">
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-5">
                                        <label for="opening_time" class="form-label">Açılış Saati</label>
                                        <input type="time" id="opening_time" name="opening_time"
                                            class="form-control form-control-solid" placeholder="Ziyaret Saati"
                                            autocomplete="off" value="{{ old('opening_time') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-5">
                                        <label for="closing_time" class="form-label">Kapanış Saati</label>
                                        <input type="time" id="colsing_time" name="closing_time"
                                            class="form-control form-control-solid" placeholder="Ziyaret Saati"
                                            autocomplete="off" value="{{ old('closing_time') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-5">
                                <label for="content" class="form-label">İçerik</label>
                                <span class="text-danger d-block">{{ $errors->first('content') }}</span>
                                <textarea name="content" id="content" class="form-control form-control-solid">{{ old('content') }}</textarea>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Kapat</button>
                            <button type="submit" class="btn btn-primary">Kaydet</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" tabindex="-1" id="cemetery_detail" aria-hidden="true">
            <div class="modal-dialog mw-900px">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            <span id="cemetery_title"></span>
                        </h5>

                        <!--begin::Close-->
                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                            aria-label="Close">
                            <i class="fas fa-times fs-4"></i>
                        </div>
                        <!--end::Close-->
                    </div>

                    <div class="modal-body">
                        <div class="row" id="cemetery_map">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @section('js')
        @if ($errors->any())
            <script>
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: "Mezarlık eklerken bir sorun oluştu! Alanlardan herhangi biri boş olabilir.",
                    showConfirmButton: false,
                    timer: 1500
                })
            </script>
        @endif
        <script>
            $(document).ready(function() {
                $('#content').summernote();
            });
            Inputmask({
                "mask": "(999) 999-9999"
            }).mask("#phone");
            $("#cemetery_detail").on("show.bs.modal", function(event) {
                var button = $(event.relatedTarget)

                var cemeteryTitle = button.data("cemeterytitle")
                var cemeteryMap = button.data("cemeterymap")
                var modal = $(this)

                modal.find(".modal-title #cemetery_title").html(cemeteryTitle)
                modal.find(".modal-body #cemetery_map").html(cemeteryMap)
            });

            $(document).ready(function() {
                $("#district_id").prop("disabled", true);
                $("#neighborhood_id").prop("disabled", true);
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
                            $("#district_id").prop("disabled", false)
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
                                    $("#neighborhood_id").prop("disabled", false)
                                    $("#neighborhood_id").html(value)
                                }
                            })
                        }
                    })
                });
            });
            $(document).ready(function() {
                $("#neighborhood_id").prop("disabled", true);
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
                            $("#neighborhood_id").prop("disabled", false)
                            $("#neighborhood_id").html(value)
                        }
                    })
                });
            });

            $(".cemeteryDelete").click(function(e) {
                e.preventDefault();

                var cemeteryId = $(this).closest("tr").find(".cemetery_id").val();

                Swal.fire({
                    title: 'Emin misniz?',
                    text: "Mezarlığı silmek istiyor musunuz? Bu işlem geri alınamaz!",
                    icon: 'warning',
                    showCancelButton: true,
                    cancelButtonText: "İptal et",
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Evet, sil!'
                }).then((result) => {
                    if (result.isConfirmed) {

                        var data = {
                            "_token": $("input[name=_token]").val(),
                            "id": cemeteryId,
                        };

                        $.ajax({
                            type: "GET",
                            url: "/panel/mezarlik-sil/" + cemeteryId,
                            data: data,
                            success: function() {
                                Swal.fire({
                                    title: 'Silindi!',
                                    text: 'Mezarlık başarıyla silindi.',
                                    icon: 'success',
                                    confirmButtonText: 'Tamam'
                                }).then(result => {
                                    location.reload();
                                });
                            }
                        });
                    }
                })
            });
            $(document).ready(function() {
                $("#search_province").change(function() {
                    var provinceId = $(this).val();
                    $.ajax({
                        type: "POST",
                        url: "{{ route('districts') }}",
                        data: {
                            "province_id": provinceId,
                            "_token": "{{ csrf_token() }}"
                        },
                        success: function(value) {
                            $("#search_district").html(value)
                            var districtId = $("#search_district").val();
                            $.ajax({
                                type: "POST",
                                url: "{{ route('neighborhoods') }}",
                                data: {
                                    "district_id": districtId,
                                    "_token": "{{ csrf_token() }}"
                                },
                                success: function(value) {
                                    $("#search_neighborhood").html(value)
                                    $.ajax({
                                        type: "POST",
                                        url: "{{ route('neighborhoods') }}",
                                        data: {
                                            "district_id": districtId,
                                            "_token": "{{ csrf_token() }}"
                                        },
                                        success: function(value) {
                                            $("#search_neighborhood").html(
                                                value)
                                            $("#search").submit();
                                        }
                                    })
                                }
                            })
                        }
                    })
                });
            });
            $(document).ready(function() {
                $("#search_district").change(function() {
                    var districtId = $(this).val();
                    $.ajax({
                        type: "POST",
                        url: "{{ route('neighborhoods') }}",
                        data: {
                            "district_id": districtId,
                            "_token": "{{ csrf_token() }}"
                        },
                        success: function(value) {
                            $("#search_neighborhood").html(value)
                            $("#search").submit();
                        }
                    })
                });
            });
        </script>
    @endsection
