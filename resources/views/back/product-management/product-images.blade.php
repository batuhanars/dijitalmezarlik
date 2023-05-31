@extends('back.layout.main')
@section('title', $product->title . ' Galeri')
@section('content')
    <!--begin::Toolbar-->
    <div class="toolbar mb-5 mb-lg-7" id="kt_toolbar">
        <!--begin::Page title-->
        <div class="page-title d-flex flex-column me-3">
            <!--begin::Title-->
            <h1 class="d-flex text-dark fw-bolder my-1 fs-3">{{ $product->title }} Galeri</h1>
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
                <li class="breadcrumb-item text-gray-600">{{ $product->title }} Galeri</li>
                <!--end::Item-->
            </ul>
            <!--end::Breadcrumb-->
        </div>
        <!--end::Page title-->
        <!--begin::Actions-->
        <div class="d-flex align-items-center py-2 py-md-1">
            <!--begin::Button-->
            <a href="#" class="btn btn-dark fw-bolder" data-bs-toggle="modal" data-bs-target="#add_image"
                id="kt_toolbar_primary_button"><i class="fas fa-plus"></i> Ürün Fotoğrafı Ekle</a>
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
                                    <input type="text" name="urun" class="form-control form-control-solid"
                                        value="{{ request()->get('urun') }}" placeholder="Ürün Ara...">
                                </div>
                                {{-- <div class="mb-2 me-3 w-200px">
                                    <select name="il" id="search_province" class="form-select form-select-solid"
                                        data-control="select2" data-placeholder="İl Seçiniz">
                                        <option value=""></option>

                                    </select>
                                </div> --}}
                                @if (request()->get('urun'))
                                    <div>
                                        <a href="{{ route('productImages.index') }}" class="btn btn-light"><i
                                                class="fas fa-sync"></i></a>
                                    </div>
                                @endif
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
                                    <th class="ps-4 min-w-200px rounded-start">Fotoğraf</th>
                                    <th class="min-w-200px text-end rounded-end"></th>
                                </tr>
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody>
                                @forelse ($productImages as $image)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="symbol symbol-50px me-5">
                                                    <img src="{{ $image->image }}" class="" />
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-end">
                                            <input type="hidden" value="{{ $image->id }}" class="product_image_id">
                                            <button
                                                class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm productImageDelete">
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
                                        ürün yok!</div>
                                @endforelse
                            </tbody>
                            <!--end::Table body-->
                        </table>
                        <!--end::Table-->
                    </div>
                    <!--end::Table container-->
                    <div class="d-flex flex-stack flex-wrap">
                        <div class="fs-6 fw-bold text-gray-700">{{ $productImages->total() }} kayıttan
                            {{ $productImages->firstItem() }} ile {{ $productImages->lastItem() }} arası
                            gösteriliyor </div>
                        <!--begin::Pages-->
                        {{ $productImages->links('vendor.pagination.bootstrap-4') }}
                        <!--end::Pages-->
                    </div>
                </div>
                <!--begin::Body-->
            </div>
        </div>
    </div>
    <!--end::Post-->
    <div class="modal fade" tabindex="-1" id="add_image">
        <div class="modal-dialog mw-900px">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ürün Fotoğrafı Ekle</h5>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <span class="svg-icon svg-icon-2x">
                            <i class="fas fa-times fs-4"></i>
                        </span>
                    </div>
                    <!--end::Close-->
                </div>

                <form id="saveImage" action="{{ route('products.images.store', $product->slug) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group mb-5">
                            <label for="image" class="form-label">Ürün Resmi</label>
                            <span class="text-danger d-block">{{ $errors->first('image') }}</span>
                            <input type="file" id="image" name="image[]" multiple
                                class="form-control form-control-solid">
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
                title: "Ürün eklerken bir sorun oluştu! Alanlardan herhangi biri boş olabilir.",
                showConfirmButton: false,
                timer: 1500
            })
        </script>
    @endif
    <script>
        $(document).ready(function() {
            $('#content').summernote();
        });

        $(".productImageDelete").click(function(e) {
            e.preventDefault();

            var productImageId = $(this).closest("tr").find(".product_image_id").val();

            Swal.fire({
                title: 'Emin misniz?',
                text: "Ürün fotoğrafını silmek istiyor musunuz? Bu işlem geri alınamaz!",
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
                        "id": productImageId,
                    };

                    $.ajax({
                        type: "GET",
                        url: "/panel/urunler/galeri/" + productImageId + "/sil",
                        data: data,
                        success: function() {
                            Swal.fire({
                                title: 'Silindi!',
                                text: 'Ürün fotoğrafı başarıyla silindi.',
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
