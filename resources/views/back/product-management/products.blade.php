@extends('back.layout.main')
@section('title', 'Ürünler')
@section('content')
    <!--begin::Toolbar-->
    <div class="toolbar mb-5 mb-lg-7" id="kt_toolbar">
        <!--begin::Page title-->
        <div class="page-title d-flex flex-column me-3">
            <!--begin::Title-->
            <h1 class="d-flex text-dark fw-bolder my-1 fs-3">Ürünler</h1>
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
                <li class="breadcrumb-item text-gray-600">Ürünler</li>
                <!--end::Item-->
            </ul>
            <!--end::Breadcrumb-->
        </div>
        <!--end::Page title-->
        <!--begin::Actions-->
        <div class="d-flex align-items-center py-2 py-md-1">
            <!--begin::Button-->
            <a href="#" class="btn btn-dark fw-bolder" data-bs-toggle="modal" data-bs-target="#add_product"
                id="kt_toolbar_primary_button"><i class="fas fa-plus"></i> Ürün Ekle</a>
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
                                        <a href="{{ route('products.index') }}" class="btn btn-light"><i
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
                                    <th class="ps-4 min-w-200px rounded-start">Ürün</th>
                                    <th class="min-w-125px">Fiyat</th>
                                    <th class="min-w-125px">Durum</th>
                                    <th class="min-w-125px">Kayıt Tarihi</th>
                                    <th class="min-w-200px text-end rounded-end"></th>
                                </tr>
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody>
                                @forelse ($products as $product)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="symbol symbol-50px me-5">
                                                    @if ($product->images()->first())
                                                        <img src="{{ $product->images()->first()->image }}"
                                                            class="" />
                                                    @else
                                                        <img style="width: 50px;"
                                                            src="{{ asset('back/assets/media/none-icon-1.jpg') }}"
                                                            class="" />
                                                    @endif
                                                </div>
                                                <div class="d-flex justify-content-start flex-column">
                                                    <a href="#"
                                                        class="text-dark fw-bolder text-hover-primary mb-1 fs-6">
                                                        @foreach (explode(' ', $product->title) as $title)
                                                            {{ Str::ucfirst(Str::lower($title)) }}
                                                        @endforeach
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span
                                                class="text-muted fw-bold text-muted d-block fs-7">{{ $product->price }}₺</span>
                                        </td>
                                        <td>
                                            @if ($product->status == 1)
                                                <span class="fw-bold text-success d-block fs-7">Aktif</span>
                                            @else
                                                <span class="fw-bold text-danger d-block fs-7">Pasif</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span
                                                class="text-muted fw-bold text-muted d-block fs-7">{{ $product->created_at->format('d.m.Y') }}</span>
                                        </td>
                                        <td class="text-end">
                                            <a href="{{ route('products.images.index', $product->slug) }}"
                                                class="btn btn-bg-light btn-sm me-1 text-muted">
                                                Galeri
                                            </a>
                                            <a href="{{ route('products.edit', $product->slug) }}"
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
                                            <input type="hidden" value="{{ $product->id }}" class="product_id">
                                            <button
                                                class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm productDelete">
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
                        <div class="fs-6 fw-bold text-gray-700">{{ $products->total() }} kayıttan
                            {{ $products->firstItem() }} ile {{ $products->lastItem() }} arası
                            gösteriliyor </div>
                        <!--begin::Pages-->
                        {{ $products->links('vendor.pagination.bootstrap-4') }}
                        <!--end::Pages-->
                    </div>
                </div>
                <!--begin::Body-->
            </div>
        </div>
    </div>
    <!--end::Post-->
    <div class="modal fade" tabindex="-1" id="add_product">
        <div class="modal-dialog mw-900px">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ürün Ekle</h5>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <span class="svg-icon svg-icon-2x">
                            <i class="fas fa-times fs-4"></i>
                        </span>
                    </div>
                    <!--end::Close-->
                </div>

                <form id="saveProduct" action="{{ route('products.store') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group mb-5">
                            <label for="image" class="form-label">Ürün Resmi</label>
                            <span class="text-danger d-block">{{ $errors->first('image') }}</span>
                            <input type="file" id="image" name="image[]" multiple
                                class="form-control form-control-solid">
                        </div>
                        <div class="form-group mb-5">
                            <label for="title" class="form-label">Başlık</label>
                            <span class="text-danger d-block">{{ $errors->first('title') }}</span>
                            <input type="text" name="title" id="title" class="form-control form-control-solid"
                                placeholder="Başlık Giriniz" autocomplete="off" value="{{ old('title') }}">
                        </div>
                        <div class="form-group mb-5">
                            <label for="price" class="form-label">Fiyat</label>
                            <span class="text-danger d-block">{{ $errors->first('price') }}</span>
                            <input type="number" name="price" id="price" class="form-control form-control-solid"
                                placeholder="Fiyat Giriniz" autocomplete="off" value="{{ old('price') }}">
                        </div>
                        <div class="form-group mb-5">
                            <label for="status" class="form-label">Durum</label>
                            <select name="status" id="status" class="form-select form-select-solid">
                                <option value="1">Aktif</option>
                                <option value="0">Pasif</option>
                            </select>
                        </div>
                        <div class="form-group mb-5">
                            <label for="description" class="form-label">Kısa Açıklama</label>
                            <span class="text-danger d-block">{{ $errors->first('description') }}</span>
                            <textarea name="description" id="description" class="form-control form-control-solid">{{ old('description') }}</textarea>
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

        $(".productDelete").click(function(e) {
            e.preventDefault();

            var productId = $(this).closest("tr").find(".product_id").val();

            Swal.fire({
                title: 'Emin misniz?',
                text: "Ürünü silmek istiyor musunuz? Bu işlem geri alınamaz!",
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
                        "id": productId,
                    };

                    $.ajax({
                        type: "GET",
                        url: "/panel/urunler/" + productId + "/sil",
                        data: data,
                        success: function() {
                            Swal.fire({
                                title: 'Silindi!',
                                text: 'Ürünü başarıyla silindi.',
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
