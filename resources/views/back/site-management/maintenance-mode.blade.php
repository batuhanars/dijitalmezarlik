@extends('back.layout.main')
@section('title', 'Bakım Modu')
@section('content')
    <!--begin::Toolbar-->
    <div class="toolbar mb-5 mb-lg-7" id="kt_toolbar">
        <!--begin::Page title-->
        <div class="page-title d-flex flex-column me-3">
            <!--begin::Title-->
            <h1 class="d-flex text-dark fw-bolder my-1 fs-3">Bakım Modu</h1>
            <!--end::Title-->
            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-dot fw-bold text-gray-600 fs-7 my-1">
                <!--begin::Item-->
                <li class="breadcrumb-item text-gray-600">
                    <a href="{{ route('panel') }}" class="text-gray-600 text-hover-primary">Anasayfa</a>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item text-gray-600">Site Yönetimi</li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item text-gray-600">Bakım Modu</li>
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
                <h3 class="card-title">Bakım Modu</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('save.maintenance') }}" method="post">
                    @csrf
                    <div class="form-group mb-5">
                        <label for="opening_date" class="form-label">Açılış Tarihi</label>
                        <input id="opening_date" name="opening_date" class="form-control form-control-solid"
                            value="{{ $maintenance ? $maintenance->opening_date : '' }}" placeholder="Açılış Tarihi">
                    </div>
                    <div class="form-group mb-5">
                        <label for="title" class="form-label">Başlık</label>
                        <input type="text" name="title" id="title" value="{{ $maintenance ? $maintenance->title : '' }}"
                            class="form-control form-control-solid" placeholder="Başlık" autocomplete="off">
                    </div>
                    <div class="form-group mb-5">
                        <label for="status" class="form-label">Durum</label>
                        <select type="text" name="status" id="status" class="form-select form-select-solid"
                            data-control="select2" data-placeholder="Durum Seçiniz">
                            <option value=""></option>
                            @if ($maintenance)
                                <option @if ($maintenance->status == 'active') selected @endif value="active">Aktif</option>
                                <option @if ($maintenance->status == 'passive') selected @endif value="passive">Pasif</option>
                            @else
                                <option value="active">Aktif</option>
                                <option value="passive">Pasif</option>
                            @endif
                        </select>
                    </div>
                    <div class="form-group mb-5">
                        <label for="description" class="form-label">Açıklama</label>
                        <textarea name="description" id="description" class="form-control form-control-solid"
                            placeholder="Açıklama" rows="4">{{ $maintenance ? $maintenance->description : '' }}</textarea>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success">Kaydet</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--end::Post-->
@endsection
@section('js')
    <script>
        $("#opening_date").flatpickr({
            dateFormat: "Y-m-d H:i",
            enableTime: true,
            locale: {
                weekdays: {
                    shorthand: ['Pzt', 'Sal', 'Çar', 'Per', 'Cum', 'Cmt', 'Paz'],
                    longhand: ['Pazartesi', 'Salı', 'Çarşamba', 'Perşembe', 'Cuma', 'Cumartesi', 'Pazar'],
                },
                months: {
                    shorthand: ['Oca', 'Şub', 'Mar', 'Nis', 'May', 'Haz', 'Tem', 'Ağu', 'Eyl', 'Eki', 'Kas',
                        'Ara'
                    ],
                    longhand: ['Ocak', 'Şubat', 'Mart', 'Nisan', 'Mayıs', 'Haziran', 'Temmuz', 'Аğustos', 'Eylül',
                        'Ekim', 'Kasım', 'Aralık'
                    ],
                },
            },
        });
    </script>
@endsection
