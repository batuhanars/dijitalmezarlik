@extends('front.layout.main')
@section('title', $product->title)
@section('css')
    <style>
        .icon-hover:hover {
            border-color: #3b71ca !important;
            background-color: white !important;
            color: #3b71ca !important;
        }

        .icon-hover:hover i {
            color: #3b71ca !important;
        }
    </style>
@endsection
@section('content')
    <main>
        <div class="listing-details-area pt-100">
            <section class="py-5">
                <div class="container">
                    <div class="row gx-5">
                        <aside class="col-lg-6">
                            <div class="border rounded-4 mb-3 d-flex justify-content-center">
                                <a data-fslightbox="mygalley" class="rounded-4 thumb" target="_blank" data-type="image"
                                    href="">
                                    <img style="max-width: 100%; max-height: 100vh; margin: auto;" class="rounded-4 fit"
                                        src="" />
                                </a>
                            </div>
                            <div class="d-flex justify-content-center mb-3">
                                @foreach ($product->images as $image)
                                    <a data-fslightbox="mygalley" class="item-thumb border mx-1 rounded-2" target="_blank"
                                        data-type="image" href="{{ $image->image }}">
                                        <img width="60" height="60" class="rounded-2" src="{{ $image->image }}" />
                                    </a>
                                @endforeach
                            </div>
                            <!-- thumbs-wrap.// -->
                            <!-- gallery-wrap .end// -->
                        </aside>
                        <main class="col-lg-6">
                            <div class="ps-lg-3">
                                <h4 class="title text-dark">
                                    {{ $product->title }}
                                </h4>
                                {{-- <div class="d-flex flex-row my-3">
                                    <div class="text-warning mb-1 me-2">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                        <span class="ms-1">
                                            4.5
                                        </span>
                                    </div>
                                    <span class="text-muted"><i class="fas fa-shopping-basket fa-sm mx-1"></i>154
                                        orders</span>
                                    <span class="text-success ms-2">In stock</span>
                                </div> --}}
                                @if ($product->price)
                                    <div class="mb-3">
                                        <span class="h5">{{ $product->price }}₺</span>
                                    </div>
                                @endif

                                <p>
                                    {{ $product->description }}
                                </p>

                                {{-- <div class="row">
                                    <dt class="col-3">Type:</dt>
                                    <dd class="col-9">Regular</dd>

                                    <dt class="col-3">Color</dt>
                                    <dd class="col-9">Brown</dd>

                                    <dt class="col-3">Material</dt>
                                    <dd class="col-9">Cotton, Jeans</dd>

                                    <dt class="col-3">Brand</dt>
                                    <dd class="col-9">Reebook</dd>
                                </div> --}}

                                <hr />

                                <div class="row mb-4">
                                    {{-- <div class="col-md-4 col-6">
                                        <label class="mb-2">Size</label>
                                        <select class="form-select border border-secondary" style="height: 35px;">
                                            <option>Small</option>
                                            <option>Medium</option>
                                            <option>Large</option>
                                        </select>
                                    </div> --}}
                                    <!-- col.// -->
                                    {{-- <div class="col-md-4 col-6 mb-3">
                                        <label class="mb-2 d-block">Adet</label>
                                        <div class="input-group mb-3" style="width: 170px;">
                                            <button class="btn-white border border-secondary px-3" type="button"
                                                id="button-addon1" data-mdb-ripple-color="dark">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                            <input type="text" class="form-control text-center border border-secondary"
                                                placeholder="14" aria-label="Example text with button addon"
                                                aria-describedby="button-addon1" />
                                            <button class="btn-white border border-secondary px-3" type="button"
                                                id="button-addon2" data-mdb-ripple-color="dark">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </div> --}}
                                </div>
                                {{-- <a href="#" class="btn btn-warning shadow-0"> Satın Al </a>
                                <a href="#" class="btn btn-primary shadow-0"> <i
                                        class="me-1 fa fa-shopping-basket"></i> Sepete Ekle </a> --}}
                            </div>
                        </main>
                    </div>
                </div>
            </section>

            <section class="bg-light py-4">
                <div class="container">
                    <div class="row gx-4">
                        <div class="col-lg-8 mb-4">
                            <div class="px-3 py-2">

                                <!-- Pills content -->
                                <div class="tab-content" id="ex1-content">
                                    {!! $product->content !!}
                                </div>
                                <!-- Pills content -->
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="px-0 border rounded-2 shadow-0">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Similar items</h5>
                                        <div class="d-flex mb-3">
                                            <a href="#" class="me-3">
                                                <img src="https://bootstrap-ecommerce.com/bootstrap5-ecommerce/images/items/8.webp"
                                                    style="min-width: 96px; height: 96px;" class="img-md img-thumbnail" />
                                            </a>
                                            <div class="info">
                                                <a href="#" class="nav-link mb-1">
                                                    Rucksack Backpack Large <br />
                                                    Line Mounts
                                                </a>
                                                <strong class="text-dark"> $38.90</strong>
                                            </div>
                                        </div>

                                        <div class="d-flex mb-3">
                                            <a href="#" class="me-3">
                                                <img src="https://bootstrap-ecommerce.com/bootstrap5-ecommerce/images/items/9.webp"
                                                    style="min-width: 96px; height: 96px;" class="img-md img-thumbnail" />
                                            </a>
                                            <div class="info">
                                                <a href="#" class="nav-link mb-1">
                                                    Summer New Men's Denim <br />
                                                    Jeans Shorts
                                                </a>
                                                <strong class="text-dark"> $29.50</strong>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
@endsection
@section('js')
    <script>
        const thumb = document.querySelector(".thumb")
        const images = document.querySelectorAll(".item-thumb")
        const currentImage = 0

        thumb.children[0].src = images[0].children[0].src
        for (let i = 0; i < images.length; i++) {
            images[i].addEventListener("click", function(e) {
                e.preventDefault()
                thumb.children[0].src = e.srcElement.src
            })
        }

        function showSlide() {}
    </script>
@endsection
