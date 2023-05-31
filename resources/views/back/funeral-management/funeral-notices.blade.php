@extends('back.layout.main')
@section('title', 'Cenaze İlanları')
@section('content')
    <!--begin::Toolbar-->
    <div class="toolbar mb-5 mb-lg-7" id="kt_toolbar">
        <!--begin::Page title-->
        <div class="page-title d-flex flex-column me-3">
            <!--begin::Title-->
            <h1 class="d-flex text-dark fw-bolder my-1 fs-3">Cenaze İlanları</h1>
            <!--end::Title-->
            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-dot fw-bold text-gray-600 fs-7 my-1">
                <!--begin::Item-->
                <li class="breadcrumb-item text-gray-600">
                    <a href="{{ route('panel') }}" class="text-gray-600 text-hover-primary">Anasayfa</a>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item text-gray-600">Cenaze İlanı Yönetimi</li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item text-gray-600">Cenaze İlanları</li>
                <!--end::Item-->
            </ul>
            <!--end::Breadcrumb-->
        </div>
        <!--end::Page title-->
    </div>
    <!--end::Toolbar-->
    <!--begin::Post-->
    <div class="content flex-column-fluid" id="kt_content">
        <div class="row">
            <div class="card mb-5 mb-xl-8">
                <!--begin::Header-->
                <div class="card-header border-0 pt-5">
                    <div class="card-title">
                        <form method="get" class="d-flex">
                            <div class="d-flex">
                                <div class="mb-2 me-3">
                                    <input type="date" name="olum_tarihi" id="olum_tarihi"
                                        class="form-control form-control-solid" onchange="this.form.submit()"
                                        placeholder="Ölüm tarihi">
                                </div>
                                <div>
                                    @if (request()->get('olum_tarihi'))
                                        <a href="{{ route('funeral-notices.index') }}" class="btn btn-light"><i
                                                class="fas fa-sync"></i></a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!--end::Header-->
                @if ($errors->all())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>
                                    {{ $error }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
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
                                    <th class="max-w-125px">İlan Sahibi</th>
                                    <th class="max-w-125px">Görüntüleme</th>
                                    <th class="max-w-125px">Camii</th>
                                    <th class="max-w-125px">Mezarlık</th>
                                    <th class="max-w-125px">Baba Adı</th>
                                    <th class="max-w-125px">Vakit</th>
                                    <th class="max-w-125px">Cenaze Adresi</th>
                                    <th class="max-w-125px">Ölüm Tarihi</th>
                                    <th class="text-end rounded-end"></th>
                                </tr>
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody>
                                @forelse ($funerals as $funeral)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="symbol symbol-50px me-5">
                                                    <span
                                                        class="ms-5 me-5 fs-1 text-muted">{{ mb_substr(strtoupper($funeral->first_name), 0, 1, 'UTF-8') }}</span>
                                                </div>
                                                <div class="d-flex justify-content-start flex-column">
                                                    <a href="#"
                                                        class="text-dark fw-bolder text-hover-primary mb-1 fs-6">{{ $funeral->first_name . ' ' . $funeral->last_name }}</a>
                                                    @if ($funeral->country_id == '190')
                                                        <span
                                                            class="text-muted fw-bold text-muted d-block fs-7">{{ $funeral->province->name . ' ' . $funeral->district->name . ' ' . $funeral->neighborhood->name }}</span>
                                                    @else
                                                        <span
                                                            class="text-muted fw-bold text-muted d-block fs-7">{{ $funeral->province_name . ' ' . $funeral->district_name . ' ' . $funeral->neighborhood_name }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="text-muted fw-bold d-block fs-7">
                                                {{ $funeral->owner }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="text-muted fw-bold d-block fs-7">
                                                {{ $funeral->views }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="text-muted fw-bold d-block fs-7">
                                                {{ $funeral->mosque }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="text-muted fw-bold d-block fs-7">
                                                {{ $funeral->cemetery }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="text-muted fw-bold d-block fs-7">
                                                {{ $funeral->father_name }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="text-muted fw-bold d-block fs-7">
                                                {{ $funeral->funeral_time }}
                                            </span>
                                        </td>
                                        <td>
                                            <span
                                                class="text-muted fw-bold d-block fs-7">{{ $funeral->funeral_address }}</span>
                                        </td>
                                        <td>
                                            <span
                                                class="text-muted fw-bold d-block fs-7">{{ $funeral->date_of_death->format('d.m.Y') }}</span>
                                        </td>
                                        <td class="text-end">
                                            <a href="{{ route('funeral-notice.edit', $funeral->id) }}"
                                                class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
                                                <!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
                                                <i class="fas fa-pen"></i>
                                                <!--end::Svg Icon-->
                                            </a>
                                            <input type="hidden" value="{{ $funeral->id }}" class="funeral_id">
                                            <button
                                                class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm funeralDelete">
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
                        <div class="fs-6 fw-bold text-gray-700">{{ $funerals->total() }} kayıttan
                            {{ $funerals->firstItem() }} ile {{ $funerals->lastItem() }} arası
                            gösteriliyor </div>
                        <!--begin::Pages-->
                        {{ $funerals->links('vendor.pagination.bootstrap-4') }}
                        <!--end::Pages-->
                    </div>
                </div>
                <!--begin::Body-->
            </div>
        </div>
    </div>
    <!--end::Post-->
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
    <script>
        // $("#olum_tarihi").flatpickr();
        $(".funeralDelete").click(function(e) {
            e.preventDefault();

            var funeralId = $(this).closest("tr").find(".funeral_id").val();

            Swal.fire({
                title: 'Emin misniz?',
                text: "Cenaze ilanını silmek istiyor musunuz? Bu işlem geri alınamaz!",
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
                        "id": funeralId,
                    };

                    $.ajax({
                        type: "GET",
                        url: "/panel/cenaze-ilanı-sil/" + funeralId,
                        data: data,
                        success: function() {
                            Swal.fire({
                                title: 'Silindi!',
                                text: 'Cenaze ilanı başarıyla silindi.',
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
