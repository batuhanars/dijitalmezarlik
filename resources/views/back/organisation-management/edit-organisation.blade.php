@extends('back.layout.main')
@section('title', $organisation->name)
@section('content')
    <!--begin::Toolbar-->
    <div class="toolbar mb-5 mb-lg-7" id="kt_toolbar">
        <!--begin::Page title-->
        <div class="page-title d-flex flex-column me-3">
            <!--begin::Title-->
            <h1 class="d-flex text-dark fw-bolder my-1 fs-3">{{ $organisation->name }}</h1>
            <!--end::Title-->
            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-dot fw-bold text-gray-600 fs-7 my-1">
                <!--begin::Item-->
                <li class="breadcrumb-item text-gray-600">
                    <a href="{{ route('panel') }}" class="text-gray-600 text-hover-primary">Anasayfa</a>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item text-gray-600">Kurum Yönetimi</li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item text-gray-600">{{ $organisation->name }}</li>
                <!--end::Item-->
            </ul>
            <!--end::Breadcrumb-->
        </div>
        <!--end::Page title-->
    </div>
    <!--end::Toolbar-->
    <!--begin::Post-->
    <div class="content flex-column-fluid" id="kt_content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Kurum Güncelle</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('organisations.update', $organisation->id) }}" method="post">
                    @method("PUT")
                    @csrf
                    <div class="form-group mb-5">
                        <label for="name" class="form-label">Kurum Adı</label>
                        <span class="text-danger d-block">{{ $errors->first('first_name') }}</span>
                        <input type="text" name="name" id="name" class="form-control form-control-solid"
                            value="{{ $organisation->name }}" placeholder="Kurum Adı" autocomplete="off">
                    </div>
                    <div class="form-group mb-5">
                        <label for="email" class="form-label">Kurum Email</label>
                        <span class="text-danger d-block">{{ $errors->first('email') }}</span>
                        <input type="text" id=email" name="email" class="form-control form-control-solid"
                            placeholder="Kurum Email" autocomplete="off" value="{{ $organisation->email }}">
                    </div>
                    <div class="form-group mb-5">
                        <label for="tax_number" class="form-label">Kurum Vergi Numarası</label>
                        <span class="text-danger d-block">{{ $errors->first('tax_number') }}</span>
                        <input type="text" id=tax_number" name="tax_number" class="form-control form-control-solid"
                            placeholder="Kurum Vergi Numarası" autocomplete="off" value="{{ $organisation->tax_number }}" maxlength="10">
                    </div>
                    <div class="form-group mb-5">
                        <label for="address" class="form-label">Kurum Adresi</label>
                        <span class="text-danger d-block">{{ $errors->first('address') }}</span>
                        <input type="text" id=address" name="address" class="form-control form-control-solid"
                            value="{{ $organisation->address }}" placeholder="Kurum Adresi" autocomplete="off">
                    </div>
                    <div class="form-group mb-5">
                        <label for="phone" class="form-label">Kurum İletişim Numarası</label>
                        <span class="text-danger d-block">{{ $errors->first('last_name') }}</span>
                        <input type="tel" name="phone" id="phone" class="form-control form-control-solid"
                            value="{{ $organisation->phone }}" placeholder="Kurum İletişim Numarası" autocomplete="off">
                    </div>
                    <div class="form-group mb-5">
                        <button type="submit" class="btn btn-success">Kaydet</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--end::Post-->
@endsection
@section('js')
    <script>
        Inputmask({
            "mask": "(999) 999-9999"
        }).mask("#phone");
    </script>
@endsection
