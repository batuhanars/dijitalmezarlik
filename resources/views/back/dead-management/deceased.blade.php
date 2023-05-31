@extends('back.layout.main')
@section('title', 'Vefat Edenler')
@section('content')
    <!--begin::Toolbar-->
    <div class="toolbar mb-5 mb-lg-7" id="kt_toolbar">
        <!--begin::Page title-->
        <div class="page-title d-flex flex-column me-3">
            <!--begin::Title-->
            <h1 class="d-flex text-dark fw-bolder my-1 fs-3">Vefat Edenler</h1>
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
                <li class="breadcrumb-item text-gray-600">Vefat Edenler</li>
                <!--end::Item-->
            </ul>
            <!--end::Breadcrumb-->
        </div>
        <!--end::Page title-->
        <!--begin::Actions-->
        <div class="d-flex align-items-center py-2 py-md-1">
            <!--begin::Button-->
            <a href="#" class="btn btn-dark fw-bolder" data-bs-toggle="modal" data-bs-target="#add_dead"
                id="kt_toolbar_primary_button"><i class="fas fa-plus"></i> Mevta Ekle</a>
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
                                    <input type="text" name="mevta" class="form-control form-control-solid"
                                        value="{{ request()->get('mevta') }}" placeholder="Ad Soyad">
                                </div>
                                <div class="w-200px mb-2 me-3">
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
                                <div class="w-200px mb-2 me-3">
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
                                <div class="w-200px mb-2 me-3">
                                    <select name="mahalle" id="search_neighborhood" class="form-select form-select-solid"
                                        data-control="select2" data-placeholder="Mahalle Seçiniz">
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
                                <div class="w-200px mb-2 me-3">
                                    <select name="mezarlik" id="search_cemetery" class="form-select form-select-solid"
                                        data-control="select2" data-placeholder="Mezarlık Seçiniz"
                                        onchange="this.form.submit()">
                                        <option value=""></option>
                                        @empty(!$cemeteries)
                                            @foreach ($cemeteries as $cemetery)
                                                <option @if (request()->get('mezarlik') == $cemetery->id) selected @endif
                                                    value="{{ $cemetery->id }}">
                                                    {{ $cemetery->title }}</option>
                                            @endforeach
                                        @endempty
                                    </select>
                                </div>
                                <div>
                                    @if (request()->get('mevta') || request()->get('il') || request()->get('ilce') || request()->get('kurum'))
                                        <a href="{{ route('deceased.index') }}" class="btn btn-light"><i
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
                                    <th class="ps-4 max-w-200px rounded-start">Mevta</th>
                                    <th class="max-w-110px">Oluşturan</th>
                                    <th class="max-w-125px">Doğum Yeri</th>
                                    <th class="max-w-125px">Meslek</th>
                                    <th class="max-w-125px">Mezarlık</th>
                                    <th class="max-w-125px">Medeni Hali</th>
                                    <th class="max-w-125px">Doğum Tarihi</th>
                                    <th class="max-w-125px">Ölüm Tarihi</th>
                                    <th class="max-w-125px">Kayıt Tarihi</th>
                                    <th class="text-end rounded-end"></th>
                                </tr>
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody>
                                @forelse ($deceased as $dead)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="symbol symbol-50px me-5">
                                                    @if ($dead->image !== null)
                                                        <img src="{{ $dead->image }}" class="" />
                                                    @else
                                                        <span
                                                            class="ms-5 me-5 fs-1 text-muted">{{ mb_substr(strtoupper($dead->full_name), 0, 1, 'UTF-8') }}</span>
                                                    @endif
                                                </div>
                                                <div class="d-flex justify-content-start flex-column">
                                                    <a href="#"
                                                        class="text-dark fw-bolder text-hover-primary mb-1 fs-6">
                                                        {{ $dead->full_name }}
                                                        {{-- @foreach (explode(' ', $dead->full_name) as $name)
                                                            {{ Str::ucfirst(Str::lower($name)) }}
                                                        @endforeach --}}
                                                    </a>
                                                    @if ($dead->country_id == '190')
                                                        <span
                                                            class="text-muted fw-bold text-muted d-block fs-7">{{ ($dead->province ? $dead->province->name : '') . ' ' . ($dead->district ? $dead->district->name : '') . ' ' . ($dead->neighborhood ? $dead->neighborhood->name : '') }}</span>
                                                    @else
                                                        <span
                                                            class="text-muted fw-bold text-muted d-block fs-7">{{ $dead->province_name . ' ' . $dead->district_name . ' ' . $dead->neighborhood_name }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="text-muted fw-bold d-block fs-7">
                                                {{ $dead->creator->full_name ?? 'Ziyaretçi' }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="text-muted fw-bold d-block fs-7">
                                                {{ $dead->place_of_birth }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="text-muted fw-bold d-block fs-7">{{ $dead->job }}</span>
                                        </td>
                                        <td>
                                            @if ($dead->country_id == '190')
                                                <span
                                                    class="text-muted fw-bold d-block fs-7">{{ $dead->cemetery ? $dead->cemetery->title : $dead->cemetery_name }}</span>
                                            @else
                                                <span
                                                    class="text-muted fw-bold d-block fs-7">{{ $dead->cemetery_name }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($dead->is_married == 0)
                                                <span class="badge badge-light fs-7 fw-bold">Bekar</span>
                                            @else
                                                <span class="badge badge-light-success fs-7 fw-bold">Evli</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span
                                                class="badge badge-light-primary fs-7 fw-bold">{{ $dead->day_of_birth . '.' . $dead->month_of_birth . '.' . $dead->year_of_birth }}</span>
                                        </td>
                                        <td>
                                            <span
                                                class="badge badge-light-danger fs-7 fw-bold">{{ $dead->day_of_death . '.' . $dead->month_of_death . '.' . $dead->year_of_death }}</span>
                                        </td>
                                        <td>
                                            <span
                                                class="badge badge-light-success fs-7 fw-bold">{{ $dead->created_at->format('d.m.Y') }}</span>
                                        </td>
                                        <td class="text-end">
                                            @if ($dead->creator_id == null)
                                                <form action="{{ route('deceased.updateStatus', $dead->id) }}"
                                                    method="post" style="display: inline-block">
                                                    @csrf
                                                    @method('PUT')
                                                    @if ($dead->status == 0)
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
                                            @endif
                                            <a href="{{ route('deceased.edit', $dead->id) }}"
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
                                            <input type="hidden" value="{{ $dead->id }}" class="dead_id">
                                            <button
                                                class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm deadDelete">
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
                                        mevta yok!</div>
                                @endforelse
                            </tbody>
                            <!--end::Table body-->
                        </table>
                        <!--end::Table-->
                    </div>
                    <!--end::Table container-->
                    <div class="d-flex flex-stack flex-wrap">
                        <div class="fs-6 fw-bold text-gray-700">{{ $deceased->total() }} kayıttan
                            {{ $deceased->firstItem() }} ile {{ $deceased->lastItem() }} arası
                            gösteriliyor </div>
                        <!--begin::Pages-->
                        {{ $deceased->links('vendor.pagination.bootstrap-4') }}
                        <!--end::Pages-->
                    </div>
                </div>
                <!--begin::Body-->
            </div>
        </div>
    </div>
    <!--end::Post-->
    <div class="modal fade" tabindex="-1" id="add_dead">
        <div class="modal-dialog mw-900px">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Mevta Ekle</h5>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <span class="svg-icon svg-icon-2x">
                            <i class="fas fa-times fs-4"></i>
                        </span>
                    </div>
                    <!--end::Close-->
                </div>

                <form action="{{ route('deceased.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="creator_id" value="{{ Auth::user()->id }}">
                    <div class="modal-body">
                        <div class="form-group mb-5">
                            <label for="image" class="form-label">Mevta Resmi</label>
                            <span class="text-danger d-block">{{ $errors->first('image') }}</span>
                            <input type="file" name="image" id="image" class="form-control form-control-solid">
                        </div>
                        <div class="form-group mb-5">
                            <label for="country_id" class="form-label">Ülke</label>
                            <select name="country_id" id="country_id" data-control="select2"
                                data-dropdown-parent="#add_dead" class="form-select form-select-solid"
                                style="width: 100%">
                                @foreach ($countries as $country)
                                    <option @if ($country->title == 'Türkiye') selected @endif
                                        value="{{ $country->id }}">{{ $country->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row" id="selectValue">
                            @if (Auth::user()->province_district_customization == 0)
                                <div class="form-group col-md-6 mb-5">
                                    <label for="province_id" class="form-label">İl</label>
                                    <span class="text-danger d-block">{{ $errors->first('province_id') }}</span>
                                    <select name="province_id" id="province_id" class="form-select form-select-solid"
                                        data-control="select2" data-placeholder="İl Seçiniz"
                                        data-dropdown-parent="#add_dead">
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
                                        data-control="select2" data-placeholder="İlçe Seçiniz"
                                        data-dropdown-parent="#add_dead">
                                        <option value=""></option>
                                    </select>
                                </div>
                            @elseif(Auth::user()->province_district_customization == 1)
                                <div class="form-group col-md-12 mb-5">
                                    <label for="province_id" class="form-label">İl</label>
                                    <span class="text-danger d-block">{{ $errors->first('province_id') }}</span>
                                    <select name="province_id" id="province_id" class="form-select form-select-solid"
                                        data-control="select2" data-placeholder="İl Seçiniz"
                                        data-dropdown-parent="#add_dead">
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
                                        data-control="select2" data-placeholder="İl Seçiniz"
                                        data-dropdown-parent="#add_dead">
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
                                        data-control="select2" data-placeholder="İlçe Seçiniz"
                                        data-dropdown-parent="#add_dead">
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
                                data-control="select2" data-placeholder="Mezarlık Seçiniz"
                                data-dropdown-parent="#add_dead">
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
                                data-control="select2" data-placeholder="Kurum Seçiniz" data-dropdown-parent="#add_dead"
                                multiple>
                                <option value=""></option>
                                @forelse ($organisations as $organisation)
                                    <option value="{{ $organisation->id }}">{{ $organisation->name }}</option>
                                @empty
                                    <option value=""></option>
                                @endforelse
                            </select>
                        </div>
                        <div class="form-group mb-5">
                            <label for="address" class="form-label">Adres</label>
                            <span class="text-danger d-block">{{ $errors->first('address') }}</span>
                            <input type="text" id=addressp" name="address" class="form-control form-control-solid"
                                placeholder="Adres" autocomplete="off" value="{{ old('address') }}">
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
                                {{-- <input type="text" name="job" id="job"
                                    class="form-control form-control-solid" placeholder="Meslek" autocomplete="off"
                                    value="{{ old('job') }}"> --}}
                                <select name="job" id="job" class="form-select form-select-solid"
                                    data-control="select2" data-placeholder="Meslek Seçiniz"
                                    data-dropdown-parent="#add_dead">
                                    <option value=""></option>
                                    @foreach ($jobs as $job)
                                        <option value="{{ $job->title }}">{{ $job->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group mb-5">
                            <label for="gender" class="form-label">Cinsiyet</label>
                            <select name="gender" id="gender" class="form-select form-select-solid"
                                style="width: 100%">
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
                                    data-control="select2" data-placeholder="Doğum Günü" data-hide-search="true">
                                    <option value=""></option>
                                    <option value="01">01</option>
                                    <option value="02">02</option>
                                    <option value="03">03</option>
                                    <option value="04">04</option>
                                    <option value="05">05</option>
                                    <option value="06">06</option>
                                    <option value="07">07</option>
                                    <option value="08">08</option>
                                    <option value="09">09</option>
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
                                    data-control="select2" data-placeholder="Doğum Ayı" data-hide-search="true">
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
                                    data-control="select2" data-placeholder="Ölüm Günü" data-hide-search="true">
                                    <option value=""></option>
                                    <option value="01">01</option>
                                    <option value="02">02</option>
                                    <option value="03">03</option>
                                    <option value="04">04</option>
                                    <option value="05">05</option>
                                    <option value="06">06</option>
                                    <option value="07">07</option>
                                    <option value="08">08</option>
                                    <option value="09">09</option>
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
                                    data-control="select2" data-placeholder="Ölüm Ayı" data-hide-search="true">
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
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Kapat</button>
                        <button type="submit" class="btn btn-primary">Kaydet</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" id="dead_detail" aria-hidden="true">
        <div class="modal-dialog mw-900px">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <span id="dead_name"></span>
                    </h5>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="fas fa-times fs-4"></i>
                    </div>
                    <!--end::Close-->
                </div>

                <div class="modal-body">
                    <div class="row" id="dead_map">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css"
        rel="stylesheet" />

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
    @if ($errors->any())
        <script>
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: "Mevta eklerken bir sorun oluştu! Alanlardan herhangi biri boş olabilir.",
                showConfirmButton: false,
                timer: 1500
            })
        </script>
    @endif
    @if (Auth::user()->province_district_customization == 0)
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
                                    $("#cemetery_id").html(value)
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
    <script>
        $("#dead_detail").on("show.bs.modal", function(event) {
            var button = $(event.relatedTarget)

            var deadName = button.data("deadname")
            var deadMap = button.data("deadmap")
            var modal = $(this)

            modal.find(".modal-title #dead_name").html(deadName)
            modal.find(".modal-body #dead_map").html(deadMap)
        });

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

        $(".deadDelete").click(function(e) {
            e.preventDefault();

            var deadId = $(this).closest("tr").find(".dead_id").val();

            Swal.fire({
                title: 'Emin misniz?',
                text: "Mevtayı silmek istiyor musunuz? Bu işlem geri alınamaz!",
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
                        "id": deadId,
                    };

                    $.ajax({
                        type: "GET",
                        url: "/panel/mevta-sil/" + deadId,
                        data: data,
                        success: function() {
                            Swal.fire({
                                title: 'Silindi!',
                                text: 'Mevta başarıyla silindi.',
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
                                $("#search_neighborhood").html(
                                    value)
                                // var neighborhoodId = $("#search_neighborhood")
                                //     .val();
                                $.ajax({
                                    type: "POST",
                                    url: "{{ route('cemeteries') }}",
                                    data: {
                                        "province_id": provinceId,
                                        "_token": "{{ csrf_token() }}"
                                    },
                                    success: function(value) {
                                        $("#search_cemetery").html(
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
                        var neighborhoodId = $("#search_neighborhood").val();
                        $.ajax({
                            type: "POST",
                            url: "{{ route('cemeteries') }}",
                            data: {
                                "district_id": districtId,
                                "_token": "{{ csrf_token() }}"
                            },
                            success: function(value) {
                                $("#search_cemetery").html(value)
                                $("#search").submit();
                            }
                        })
                    }
                })
            });
        });
        // $(document).ready(function() {
        //     $("#search_neighborhood").change(function() {
        //         var neighborhoodId = $(this).val();
        //         $.ajax({
        //             type: "POST",
        //             url: "{{ route('cemeteries') }}",
        //             data: {
        //                 "neighborhood_id": neighborhoodId,
        //                 "_token": "{{ csrf_token() }}"
        //             },
        //             success: function(value) {
        //                 $("#search_cemetery").html(value)
        //                 $("#search").submit();
        //             }
        //         })
        //     });
        // });

        $("#maidenNameContainer").hide()
        $("#gender").change(e => {
            if (e.target.value == 'Kadın') $("#maidenNameContainer").show()
            else $("#maidenNameContainer").hide()
        })
    </script>
@endsection
