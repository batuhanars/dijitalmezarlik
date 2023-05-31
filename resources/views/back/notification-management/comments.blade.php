@extends('back.layout.main')
@section('title', 'Yorumlar')
@section('content')
    <!--begin::Toolbar-->
    <div class="toolbar mb-5 mb-lg-7" id="kt_toolbar">
        <!--begin::Page title-->
        <div class="page-title d-flex flex-column me-3">
            <!--begin::Title-->
            <h1 class="d-flex text-dark fw-bolder my-1 fs-3">Yorumlar</h1>
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
                <li class="breadcrumb-item text-gray-600">Yorumlar</li>
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
                            <input type="text" name="yorum" class="form-control form-control-solid"
                                value="{{ request()->get('yorum') }}" placeholder="Ara...">
                            @if (request()->get('yorum'))
                                <a href="{{ route('comment.index') }}" class="btn btn-light"><i
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
                                    <th class="ps-4 min-w-325px rounded-start">Yorumlar</th>
                                    <th class="min-w-200px">Cevaplar</th>
                                    <th class="min-w-200px">Mevta</th>
                                    <th class="min-w-200px">Durum</th>
                                    <th class="min-w-200px">Tarih</th>
                                    <th class="min-w-200px text-end rounded-end"></th>
                                </tr>
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody>
                                @forelse ($comments as $comment)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="d-flex justify-content-start flex-column">
                                                    <span
                                                        class="text-dark fw-bolder text-hover-primary mb-1 fs-6">{{ $comment->comment_title }}</span>
                                                    <span
                                                        class="text-muted fw-bold text-muted d-block fs-7">{{ $comment->comment_full_name . ' (' . $comment->comment_email . ')' }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span
                                                class="text-muted fw-bold d-block fs-7">{{ $comment->answers->count() }}</span>
                                        </td>
                                        <td>
                                            <span
                                                class="text-muted fw-bold d-block fs-7">{{ $comment->dead ? $comment->dead->full_name : '' }}</span>
                                        </td>
                                        <td>
                                            @if ($comment->status == 0)
                                                <span class="text-danger fw-bold d-block fs-7">Onaylanmadı</span>
                                            @else
                                                <span class="text-success fw-bold d-block fs-7">Onaylandı</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span
                                                class="text-muted fw-bold d-block fs-7">{{ $comment->created_at->diffForHumans() }}</span>
                                        </td>
                                        <td class="text-end">
                                            <form action="{{ route('comment.update', $comment->id) }}" method="post"
                                                style="display: inline-block">
                                                @csrf
                                                @method("PUT")
                                                @if ($comment->status == 0)
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
                                                data-message="{{ $comment->comment_message }}" data-bs-toggle="modal"
                                                data-bs-target="#comment_detail">
                                                <!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
                                                <span class="svg-icon svg-icon-3">
                                                    <i class="fas fa-eye"></i>
                                                </span>
                                                <!--end::Svg Icon-->
                                            </button>
                                            <button class="btn btn-icon btn-bg-light btn-active-color-success btn-sm"
                                                data-commentid="{{ $comment->id }}" data-bs-toggle="modal"
                                                data-bs-target="#answer">
                                                <!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
                                                <span class="svg-icon svg-icon-3">
                                                    <i class="fas fa-pen"></i>
                                                </span>
                                                <!--end::Svg Icon-->
                                            </button>
                                            <a href="{{ route('comment_answer.index', $comment->id) }}"
                                                class="btn btn-icon btn-bg-light btn-active-color-info btn-sm">
                                                <!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
                                                <i class="fas fa-comment"></i>
                                                <!--end::Svg Icon-->
                                            </a>
                                            <input type="hidden" value="{{ $comment->id }}" class="id">
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
                                    <div class="alert alert-info"><i class="fas fa-info text-info"></i> Şu anda herhangi bir
                                        yorum yok!</div>
                                @endforelse
                            </tbody>
                            <!--end::Table body-->
                        </table>
                        <!--end::Table-->
                    </div>
                    <!--end::Table container-->
                    <div class="d-flex flex-stack flex-wrap">
                        <div class="fs-6 fw-bold text-gray-700">{{ $comments->total() }} kayıttan
                            {{ $comments->lastItem() }} ile {{ $comments->lastItem() }}
                            arası
                            gösteriliyor </div>
                        <!--begin::Pages-->
                        {{ $comments->links('vendor.pagination.bootstrap-4') }}
                        <!--end::Pages-->
                    </div>
                </div>
                <!--begin::Body-->
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" id="answer">
        <div class="modal-dialog mw-900px">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Cevap Yaz</h5>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <span class="svg-icon svg-icon-2x">
                            <i class="fas fa-times fs-4"></i>
                        </span>
                    </div>
                    <!--end::Close-->
                </div>

                <form action="{{ route('comment_answer.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="comment_id" id="comment_id">
                        <input type="hidden" name="answer_full_name" id="answer_full_name"
                            value="{{ Auth::user()->full_name }}">
                        <input type="hidden" name="answer_email" id="answer_email" value="{{ Auth::user()->email }}">
                        <div class="form-group mb-5">
                            <label for="answer_title" class="form-label">Başlık</label>
                            <span class="text-danger d-block">{{ $errors->first('answer_title') }}</span>
                            <input type="text" name="answer_title" id="answer_title" class="form-control form-control-solid"
                                placeholder="Başlık">
                        </div>
                        <div class="form-group mb-5">
                            <label for="content" class="form-label">İçerik</label>
                            <span class="text-danger d-block">{{ $errors->first('answer_content') }}</span>
                            <textarea name="answer_message" id="answer_message" class="form-control form-control-solid"
                                data-kt-autosize="true" placeholder="İçerik"></textarea>
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
    <div class="modal fade" tabindex="-1" id="comment_detail">
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
                text: "Yorumu silmek istiyor musunuz? Bu işlem geri alınamaz!",
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
                        url: "/panel/yorum-sil/" + id,
                        data: data,
                        success: function() {
                            Swal.fire({
                                title: 'Silindi!',
                                text: 'Yorum başarıyla silindi.',
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

        $("#answer").on("show.bs.modal", function(event) {
            var button = $(event.relatedTarget)

            var commentId = button.data("commentid")
            var modal = $(this)

            modal.find(".modal-body #comment_id").val(commentId)
        });

        $("#comment_detail").on("show.bs.modal", function(event) {
            var button = $(event.relatedTarget)

            var message = button.data("message")
            var modal = $(this)

            modal.find(".modal-body .message").html(message)
        });
    </script>
@endsection
