@extends('back.layout.main')
@section('title', $comment->comment_title)
@section('content')
    <!--begin::Toolbar-->
    <div class="toolbar mb-5 mb-lg-7" id="kt_toolbar">
        <!--begin::Page title-->
        <div class="page-title d-flex flex-column me-3">
            <!--begin::Title-->
            <h1 class="d-flex text-dark fw-bolder my-1 fs-3">{{ $comment->comment_title }} Yorumu Cevapları</h1>
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
                <li class="breadcrumb-item text-gray-600"> <a href="{{ route('comment.index') }}"
                        class="text-gray-600 text-hover-primary">{{ $comment->comment_title }}</a></li>
                <li class="breadcrumb-item text-gray-600">Cevaplar</li>
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
                            <input type="text" name="cevap" class="form-control form-control-solid"
                                value="{{ request()->get('cevap') }}" placeholder="Ara...">
                            @if (request()->get('cevap'))
                                <a href="{{ route('comment_answer.index', $comment->id) }}" class="btn btn-light"><i
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
                                    <th class="ps-4 min-w-325px rounded-start">Cevap</th>
                                    <th class="min-w-200px">Durum</th>
                                    <th class="min-w-200px">Mesaj</th>
                                    <th class="min-w-200px text-end rounded-end"></th>
                                </tr>
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody>
                                @forelse ($answers as $answer)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="d-flex justify-content-start flex-column">
                                                    <span
                                                        class="text-dark fw-bolder text-hover-primary mb-1 fs-6">{{ $answer->answer_title }}</span>
                                                    <span
                                                        class="text-muted fw-bold text-muted d-block fs-7">{{ $answer->answer_full_name }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            @if ($answer->status == 0)
                                                <span class="text-danger fw-bold d-block fs-7">Onaylanmadı</span>
                                            @else
                                                <span class="text-success fw-bold d-block fs-7">Onaylandı</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span
                                                class="text-muted fw-bold text-muted d-block fs-7">{{ Str::limit($answer->answer_message, 200) }}</span>
                                        </td>
                                        <td class="text-end">
                                            <form action="{{ route('comment_answer.update', $answer->id) }}" method="post"
                                                style="display: inline-block">
                                                @csrf
                                                @method("PUT")
                                                @if ($answer->status == 0)
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
                                            <button class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm"
                                                data-message="{{ $answer->answer_message }}" data-bs-toggle="modal"
                                                data-bs-target="#answer_detail">
                                                <!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
                                                <span class="svg-icon svg-icon-3">
                                                    <i class="fas fa-eye"></i>
                                                </span>
                                                <!--end::Svg Icon-->
                                            </button>
                                            <input type="hidden" value="{{ $answer->id }}" class="id">
                                            <button class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm delete">
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
                                    <div class="alert alert-info"><i class="fas fa-info text-info"></i> Şu anda bu yoruma
                                        ait herhangi bir
                                        cevap yok!</div>
                                @endforelse
                            </tbody>
                            <!--end::Table body-->
                        </table>
                        <!--end::Table-->
                    </div>
                    <!--end::Table container-->
                    <div class="d-flex flex-stack flex-wrap">
                        <div class="fs-6 fw-bold text-gray-700">{{ $answers->total() }} kayıttan
                            {{ $answers->firstItem() }} ile {{ $answers->lastItem() }}
                            arası
                            gösteriliyor </div>
                        <!--begin::Pages-->
                        {{ $answers->links('vendor.pagination.bootstrap-4') }}
                        <!--end::Pages-->
                    </div>
                </div>
                <!--begin::Body-->
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" id="answer_detail">
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
                text: "Cevabı silmek istiyor musunuz? Bu işlem geri alınamaz!",
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
                        url: "/panel/cevap-sil/" + id,
                        data: data,
                        success: function() {
                            Swal.fire({
                                title: 'Silindi!',
                                text: 'Cevap başarıyla silindi.',
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

        $("#answer_edit").on("show.bs.modal", function(event) {
            var button = $(event.relatedTarget)

            var answerId = button.data("answerid")
            var title = button.data("title")
            var message = button.data("message")
            var modal = $(this)

            modal.find(".modal-body #answer_id").val(answerId)
            modal.find(".modal-body #title").val(title)
            modal.find(".modal-body #message").val(message)
        });

        $("#answer_detail").on("show.bs.modal", function(event) {
            var button = $(event.relatedTarget)

            var message = button.data("message")
            var modal = $(this)

            modal.find(".modal-body .message").html(message)
        });
    </script>
@endsection
