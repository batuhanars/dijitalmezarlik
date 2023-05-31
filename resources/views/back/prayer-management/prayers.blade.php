@extends('back.layout.main')
@section('title', 'Dualar')
@section('content')
    <!--begin::Toolbar-->
    <div class="toolbar mb-5 mb-lg-7" id="kt_toolbar">
        <!--begin::Page title-->
        <div class="page-title d-flex flex-column me-3">
            <!--begin::Title-->
            <h1 class="d-flex text-dark fw-bolder my-1 fs-3">Dualar</h1>
            <!--end::Title-->
            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-dot fw-bold text-gray-600 fs-7 my-1">
                <!--begin::Item-->
                <li class="breadcrumb-item text-gray-600">
                    <a href="{{ route('panel') }}" class="text-gray-600 text-hover-primary">Anasayfa</a>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item text-gray-600">Dua Yönetimi</li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item text-gray-600">Dualar</li>
                <!--end::Item-->
            </ul>
            <!--end::Breadcrumb-->
        </div>
        <!--end::Page title-->
        <!--begin::Actions-->
        <div class="d-flex align-items-center py-2 py-md-1">
            <!--begin::Button-->
            <a href="#" class="btn btn-dark fw-bolder" data-bs-toggle="modal" data-bs-target="#add_prayer"
                id="kt_toolbar_primary_button"><i class="fas fa-plus"></i> Dua Ekle</a>
            <!--end::Button-->
        </div>
        <!--end::Actions-->
    </div>
    <!--end::Toolbar-->
    <!--begin::Post-->
    <div class="content flex-column-fluid" id="kt_content">
        <div class="card mb-5 mb-xl-8">
            <!--begin::Header-->
            <div class="card-header border-0 pt-5">
                <div class="card-title">
                    <form method="get" class="d-flex">
                        <input type="text" name="dua" class="form-control form-control-solid"
                            value="{{ request()->get('dua') }}" placeholder="Dua Ara...">
                        @if (request()->get('dua'))
                            <a href="{{ route('prayers.index') }}" class="btn btn-light ms-5"><i
                                    class="fas fa-sync"></i></a>
                        @endif
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
                                <th class="ps-4 min-w-325px rounded-start">Dua</th>
                                <th class="min-w-125px">Video Url</th>
                                <th class="min-w-125px">Oluşturulma Tarihi</th>
                                <th class="min-w-200px text-end rounded-end"></th>
                            </tr>
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody>
                            @forelse ($prayers as $prayer)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="symbol symbol-50px me-5">
                                                <img src="{{ $prayer->video_image }}" class="" />
                                            </div>
                                            <div class="d-flex justify-content-start flex-column">
                                                <a href="#"
                                                    class="text-dark fw-bolder text-hover-primary mb-1 fs-6">{{ $prayer->title }}</a>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <a href=# data-bs-toggle="modal" data-bs-target="#prayer_detail"
                                            data-prayertitle="{{ $prayer->title }}"
                                            data-prayervideo="{{ $prayer->embed_code }}"
                                            data-prayercontent="{{ $prayer->content }}"
                                            class="fw-bolder text-primary mb-1 fs-7">Görüntüle</a>
                                    </td>
                                    <td>
                                        <span
                                            class="text-muted fw-bold text-muted d-block fs-7">{{ $prayer->created_at }}</span>
                                    </td>
                                    <td class="text-end">
                                        <a href="{{ route('prayers.edit', $prayer->slug) }}"
                                            class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                            <!--begin::Svg Icon | path: icons/duotune/general/gen019.svg-->
                                            <span class="svg-icon svg-icon-3">
                                                <i class="fas fa-pen"></i>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </a>
                                        <input type="hidden" value="{{ $prayer->id }}" class="prayer_id">
                                        <button
                                            class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm prayerDelete">
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
                                    dua yok!</div>
                            @endforelse
                        </tbody>
                        <!--end::Table body-->
                    </table>
                    <!--end::Table-->
                </div>
                <!--end::Table container-->
                <div class="d-flex flex-stack flex-wrap">
                    <div class="fs-6 fw-bold text-gray-700">{{ $prayers->total() }} kayıttan
                        {{ $prayers->firstItem() }} ile {{ $prayers->lastItem() }} arası
                        gösteriliyor </div>
                    <!--begin::Pages-->
                    {{ $prayers->links('vendor.pagination.bootstrap-4') }}
                    <!--end::Pages-->
                </div>
            </div>
            <!--begin::Body-->
        </div>
    </div>
    <!--end::Post-->
    <div class="modal fade" tabindex="-1" id="add_prayer">
        <div class="modal-dialog mw-900px">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Dua Ekle</h5>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <span class="svg-icon svg-icon-2x">
                            <i class="fas fa-times fs-4"></i>
                        </span>
                    </div>
                    <!--end::Close-->
                </div>
                <form action="{{ route('prayers.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group mb-5">
                            <label for="video_image" class="form-label">Video Resmi</label>
                            <span class="text-danger d-block">{{ $errors->first('video_image') }}</span>
                            <input type="file" name="video_image" id="video_image" class="form-control form-control-solid"
                                placeholder="Video Resmi">
                        </div>
                        <div class="form-group mb-5">
                            <label for="embed_code" class="form-label">Video Embed Kodu <small>(Örn:
                                    HGY-4cDZ6ks)</small></label>
                            <span class="text-danger d-block">{{ $errors->first('embed_code') }}</span>
                            <input type="text" name="embed_code" id="embed_code" class="form-control form-control-solid"
                                placeholder="Embed Kodu" autocomplete="off" value="{{ old('embed_code') }}">
                        </div>
                        <div class="form-group mb-5">
                            <label for="title" class="form-label">Dua Adı</label>
                            <span class="text-danger d-block">{{ $errors->first('title') }}</span>
                            <input type="text" name="title" id="title" class="form-control form-control-solid"
                                placeholder="Dua Adı" autocomplete="off" value="{{ old('title') }}">
                        </div>
                        <div class="form-group mb-5">
                            <label for="content" class="form-label">Dua İçerik</label>
                            <span class="text-danger d-block">{{ $errors->first('content') }}</span>
                            <textarea name="content" id="content" class="form-control form-control-solid"></textarea>
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
    <div class="modal fade" tabindex="-1" id="prayer_detail" aria-hidden="true">
        <div class="modal-dialog mw-900px">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <span id="prayer_title"></span>
                    </h5>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="fas fa-times fs-4"></i>
                    </div>
                    <!--end::Close-->
                </div>

                <div class="modal-body">
                    <div class="row">
                        <iframe src="" width="100%" height="400px" id="prayer_video" frameborder="0" gesture="media"
                            allow="encrypted-media" allowfullscreen></iframe>
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
                title: "Dua eklerken bir sorun oluştu! Alanlardan herhangi biri boş olabilir.",
                showConfirmButton: false,
                timer: 1500
            })
        </script>
    @endif
    <script>
        $(document).ready(function() {
            $('#content').summernote({
                height: 200,
            });
        });

        $("#prayer_detail").on("show.bs.modal", function(event) {
            var button = $(event.relatedTarget)

            var prayerTitle = button.data("prayertitle")
            var prayerVideo = button.data("prayervideo")
            var prayerContent = button.data("prayercontent")
            var modal = $(this)

            modal.find(".modal-title #prayer_title").html(prayerTitle)
            modal.find(".modal-content #prayer_video").attr("src", "https://www.youtube.com/embed/" + prayerVideo)
            modal.find(".modal-body #prayer_content").html(prayerContent)
        });

        $(".prayerDelete").click(function(e) {
            e.preventDefault();

            var prayerId = $(this).closest(".d-flex").find(".prayer_id").val();

            Swal.fire({
                title: 'Emin misniz?',
                text: "Duayı silmek istiyor musunuz? Bu işlem geri alınamaz!",
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
                        "id": prayerId,
                    };

                    $.ajax({
                        type: "GET",
                        url: "/panel/dua-sil/" + prayerId,
                        data: data,
                        success: function() {
                            Swal.fire({
                                title: 'Silindi!',
                                text: 'Dua başarıyla silindi.',
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
