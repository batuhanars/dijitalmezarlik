@extends('back.layout.main')
@section('title', 'Kullanıcılar')
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
            <h1 class="d-flex text-dark fw-bolder my-1 fs-3">Kullanıcılar</h1>
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
                <li class="breadcrumb-item text-gray-600">Kullanıcılar</li>
                <!--end::Item-->
            </ul>
            <!--end::Breadcrumb-->
        </div>
        <!--end::Page title-->
        <!--begin::Actions-->
        <div class="d-flex align-items-center py-2 py-md-1">
            <!--begin::Button-->
            <a href="#" class="btn btn-dark fw-bolder" data-bs-toggle="modal" data-bs-target="#add_user"
                id="kt_toolbar_primary_button"><i class="fas fa-plus"></i> Kullanıcı Ekle</a>
            <!--end::Button-->
        </div>
        <!--end::Actions-->
    </div>
    <!--end::Toolbar-->
    <div class="content flex-column-fluid" id="kt_content">
        <div class="row">
            <div class="card mb-5 mb-xl-8">
                <!--begin::Header-->
                <div class="card-header border-0 pt-5">
                    <div class="card-title">
                        <form method="get" class="d-flex">
                            <div class="d-flex">
                                <div class="mb-2 me-3">
                                    <input type="text" name="kullanici" class="form-control form-control-solid"
                                        value="{{ request()->get('kullanici') }}" placeholder="Kullanıcı Ara...">
                                </div>
                                <div>
                                    @if (request()->get('kullanici'))
                                        <a href="{{ route('users.index') }}" class="btn btn-light"><i
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
                                    <th class="ps-4 min-w-325px rounded-start">Kullanıcı</th>
                                    <th class="min-w-200px">Telefon</th>
                                    <th class="min-w-200px">Adres</th>
                                    <th class="min-w-200px text-end rounded-end"></th>
                                </tr>
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody>
                                @forelse ($users as $user)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="symbol symbol-50px me-5">
                                                    @if ($user->image !== null)
                                                        <img src="{{ $user->image }}" />
                                                    @else
                                                        <span
                                                            class="ms-5 me-5 fs-1 text-muted">{{ mb_substr(strtoupper($user->full_name), 0, 1, 'UTF-8') }}</span>
                                                    @endif
                                                </div>
                                                <div class="d-flex justify-content-start flex-column">
                                                    <a href="#"
                                                        class="text-dark fw-bolder text-hover-primary mb-1 fs-6">
                                                        @foreach (explode(' ', $user->full_name) as $name)
                                                            {{ Str::ucfirst(Str::lower($name)) }}
                                                        @endforeach
                                                    </a>
                                                    <span
                                                        class="text-muted fw-bold text-muted d-block fs-7">{{ $user->email }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span
                                                class="text-muted fw-bold text-muted d-block fs-7">{{ $user->phone }}</span>
                                        </td>
                                        <td>
                                            <span
                                                class="text-muted fw-bold text-muted d-block fs-7">{{ $user->address }}</span>
                                        </td>
                                        <td class="text-end">
                                            <form action="{{ route('users.updateStatus', $user->id) }}" method="post"
                                                style="display: inline-block">
                                                @csrf
                                                @method('PATCH')
                                                @if ($user->status == 0)
                                                    <input type="hidden" name="status" value="1">
                                                    <button class="btn btn-icon btn-bg-light btn-light-success btn-sm">
                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
                                                        <span class="svg-icon svg-icon-3">
                                                            <i class="fas fa-check"></i>
                                                        </span>
                                                        <!--end::Svg Icon-->
                                                    </button>
                                                @else
                                                    <input type="hidden" name="status" value="0">
                                                    <button class="btn btn-icon btn-bg-light btn-light-danger btn-sm">
                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
                                                        <span class="svg-icon svg-icon-3">
                                                            <i class="fas fa-times"></i>
                                                        </span>
                                                        <!--end::Svg Icon-->
                                                    </button>
                                                @endif
                                            </form>
                                            <a href="#"
                                                class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"
                                                data-bs-toggle="modal" data-bs-target="#authority"
                                                data-userid="{{ $user->id }}"
                                                data-sitemanagement="{{ $user->role->site_management }}"
                                                data-usermanagement="{{ $user->role->user_management }}"
                                                data-pagemanagement="{{ $user->role->page_management }}"
                                                data-slidermanagement="{{ $user->role->slider_management }}"
                                                data-cemeterymanagement="{{ $user->role->cemetery_management }}"
                                                data-deadmanagement="{{ $user->role->dead_management }}"
                                                data-prayermanagement="{{ $user->role->prayer_management }}"
                                                data-notificationmanagement="{{ $user->role->notification_management }}"
                                                data-organisationmanagement="{{ $user->role->organisation_management }}"
                                                data-funeralmanagement="{{ $user->role->funeral_management }}"
                                                data-productmanagement="{{ $user->role->product_management }}"
                                                data-status="{{ $user->province_district_customization }}">
                                                <!--begin::Svg Icon | path: icons/duotune/general/gen019.svg-->
                                                <span class="svg-icon svg-icon-3">
                                                    <i class="fas fa-scroll"></i>
                                                </span>
                                                <!--end::Svg Icon-->
                                            </a>
                                            <a href="{{ route('users.show', $user->id) }}"
                                                class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
                                                <!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
                                                <span class="svg-icon svg-icon-3">
                                                    <i class="fas fa-eye"></i>
                                                </span>
                                                <!--end::Svg Icon-->
                                            </a>
                                            <input type="hidden" value="{{ $user->id }}" class="user_id">
                                            <button
                                                class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm userDelete">
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
                                        kullanıcı yok!</div>
                                @endforelse
                            </tbody>
                            <!--end::Table body-->
                        </table>
                        <!--end::Table-->
                    </div>
                    <!--end::Table container-->
                    <div class="d-flex flex-stack flex-wrap">
                        <div class="fs-6 fw-bold text-gray-700">{{ $users->total() }} kayıttan
                            {{ $users->firstItem() }} ile {{ $users->lastItem() }} arası
                            gösteriliyor </div>
                        <!--begin::Pages-->
                        {{ $users->links('vendor.pagination.bootstrap-4') }}
                        <!--end::Pages-->
                    </div>
                </div>
                <!--begin::Body-->
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" id="add_user">
        <div class="modal-dialog mw-900px">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Kullanıcı Ekle</h5>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <span class="svg-icon svg-icon-2x">
                            <i class="fas fa-times fs-4"></i>
                        </span>
                    </div>
                    <!--end::Close-->
                </div>

                <form action="{{ route('users.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group mb-5">
                            <label for="image" class="form-label">Kullanıcı Resmi</label>
                            <span class="text-danger d-block">{{ $errors->first('image') }}</span>
                            <input type="file" name="image" id="image" class="form-control form-control-solid">
                        </div>
                        <div class="row">
                            <div class="form-group mb-5 col-md-4">
                                <label for="province_id" class="form-label">İl</label>
                                <span class="text-danger d-block">{{ $errors->first('provinces') }}</span>
                                <select name="provinces[]" id="province_id" class="form-select form-select-solid"
                                    data-control="select2" data-placeholder="İl Seçiniz" data-dropdown-parent="#add_user"
                                    multiple>
                                    <option value=""></option>
                                    @foreach ($provinces as $province)
                                        <option value="{{ $province->id }}">{{ $province->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-5 col-md-4">
                                <label for="district_id" class="form-label">İlçe</label>
                                <span class="text-danger d-block">{{ $errors->first('districts') }}</span>
                                <select name="districts[]" id="district_id" class="form-select form-select-solid"
                                    data-control="select2" data-placeholder="İlçe Seçiniz"
                                    data-dropdown-parent="#add_user" multiple>
                                    <option value=""></option>
                                </select>
                            </div>
                            <div class="form-group mb-5 col-md-4">
                                <label for="organisation_id" class="form-label">Kurum</label>
                                <span class="text-danger d-block">{{ $errors->first('organisations') }}</span>
                                <select name="organisations[]" id="organisation_id" data-dropdown-parent="#add_user"
                                    class="form-select form-select-solid" data-control="select2" multiple>
                                    <option value="0" selected>Tüm Kurumlar</option>
                                    @foreach ($organisations as $organisation)
                                        <option value="{{ $organisation->id }}">{{ $organisation->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group mb-5 col-md-6">
                                <label for="first_name" class="form-label">İsim</label>
                                <span class="text-danger d-block">{{ $errors->first('first_name') }}</span>
                                <input type="text" name="first_name" id="first_name"
                                    class="form-control form-control-solid" placeholder="İsim giriniz"
                                    autocomplete="off">
                            </div>
                            <div class="form-group mb-5 col-md-6">
                                <label for="last_name" class="form-label">Soyisim</label>
                                <span class="text-danger d-block">{{ $errors->first('last_name') }}</span>
                                <input type="text" name="last_name" id="last_name"
                                    class="form-control form-control-solid" placeholder="Soyisim giriniz"
                                    autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group mb-5">
                            <label for="email" class="form-label">Email</label>
                            <span class="text-danger d-block">{{ $errors->first('email') }}</span>
                            <input type="text" name="email" id="email" class="form-control form-control-solid"
                                placeholder="Email Giriniz" autocomplete="off">
                        </div>
                        <div class="form-group mb-5">
                            <label for="phone" class="form-label">Telefon</label>
                            <span class="text-danger d-block">{{ $errors->first('phone') }}</span>
                            <input type="text" name="phone" id="phone" class="form-control form-control-solid"
                                placeholder="Telefon Giriniz" autocomplete="off">
                        </div>
                        <div class="form-group mb-5">
                            <label for="address" class="form-label">Adres</label>
                            <span class="text-danger d-block">{{ $errors->first('addrees') }}</span>
                            <input type="text" name="address" id="address" class="form-control form-control-solid"
                                placeholder="Adres Giriniz" autocomplete="off">
                        </div>
                        <div class="form-group mb-5">
                            <label for="password" class="form-label">Parola</label>
                            <span class="text-danger d-block">{{ $errors->first('password') }}</span>
                            <input type="password" name="password" id="password"
                                class="form-control form-control-solid" placeholder="Parola Giriniz">
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
    <div class="modal fade" tabindex="-1" id="authority">
        <div class="modal-dialog mw-900px">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Yetkiler</h5>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <span class="svg-icon svg-icon-2x">
                            <i class="fas fa-times fs-4"></i>
                        </span>
                    </div>
                    <!--end::Close-->
                </div>

                <form action="{{ route('roles.update') }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <input type="hidden" name="user_id" id="user_id">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card mb-5 bg-gray-100">
                                    <div class="card-header">
                                        <!--begin::Label-->
                                        <div class="card-title">
                                            <label for="site_management" class="fs-6 fw-bold form-label">Site
                                                Yönetimi</label>
                                        </div>
                                        <!--end::Label-->
                                        <div class="card-toolbar">
                                            <!--begin::Switch-->
                                            <label class="form-check form-switch form-check-custom form-check-solid">
                                                <input class="form-check-input" name="site_management"
                                                    id="site_management" type="checkbox" />
                                            </label>
                                            <!--end::Switch-->
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-5 bg-gray-100">
                                    <div class="card-header">
                                        <!--begin::Label-->
                                        <div class="card-title">
                                            <label for="page_management" class="fs-6 fw-bold form-label">Sayfa
                                                Yönetimi</label>
                                        </div>
                                        <!--end::Label-->
                                        <div class="card-toolbar">
                                            <!--begin::Switch-->
                                            <label class="form-check form-switch form-check-custom form-check-solid">
                                                <input class="form-check-input" name="page_management"
                                                    id="page_management" type="checkbox" />
                                            </label>
                                            <!--end::Switch-->
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-5 bg-gray-100">
                                    <div class="card-header">
                                        <!--begin::Label-->
                                        <div class="card-title">
                                            <label for="cemetery_management" class="fs-6 fw-bold form-label">Mezarlık
                                                Yönetimi</label>
                                        </div>
                                        <!--end::Label-->
                                        <div class="card-toolbar">
                                            <!--begin::Switch-->
                                            <label class="form-check form-switch form-check-custom form-check-solid">
                                                <input class="form-check-input" name="cemetery_management"
                                                    id="cemetery_management" type="checkbox" />
                                            </label>
                                            <!--end::Switch-->
                                        </div>
                                    </div>
                                </div>
                                <div class="card bg-gray-100">
                                    <div class="card-header">
                                        <!--begin::Label-->
                                        <div class="card-title">
                                            <label for="prayer_management" class="fs-6 fw-bold form-label">Dua
                                                Yönetimi</label>
                                        </div>
                                        <!--end::Label-->
                                        <div class="card-toolbar">
                                            <!--begin::Switch-->
                                            <label class="form-check form-switch form-check-custom form-check-solid">
                                                <input class="form-check-input" name="prayer_management"
                                                    id="prayer_management" type="checkbox" />
                                            </label>
                                            <!--end::Switch-->
                                        </div>
                                    </div>
                                </div>
                                <div class="card bg-gray-100 mt-5">
                                    <div class="card-header">
                                        <!--begin::Label-->
                                        <div class="card-title">
                                            <label for="organisation_management" class="fs-6 fw-bold form-label">Kurum
                                                Yönetimi</label>
                                        </div>
                                        <!--end::Label-->
                                        <div class="card-toolbar">
                                            <!--begin::Switch-->
                                            <label class="form-check form-switch form-check-custom form-check-solid">
                                                <input class="form-check-input" name="organisation_management"
                                                    id="organisation_management" type="checkbox" />
                                            </label>
                                            <!--end::Switch-->
                                        </div>
                                    </div>
                                </div>
                                <div class="card bg-gray-100 mt-5">
                                    <div class="card-header">
                                        <!--begin::Label-->
                                        <div class="card-title">
                                            <label for="product_management" class="fs-6 fw-bold form-label">Ürün
                                                Yönetimi</label>
                                        </div>
                                        <!--end::Label-->
                                        <div class="card-toolbar">
                                            <!--begin::Switch-->
                                            <label class="form-check form-switch form-check-custom form-check-solid">
                                                <input class="form-check-input" name="product_management"
                                                    id="product_management" type="checkbox" />
                                            </label>
                                            <!--end::Switch-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card mb-5 bg-gray-100">
                                    <div class="card-header">
                                        <!--begin::Label-->
                                        <div class="card-title">
                                            <label for="user_management" class="fs-6 fw-bold form-label">Kullanıcı
                                                Yönetimi</label>
                                        </div>
                                        <!--end::Label-->
                                        <div class="card-toolbar">
                                            <!--begin::Switch-->
                                            <label class="form-check form-switch form-check-custom form-check-solid">
                                                <input class="form-check-input" name="user_management"
                                                    id="user_management" type="checkbox" />
                                            </label>
                                            <!--end::Switch-->
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-5 bg-gray-100">
                                    <div class="card-header">
                                        <!--begin::Label-->
                                        <div class="card-title">
                                            <label for="slider_management" class="fs-6 fw-bold form-label">Slider
                                                Yönetimi</label>
                                        </div>
                                        <!--end::Label-->
                                        <div class="card-toolbar">
                                            <!--begin::Switch-->
                                            <label class="form-check form-switch form-check-custom form-check-solid">
                                                <input class="form-check-input" name="slider_management"
                                                    id="slider_management" type="checkbox" />
                                            </label>
                                            <!--end::Switch-->
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-5 bg-gray-100">
                                    <div class="card-header">
                                        <!--begin::Label-->
                                        <div class="card-title">
                                            <label for="dead_management" class="fs-6 fw-bold form-label">Mevta
                                                Yönetimi</label>
                                        </div>
                                        <!--end::Label-->
                                        <div class="card-toolbar">
                                            <!--begin::Switch-->
                                            <label class="form-check form-switch form-check-custom form-check-solid">
                                                <input class="form-check-input" name="dead_management"
                                                    id="dead_management" type="checkbox" />
                                            </label>
                                            <!--end::Switch-->
                                        </div>
                                    </div>
                                </div>
                                <div class="card bg-gray-100">
                                    <div class="card-header">
                                        <!--begin::Label-->
                                        <div class="card-title">
                                            <label for="notification_management" class="fs-6 fw-bold form-label">Bildirim
                                                Yönetimi</label>
                                        </div>
                                        <!--end::Label-->
                                        <div class="card-toolbar">
                                            <!--begin::Switch-->
                                            <label class="form-check form-switch form-check-custom form-check-solid">
                                                <input class="form-check-input" name="notification_management"
                                                    id="notification_management" type="checkbox" />
                                            </label>
                                            <!--end::Switch-->
                                        </div>
                                    </div>
                                </div>
                                <div class="card bg-gray-100 mt-5">
                                    <div class="card-header">
                                        <!--begin::Label-->
                                        <div class="card-title">
                                            <label for="funeral_management" class="fs-6 fw-bold form-label">Cenaze
                                                Yönetimi</label>
                                        </div>
                                        <!--end::Label-->
                                        <div class="card-toolbar">
                                            <!--begin::Switch-->
                                            <label class="form-check form-switch form-check-custom form-check-solid">
                                                <input class="form-check-input" name="funeral_management"
                                                    id="funeral_management" type="checkbox" />
                                            </label>
                                            <!--end::Switch-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="separator my-10"></div>
                        <div class="card {{ Auth::user()->role->dead_management == 1 ? '' : 'd-none' }}"
                            id="province_district_customization">
                            <div class="card-title">
                                <h5>Mevta Yönetimi İl İlçe Özelleştirme</h5>
                            </div>
                            <div class="card-body">
                                <!--begin:Option-->
                                <label class="d-flex flex-stack mb-5 cursor-pointer">
                                    <!--begin:Label-->
                                    <span class="d-flex align-items-center me-2">
                                        <!--begin:Info-->
                                        <span class="d-flex flex-column">
                                            <span class="fw-bolder fs-6">Tüm İl ve İlçeye Mevta eklesin mi?</span>
                                        </span>
                                        <!--end:Info-->
                                    </span>
                                    <!--end:Label-->

                                    <!--begin:Input-->
                                    <span class="form-check form-check-custom form-check-solid">
                                        <input class="form-check-input" type="radio" id="status1" name="status" />
                                    </span>
                                    <!--end:Input-->
                                </label>
                                <!--end::Option-->

                                <!--begin:Option-->
                                <label class="d-flex flex-stack mb-5 cursor-pointer">
                                    <!--begin:Label-->
                                    <span class="d-flex align-items-center me-2">
                                        <!--begin:Info-->
                                        <span class="d-flex flex-column">
                                            <span class="fw-bolder fs-6">Bu kullanıcıya verilmiş il bilgisine göre mi
                                                mevta
                                                eklesin?</span>
                                        </span>
                                        <!--end:Info-->
                                    </span>
                                    <!--end:Label-->

                                    <!--begin:Input-->
                                    <span class="form-check form-check-custom form-check-solid">
                                        <input class="form-check-input" type="radio" id="status2" name="status" />
                                    </span>
                                    <!--end:Input-->
                                </label>
                                <!--end::Option-->

                                <!--begin:Option-->
                                <label class="d-flex flex-stack cursor-pointer">
                                    <!--begin:Label-->
                                    <span class="d-flex align-items-center me-2">
                                        <!--begin:Info-->
                                        <span class="d-flex flex-column">
                                            <span class="fw-bolder fs-6">Bu kullanıcıya verilmiş il ilçe bilgisine göre
                                                mi
                                                mevta eklesin?</span>
                                        </span>
                                        <!--end:Info-->
                                    </span>
                                    <!--end:Label-->

                                    <!--begin:Input-->
                                    <span class="form-check form-check-custom form-check-solid">
                                        <input class="form-check-input" type="radio" id="status3" name="status" />
                                    </span>
                                    <!--end:Input-->
                                </label>
                                <!--end::Option-->
                            </div>
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
    @if ($errors->any())
        <script>
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: "Kullanıcı eklerken bir sorun oluştu! Alanlardan herhangi biri boş olabilir.",
                showConfirmButton: false,
                timer: 1500
            })
        </script>
    @endif
    <script>
        Inputmask({
            "mask": "(999) 999-9999"
        }).mask("#phone");
        $("#authority").on("show.bs.modal", function(event) {
            var button = $(event.relatedTarget)

            var userid = button.data("userid")
            var status = button.data("status")
            var sitemanagement = button.data("sitemanagement")
            var usermanagement = button.data("usermanagement")
            var pagemanagement = button.data("pagemanagement")
            var slidermanagement = button.data("slidermanagement")
            var cemeterymanagement = button.data("cemeterymanagement")
            var deadmanagement = button.data("deadmanagement")
            var prayermanagement = button.data("prayermanagement")
            var notificationmanagement = button.data("notificationmanagement")
            var organisationmanagement = button.data("organisationmanagement")
            var funeralmanagement = button.data("funeralmanagement")
            var productmanagement = button.data("productmanagement")
            var modal = $(this)

            modal.find(".modal-body #user_id").val(userid)
            modal.find(".modal-body #site_management").val(sitemanagement).prop("checked", sitemanagement == 1 ?
                true : false)
            modal.find(".modal-body #user_management").val(usermanagement).prop("checked", usermanagement == 1 ?
                true : false)
            modal.find(".modal-body #page_management").val(pagemanagement).prop("checked", pagemanagement == 1 ?
                true : false)
            modal.find(".modal-body #slider_management").val(slidermanagement).prop("checked", slidermanagement ==
                1 ?
                true : false)
            modal.find(".modal-body #cemetery_management").val(cemeterymanagement).prop("checked",
                cemeterymanagement == 1 ?
                true : false)
            modal.find(".modal-body #dead_management").val(deadmanagement).prop("checked", deadmanagement == 1 ?
                true : false)
            modal.find(".modal-body #prayer_management").val(prayermanagement).prop("checked", prayermanagement ==
                1 ?
                true : false)
            modal.find(".modal-body #notification_management").val(notificationmanagement).prop("checked",
                notificationmanagement == 1 ?
                true : false)
            modal.find(".modal-body #organisation_management").val(organisationmanagement).prop("checked",
                organisationmanagement == 1 ?
                true : false)
            modal.find(".modal-body #funeral_management").val(funeralmanagement).prop("checked",
                funeralmanagement == 1 ?
                true : false)
            modal.find(".modal-body #product_management").val(productmanagement).prop("checked",
                productmanagement == 1 ?
                true : false)

            modal.find(".modal-body #status1").val(0).prop("checked", status == 0 ? true : false)
            modal.find(".modal-body #status2").val(1).prop("checked", status == 1 ? true : false)
            modal.find(".modal-body #status3").val(2).prop("checked", status == 2 ? true : false)
        });

        $(document).ready(function() {
            $("#district_id").prop("disabled", true);
            $("#province_id").change(function() {
                var provinceId = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "{{ route('districts.user-page') }}",
                    data: {
                        "province_id": provinceId,
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function(value) {
                        $("#district_id").prop("disabled", false)
                        $("#district_id").html(value)
                    }
                })
            });
        });

        $(document).ready(function() {
            $("#edit_district_id").prop("disabled", true);
            $("#edit_province_id").change(function() {
                var provinceId = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "{{ route('districts.user-page') }}",
                    data: {
                        "province_id": provinceId,
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function(value) {
                        $("#edit_district_id").prop("disabled", false)
                        $("#edit_district_id").html(value)
                    }
                })
            });
        });

        $(".userDelete").click(function(e) {
            e.preventDefault();

            var userId = $(this).closest("tr").find(".user_id").val();

            Swal.fire({
                title: 'Emin misniz?',
                text: "Kullanıcıyı silmek istiyor musunuz? Bu işlem geri alınamaz!",
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
                        url: "/panel/kullanici-sil/" + userId,
                        data: data,
                        success: function() {
                            Swal.fire({
                                title: 'Silindi!',
                                text: 'Kullanıcı başarıyla silindi.',
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
