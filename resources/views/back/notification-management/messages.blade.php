@extends('back.layout.main')
@section('title', 'Mesajlar')
@section('content')
    <!--begin::Toolbar-->
    <div class="toolbar mb-5 mb-lg-7" id="kt_toolbar">
        <!--begin::Page title-->
        <div class="page-title d-flex flex-column me-3">
            <!--begin::Title-->
            <h1 class="d-flex text-dark fw-bolder my-1 fs-3">Mesajlar</h1>
            <!--end::Title-->
            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-dot fw-bold text-gray-600 fs-7 my-1">
                <!--begin::Item-->
                <li class="breadcrumb-item text-gray-600">
                    <a href="{{ route('panel') }}" class="text-gray-600 text-hover-primary">Anasayfa</a>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item text-gray-600">Bildirim Yönetimi</li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item text-gray-600">Mesajlar</li>
                <!--end::Item-->
            </ul>
            <!--end::Breadcrumb-->
        </div>
        <!--end::Page title-->
    </div>
    <!--end::Toolbar-->
    <div class="content flex-column-fluid" id="kt_content">
        <div class="row">
            <div class="card mb-5 mb-xl-8">
                <!--begin::Header-->
                <div class="card-header border-0 pt-5">
                    <div class="card-title">
                        <form method="get" class="d-flex">
                            <input type="text" name="mesaj" class="form-control form-control-solid"
                                value="{{ request()->get('mesaj') }}" placeholder="Ara...">
                            @if (request()->get('mesaj'))
                                <a href="{{ route('messages.index') }}" class="btn btn-light"><i
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
                                    <th class="ps-4 min-w-325px rounded-start">Mesajlar</th>
                                    <th class="min-w-200px">Telefon</th>
                                    <th class="min-w-200px">Konu</th>
                                    <th class="min-w-200px text-end rounded-end"></th>
                                </tr>
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody>
                                @forelse ($messages as $message)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="d-flex justify-content-start flex-column">
                                                    <span
                                                        class="text-dark fw-bolder text-hover-primary mb-1 fs-6">{{ $message->name }}</span>
                                                    <span
                                                        class="text-muted fw-bold text-muted d-block fs-7">{{ $message->email }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span
                                                class="text-muted fw-bold text-muted d-block fs-7">{{ $message->phone }}</span>
                                        </td>
                                        <td>
                                            <span
                                                class="text-muted fw-bold text-muted d-block fs-7">{{ $message->topic }}</span>
                                        </td>

                                        <td class="text-end">
                                            <button class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm"
                                                data-message="{{ $message->message }}" data-bs-toggle="modal"
                                                data-bs-target="#message_detail">
                                                <!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
                                                <span class="svg-icon svg-icon-3">
                                                    <i class="fas fa-eye"></i>
                                                </span>
                                                <!--end::Svg Icon-->
                                            </button>
                                            <input type="hidden" value="{{ $message->id }}" class="id">
                                            <button
                                                class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm delete">
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
                                    <div class="alert alert-info"><i class="fas fa-info text-info"></i> Şu anda herhangi bir
                                        mesaj yok!</div>
                                @endforelse
                            </tbody>
                            <!--end::Table body-->
                        </table>
                        <!--end::Table-->
                    </div>
                    <!--end::Table container-->
                    <div class="d-flex flex-stack flex-wrap">
                        <div class="fs-6 fw-bold text-gray-700">{{ $messages->total() }} kayıttan
                            {{ $messages->firstItem() }} ile {{ $messages->lastItem() }}
                            arası
                            gösteriliyor </div>
                        <!--begin::Pages-->
                        {{ $messages->links('vendor.pagination.bootstrap-4') }}
                        <!--end::Pages-->
                    </div>
                </div>
                <!--begin::Body-->
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" id="message_detail">
        <div class="modal-dialog mw-900px">
            <div class="modal-content">
                <div class="modal-body">
                    <p class="message" style="
                                    font-size: 1.2em;"></p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Kapat</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(".delete").click(function(e) {
            e.preventDefault();

            var id = $(this).closest("tr").find(".id").val();

            Swal.fire({
                title: 'Emin misniz?',
                text: "Mesajı silmek istiyor musunuz? Bu işlem geri alınamaz!",
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
                        "id": id,
                    };

                    $.ajax({
                        type: "GET",
                        url: "/panel/mesaj-sil/" + id,
                        data: data,
                        success: function() {
                            Swal.fire({
                                title: 'Silindi!',
                                text: 'Mesaj başarıyla silindi.',
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

        $("#message_detail").on("show.bs.modal", function(event) {
            var button = $(event.relatedTarget)

            var message = button.data("message")
            var modal = $(this)

            modal.find(".modal-body .message").html(message)
        });
    </script>
@endsection
