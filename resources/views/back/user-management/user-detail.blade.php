@extends('back.layout.main')
@section('title', $user->full_name . ' Kullanıcısına Atanmış İller, İlçeler ve Kurumlar')
@section('css')
    <style>
        .display-none {
            display: none;
        }

    </style>
@endsection
@section('content')
    <!--begin::Toolbar-->
    <div class="toolbar mb-5 mb-lg-7" id="kt_toolbar">
        <!--begin::Page title-->
        <div class="page-title d-flex flex-column me-3">
            <!--begin::Title-->
            <h1 class="d-flex text-dark fw-bolder my-1 fs-3">{{ $user->full_name }} Kullanıcısına Atanmış İller, İlçeler ve
                Kurumlar</h1>
            <!--end::Title-->
            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-dot fw-bold text-gray-600 fs-7 my-1">
                <!--begin::Item-->
                <li class="breadcrumb-item text-gray-600">
                    <a href="{{ route('panel') }}" class="text-gray-600 text-hover-primary">Anasayfa</a>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item text-gray-600">Kullanıcı Yönetimi</li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item text-gray-600">{{ $user->full_name }} Kullanıcısına Atanmış İller, İlçeler ve
                    Kurumlar

                </li>
                <!--end::Item-->
            </ul>
            <!--end::Breadcrumb-->
        </div>
        <!--end::Page title-->
    </div>
    <!--end::Toolbar-->
    <div class="row">
        <div class="col-md-4">
            <div class="content flex-column-fluid" id="kt_content">
                <div class="card mb-5">
                    <!--begin::Header-->
                    <div class="card-header border-0 pt-5">
                        <div class="card-title">
                            <form method="get" class="d-flex">
                                <div class="d-flex">
                                    <div class="mb-2 me-3">
                                        <input type="text" name="il" class="form-control form-control-solid"
                                            value="{{ request()->get('il') }}" placeholder="İl Ara...">
                                    </div>
                                    <div>
                                        @if (request()->get('il'))
                                            <a href="{{ route('users.show', $user->id) }}" class="btn btn-light"><i
                                                    class="fas fa-sync"></i></a>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-toolbar">
                            <!--begin::Menu-->
                            <button type="button" class="btn btn-sm btn-icon btn-color-primary btn-active-light-primary"
                                data-bs-toggle="modal" data-bs-target="#provincesStore">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen024.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <i class="fas fa-plus text-success"></i>
                                </span>
                                <!--end::Svg Icon-->
                            </button>
                            <!--end::Menu-->
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
                                        <th class="ps-4 min-w-150px rounded-start">İl</th>
                                        <th class="text-end rounded-end"></th>
                                    </tr>
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody>
                                    @foreach ($provinces as $province)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="d-flex justify-content-start flex-column">
                                                        <span
                                                            class="text-dark fw-bolder text-hover-primary mb-1 fs-6">{{ $province->name }}</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-end">
                                                <input type="hidden" value="{{ $province->id }}" class="province_id">
                                                <input type="hidden" value="{{ $user->id }}" class="user_id">
                                                <button
                                                    class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm provinceDelete">
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
                                    @endforeach
                                </tbody>
                                <!--end::Table body-->
                            </table>
                            <!--end::Table-->
                        </div>
                        <!--end::Table container-->
                    </div>
                    <!--begin::Body-->
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="content flex-column-fluid" id="kt_content">
                <div class="card mb-5">
                    <!--begin::Header-->
                    <div class="card-header border-0 pt-5">
                        <div class="card-title">
                            <form method="get" class="d-flex">
                                <div class="d-flex">
                                    <div class="mb-2 me-3">
                                        <input type="text" name="ilce" class="form-control form-control-solid"
                                            value="{{ request()->get('ilce') }}" placeholder="İlçe Ara...">
                                    </div>
                                    <div>
                                        @if (request()->get('ilce'))
                                            <a href="{{ route('users.show', $user->id) }}" class="btn btn-light"><i
                                                    class="fas fa-sync"></i></a>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-toolbar">
                            <!--begin::Menu-->
                            <button type="button" class="btn btn-sm btn-icon btn-color-primary btn-active-light-primary"
                                data-bs-toggle="modal" data-bs-target="#districtsStore">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen024.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <i class="fas fa-plus text-success"></i>
                                </span>
                                <!--end::Svg Icon-->
                            </button>
                            <!--end::Menu-->
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
                                        <th class="ps-4 min-w-150px rounded-start">İlçe</th>
                                        <th class="text-end rounded-end"></th>
                                    </tr>
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody>
                                    @foreach ($districts as $district)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="d-flex justify-content-start flex-column">
                                                        <span
                                                            class="text-dark fw-bolder text-hover-primary mb-1 fs-6">{{ $district->name }}</span>
                                                        <span
                                                            class="text-muted fw-bold text-muted d-block fs-7">{{ $district->province->name ?? '' }}</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-end">
                                                <input type="hidden" value="{{ $district->id }}" class="district_id">
                                                <input type="hidden" value="{{ $user->id }}" class="user_id">
                                                <button
                                                    class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm districtDelete">
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
                                                <!--end::Menu-->
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <!--end::Table body-->
                            </table>
                            <!--end::Table-->
                        </div>
                        <!--end::Table container-->
                    </div>
                    <!--begin::Body-->
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="content flex-column-fluid" id="kt_content">
                <div class="card mb-5">
                    <!--begin::Header-->
                    <div class="card-header border-0 pt-5">
                        <div class="card-title">
                            <form method="get" class="d-flex">
                                <div class="d-flex">
                                    <div class="mb-2 me-3">
                                        <input type="text" name="kurum" class="form-control form-control-solid"
                                            value="{{ request()->get('kurum') }}" placeholder="Kurum Ara...">
                                    </div>
                                    <div>
                                        @if (request()->get('kurum'))
                                            <a href="{{ route('users.show', $user->id) }}" class="btn btn-light"><i
                                                    class="fas fa-sync"></i></a>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-toolbar">
                            <!--begin::Menu-->
                            <button type="button" class="btn btn-sm btn-icon btn-color-primary btn-active-light-primary"
                                data-bs-toggle="modal" data-bs-target="#organisationsStore">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen024.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <i class="fas fa-plus text-success"></i>
                                </span>
                                <!--end::Svg Icon-->
                            </button>
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
                                        <th class="ps-4 min-w-150px rounded-start">Kurum</th>
                                        <th class="text-end rounded-end"></th>
                                    </tr>
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody>
                                    @foreach ($organisations as $organisation)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="d-flex justify-content-start flex-column">
                                                        <span
                                                            class="text-dark fw-bolder text-hover-primary mb-1 fs-6">{{ $organisation->name }}</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-end">
                                                <input type="hidden" value="{{ $organisation->id }}"
                                                    class="organisation_id">
                                                <input type="hidden" value="{{ $user->id }}" class="user_id">
                                                <button
                                                    class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm organisationDelete">
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
                                                <!--end::Menu-->
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <!--end::Table body-->
                            </table>
                            <!--end::Table-->
                        </div>
                        <!--end::Table container-->
                    </div>
                    <!--begin::Body-->
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" id="provincesStore">
        <div class="modal-dialog mw-900px">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">İl Ekle</h5>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <span class="svg-icon svg-icon-2x">
                            <i class="fas fa-times fs-4"></i>
                        </span>
                    </div>
                    <!--end::Close-->
                </div>

                <form action="{{ route('users.provinces.store', $user->id) }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="province_id" class="form-label">İl</label>
                            <span class="text-danger d-block">{{ $errors->first('province_id') }}</span>
                            <select name="province_id" id="province_id" class="form-select form-select-solid"
                                data-control="select2" data-placeholder="İl Seçiniz" data-dropdown-parent="#provincesStore">
                                <option value=""></option>
                                @foreach ($selectboxProvinces as $province)
                                    <option value="{{ $province->id }}">{{ $province->name }}</option>
                                @endforeach
                            </select>
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
    <div class="modal fade" tabindex="-1" id="districtsStore">
        <div class="modal-dialog mw-900px">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">İlçe Ekle</h5>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <span class="svg-icon svg-icon-2x">
                            <i class="fas fa-times fs-4"></i>
                        </span>
                    </div>
                    <!--end::Close-->
                </div>

                <form action="{{ route('users.districts.store', $user->id) }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="district_id" class="form-label">İlçe</label>
                            <span class="text-danger d-block">{{ $errors->first('province_id') }}</span>
                            <select name="district_id" id="district_id" class="form-select form-select-solid"
                                data-control="select2" data-placeholder="İlçe Seçiniz"
                                data-dropdown-parent="#districtsStore">
                                <option value=""></option>
                                @foreach ($selectboxProvinces as $province)
                                    <optgroup label="{{ $province->name }}">
                                        @foreach ($province->districts as $district)
                                            <option value="{{ $district->id }}">{{ $district->name }}</option>
                                        @endforeach
                                    </optgroup>
                                @endforeach
                            </select>
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
    <div class="modal fade" tabindex="-1" id="organisationsStore">
        <div class="modal-dialog mw-900px">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Kurum Ekle</h5>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <span class="svg-icon svg-icon-2x">
                            <i class="fas fa-times fs-4"></i>
                        </span>
                    </div>
                    <!--end::Close-->
                </div>

                <form action="{{ route('users.organisations.store', $user->id) }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="organisation_id" class="form-label">Kurum</label>
                            <span class="text-danger d-block">{{ $errors->first('province_id') }}</span>
                            <select name="organisation_id" id="organisation_id" class="form-select form-select-solid"
                                data-control="select2" data-placeholder="İl Seçiniz"
                                data-dropdown-parent="#organisationsStore">
                                <option value=""></option>
                                @foreach ($selectboxOrganisations as $organisation)
                                    <option value="{{ $organisation->id }}">{{ $organisation->name }}</option>
                                @endforeach
                            </select>
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
@endsection
@section('js')
    <script>
        $("#dead_management").change(function() {
            $("#province_district_customization").toggleClass("d-none");
        });

        $(".provinceDelete").click(function(e) {
            e.preventDefault();

            var provinceId = $(this).closest("tr").find(".province_id").val();
            var userId = $(this).closest("tr").find(".user_id").val();

            Swal.fire({
                title: 'Emin misniz?',
                text: "Kullanıcıya atanmış bu ili silmek istiyor musunuz? Bu işlem geri alınamaz!",
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
                        "id": userId,
                    };

                    $.ajax({
                        type: "GET",
                        url: "/panel/kullanicilar/" + userId + "/il-sil/" + provinceId,
                        data: data,
                        success: function() {
                            Swal.fire({
                                title: 'Silindi!',
                                text: 'İl başarıyla silindi.',
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
        $(".districtDelete").click(function(e) {
            e.preventDefault();

            var districtId = $(this).closest("tr").find(".district_id").val();
            var userId = $(this).closest("tr").find(".user_id").val();

            Swal.fire({
                title: 'Emin misniz?',
                text: "Kullanıcıya atanmış bu ilçeyi silmek istiyor musunuz? Bu işlem geri alınamaz!",
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
                        "id": userId,
                    };

                    $.ajax({
                        type: "GET",
                        url: "/panel/kullanicilar/" + userId + "/ilce-sil/" + districtId,
                        data: data,
                        success: function() {
                            Swal.fire({
                                title: 'Silindi!',
                                text: 'İlçe başarıyla silindi.',
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
        $(".organisationDelete").click(function(e) {
            e.preventDefault();

            var organisationId = $(this).closest("tr").find(".organisation_id").val();
            var userId = $(this).closest("tr").find(".user_id").val();

            Swal.fire({
                title: 'Emin misniz?',
                text: "Kullanıcıya atanmış bu kurumu silmek istiyor musunuz? Bu işlem geri alınamaz!",
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
                        "id": userId,
                    };

                    $.ajax({
                        type: "GET",
                        url: "/panel/kullanicilar/" + userId + "/kurum-sil/" + organisationId,
                        data: data,
                        success: function() {
                            Swal.fire({
                                title: 'Silindi!',
                                text: 'Kurum başarıyla silindi.',
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
    </script>
@endsection
