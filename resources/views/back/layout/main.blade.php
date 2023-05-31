<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
    <title>{{ $setting ? $setting->title : '' }} - @yield('title')</title>
    <meta charset="utf-8" />
    <meta name="description" content="{{ $setting ? $setting->description : '' }}" />
    <meta name="keywords" content="{{ $setting ? $setting->keywords : '' }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ $setting ? $setting->favicon : '' }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <link href="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('back/assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('back/assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">

</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed">
    <!--begin::Main-->
    <!--begin::Root-->
    <div class="d-flex flex-column">
        <!--begin::Page-->
        <div class="page d-flex flex-row flex-column-fluid">
            <!--begin::Wrapper-->
            <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
                <!--begin::Header-->
                <div id="kt_header" class="header" style="background: #151521">
                    <!--begin::Container-->
                    <div class="container-fluid d-flex flex-stack">
                        <!--begin::Brand-->
                        <div class="d-flex align-items-center me-5 p-10">
                            <!--begin::Aside toggle-->
                            <div class="d-lg-none btn btn-icon btn-active-color-white w-30px h-30px ms-n2 me-3"
                                id="kt_aside_toggle">
                                <!--begin::Svg Icon | path: icons/duotune/abstract/abs015.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none">
                                        <path
                                            d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z"
                                            fill="black" />
                                        <path opacity="0.3"
                                            d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z"
                                            fill="black" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </div>
                            <!--end::Aside  toggle-->
                            <!--begin::Logo-->
                            <a href="{{ route('panel') }}">
                                <img src="{{ asset('back/assets/media/616810a97da45.png') }}"
                                    class="h-30px h-lg-40px" />
                            </a>
                            <!--end::Logo-->
                        </div>
                        <!--end::Brand-->
                        <!--begin::Topbar-->
                        <div class="d-flex align-items-center">
                            <!--begin::Topbar-->
                            <div class="d-flex align-items-center flex-shrink-0">
                                <!--begin::Search-->
                                <div id="kt_header_search" class="d-flex align-items-stretch"
                                    data-kt-search-keypress="true" data-kt-search-min-length="2"
                                    data-kt-search-enter="enter" data-kt-search-layout="menu"
                                    data-kt-menu-trigger="auto" data-kt-menu-overflow="false"
                                    data-kt-menu-permanent="true" data-kt-menu-placement="bottom-end">
                                    <!--begin::Search toggle-->
                                    <div class="d-flex align-items-center" data-kt-search-element="toggle"
                                        id="kt_header_search_toggle">
                                        <div
                                            class="btn btn-icon btn-color-white bg-hover-white bg-hover-opacity-10 w-30px h-30px h-40px w-40px">
                                            <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                            <span class="svg-icon svg-icon-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none">
                                                    <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546"
                                                        height="2" rx="1"
                                                        transform="rotate(45 17.0365 15.1223)" fill="black" />
                                                    <path
                                                        d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                                        fill="black" />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </div>
                                    </div>
                                    <!--end::Search toggle-->
                                    <!--begin::Menu-->
                                    <div data-kt-search-element="content"
                                        class="menu menu-sub menu-sub-dropdown p-7 w-325px w-md-375px">
                                        <!--begin::Wrapper-->
                                        <div data-kt-search-element="wrapper">
                                            <!--begin::Form-->
                                            <form action="{{ route('deceased.index') }}" method="get"
                                                class="position-relative" autocomplete="off">
                                                <!--begin::Icon-->
                                                <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                                <span
                                                    class="svg-icon svg-icon-2 svg-icon-lg-1 svg-icon-gray-500 position-absolute top-50 translate-middle-y ms-0 ps-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" viewBox="0 0 24 24" fill="none">
                                                        <rect opacity="0.5" x="17.0365" y="15.1223"
                                                            width="8.15546" height="2" rx="1"
                                                            transform="rotate(45 17.0365 15.1223)" fill="black" />
                                                        <path
                                                            d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                                            fill="black" />
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon-->
                                                <!--end::Icon-->
                                                <!--begin::Input-->
                                                <input type="text" class="form-control form-control-solid ps-10"
                                                    name="dead" value="" placeholder="Mevta Ara..."
                                                    data-kt-search-element="input" />
                                                <!--end::Input-->
                                                <!--begin::Reset-->
                                                <span
                                                    class="btn btn-flush btn-active-color-primary position-absolute top-50 end-0 translate-middle-y lh-0 d-none"
                                                    data-kt-search-element="clear">
                                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                                                    <span class="svg-icon svg-icon-2 svg-icon-lg-1 me-0">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none">
                                                            <rect opacity="0.5" x="6" y="17.3137"
                                                                width="16" height="2" rx="1"
                                                                transform="rotate(-45 6 17.3137)" fill="black" />
                                                            <rect x="7.41422" y="6" width="16"
                                                                height="2" rx="1"
                                                                transform="rotate(45 7.41422 6)" fill="black" />
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </span>
                                                <!--end::Reset-->

                                            </form>
                                            <!--end::Form-->
                                        </div>
                                        <!--end::Wrapper-->
                                    </div>
                                    <!--end::Menu-->
                                </div>
                                <!--end::Search-->
                                <!--begin::User-->
                                <div class="d-flex align-items-center ms-1" id="kt_header_user_menu_toggle">
                                    <!--begin::User info-->
                                    <div class="btn btn-flex align-items-center bg-hover-white bg-hover-opacity-10 py-2 px-2 px-md-3"
                                        data-kt-menu-trigger="click" data-kt-menu-attach="parent"
                                        data-kt-menu-placement="bottom-end">
                                        <!--begin::Name-->
                                        <div
                                            class="d-none d-md-flex flex-column align-items-end justify-content-center me-2 me-md-4">
                                            <span
                                                class="text-white fs-7 fw-bolder lh-1 mb-1">{{ Auth::user()->full_name }}</span>
                                            <span
                                                class="text-muted fs-8 fw-bold lh-1">{{ Auth::user()->email }}</span>
                                        </div>
                                        <!--end::Name-->
                                        <!--begin::Symbol-->
                                        <div class="symbol symbol-30px symbol-md-40px">
                                            @if (Auth::user()->image !== null)
                                                <img alt="{{ Auth::user()->full_name }}"
                                                    src="{{ Auth::user()->image }}" />
                                            @else
                                                <span
                                                    class="ms-5 me-5 fs-1 text-muted">{{ mb_substr(strtoupper(Auth::user()->full_name), 0, 1, 'UTF-8') }}</span>
                                            @endif
                                        </div>
                                        <!--end::Symbol-->
                                    </div>
                                    <!--end::User info-->
                                    <!--begin::Menu-->
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-275px"
                                        data-kt-menu="true">
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <div class="menu-content d-flex align-items-center px-3">
                                                <!--begin::Avatar-->
                                                <div class="symbol symbol-50px me-5">
                                                    @if (Auth::user()->image !== null)
                                                        <img alt="{{ Auth::user()->full_name }}"
                                                            src="{{ Auth::user()->image }}" />
                                                    @else
                                                        <span
                                                            class="ms-5 me-5 fs-1 text-muted">{{ mb_substr(strtoupper(Auth::user()->full_name), 0, 1, 'UTF-8') }}</span>
                                                    @endif
                                                </div>
                                                <!--end::Avatar-->
                                                <!--begin::Username-->
                                                <div class="d-flex flex-column">
                                                    <div class="fw-bolder d-flex align-items-center fs-5">
                                                        {{ Auth::user()->full_name }}
                                                    </div>
                                                    <a href="#"
                                                        class="fw-bold text-muted text-hover-primary fs-7">{{ Auth::user()->email }}</a>
                                                </div>
                                                <!--end::Username-->
                                            </div>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu separator-->
                                        <div class="separator my-2"></div>
                                        <!--end::Menu separator-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-5 my-1">
                                            <a href="{{ route('profile.edit') }}" class="menu-link px-5">Hesap
                                                Ayarları</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-5">
                                            <a href="{{ route('logout') }}" class="menu-link px-5">Çıkış Yap</a>
                                        </div>
                                        <!--end::Menu item-->
                                    </div>
                                    <!--end::Menu-->
                                </div>
                                <!--end::User -->
                            </div>
                            <!--end::Topbar-->
                        </div>
                        <!--end::Topbar-->
                    </div>
                    <!--end::Container-->
                </div>
                <!--end::Header-->
                <!--begin::Content wrapper-->
                <div class="d-flex flex-column-fluid">
                    <!--begin::Aside-->
                    <div id="kt_aside" class="aside card" data-kt-drawer="true" data-kt-drawer-name="aside"
                        data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true"
                        data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start"
                        data-kt-drawer-toggle="#kt_aside_toggle">
                        <!--begin::Aside menu-->
                        <div class="aside-menu flex-column-fluid px-5">
                            <!--begin::Aside Menu-->
                            <div class="hover-scroll-overlay-y my-5 pe-4 me-n4" id="kt_aside_menu_wrapper"
                                data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}"
                                data-kt-scroll-height="auto"
                                data-kt-scroll-dependencies="#kt_header, #kt_aside_footer"
                                data-kt-scroll-wrappers="#kt_aside, #kt_aside_menu"
                                data-kt-scroll-offset="{lg: '75px'}">
                                <!--begin::Menu-->
                                <div class="menu menu-column menu-rounded fw-bold fs-6" id="#kt_aside_menu"
                                    data-kt-menu="true">
                                    <div class="menu-item">
                                        <a class="menu-link" href="{{ route('panel') }}">
                                            <span class="menu-icon">
                                                <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                                <span class="svg-icon svg-icon-2">
                                                    <fas class="fas fa-home fs-3"></fas>
                                                </span>
                                                <!--end::Svg Icon-->
                                            </span>
                                            <span class="menu-title">Anasayfa</span>
                                        </a>
                                    </div>
                                    @if (Auth::user()->role->site_management)
                                        <div class="menu-item">
                                            <div class="menu-content pt-8 pb-2">
                                                <span class="menu-section text-muted text-uppercase fs-8 ls-1">Site
                                                    Yönetimi</span>
                                            </div>
                                        </div>
                                        <div class="menu-item">
                                            <a href="{{ route('settings') }}" class="menu-link text-black">
                                                <span class="menu-icon">
                                                    <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm007.svg-->
                                                    <span class="svg-icon svg-icon-2">
                                                        <i class="fas fa-cog fs-3"></i>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </span>
                                                <span class="menu-title">Genel Ayarlar</span>
                                            </a>
                                        </div>
                                        <div class="menu-item">
                                            <a href="{{ route('maintenance') }}" class="menu-link text-black">
                                                <span class="menu-icon">
                                                    <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm007.svg-->
                                                    <span class="svg-icon svg-icon-2">
                                                        <i class="fas fa-wrench fs-3"></i>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </span>
                                                <span class="menu-title">Bakım Modu</span>
                                            </a>
                                        </div>
                                        <div class="menu-item">
                                            <a href="{{ route('contact-management') }}" class="menu-link text-black">
                                                <span class="menu-icon">
                                                    <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm007.svg-->
                                                    <span class="svg-icon svg-icon-2">
                                                        <i class="fas fa-phone fs-3"></i>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </span>
                                                <span class="menu-title">İletişim Yönetimi</span>
                                            </a>
                                        </div>
                                        <div class="menu-item">
                                            <a href="{{ route('social-media') }}" class="menu-link text-black">
                                                <span class="menu-icon">
                                                    <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm007.svg-->
                                                    <span class="svg-icon svg-icon-2">
                                                        <i class="fas fa-hashtag fs-3"></i>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </span>
                                                <span class="menu-title">Sosyal Medya Yönetimi</span>
                                            </a>
                                        </div>
                                        <div class="menu-item">
                                            <a href="{{ route('app-features.index') }}" class="menu-link text-black">
                                                <span class="menu-icon">
                                                    <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm007.svg-->
                                                    <span class="svg-icon svg-icon-2">
                                                        <i class="fas fa-boxes fs-3"></i>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </span>
                                                <span class="menu-title">Uygulama Özellikleri</span>
                                            </a>
                                        </div>
                                    @endif
                                    @if (Auth::user()->role->page_management)
                                        <div class="menu-item">
                                            <div class="menu-content pt-8 pb-2">
                                                <span class="menu-section text-muted text-uppercase fs-8 ls-1">Sayfa
                                                    Yönetimi</span>
                                            </div>
                                        </div>
                                        <div class="menu-item">
                                            <a href="{{ route('cemetery-services.index') }}"
                                                class="menu-link text-black">
                                                <span class="menu-icon">
                                                    <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm007.svg-->
                                                    <span class="svg-icon svg-icon-2">
                                                        <i class="fas fa-mosque fs-3"></i>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </span>
                                                <span class="menu-title">Mezarlık Hizmetleri</span>
                                            </a>
                                        </div>
                                        <div class="menu-item">
                                            <a href="{{ route('burial-procedures') }}" class="menu-link text-black">
                                                <span class="menu-icon">
                                                    <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm007.svg-->
                                                    <span class="svg-icon svg-icon-2">
                                                        <i class="fas fa-bed fs-3"></i>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </span>
                                                <span class="menu-title">Defin İşlemleri</span>
                                            </a>
                                        </div>
                                        <div class="menu-item">
                                            <a href="{{ route('cemetery-etiquette') }}" class="menu-link text-black">
                                                <span class="menu-icon">
                                                    <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm007.svg-->
                                                    <span class="svg-icon svg-icon-2">
                                                        <i class="fas fa-book fs-3"></i>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </span>
                                                <span class="menu-title">Mezarlık Adabı</span>
                                            </a>
                                        </div>
                                        <div class="menu-item">
                                            <a href="{{ route('help.index') }}" class="menu-link text-black">
                                                <span class="menu-icon">
                                                    <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm007.svg-->
                                                    <span class="svg-icon svg-icon-2">
                                                        <i class="fas fa-info-circle fs-3"></i>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </span>
                                                <span class="menu-title">Yardım</span>
                                            </a>
                                        </div>
                                        <div class="menu-item">
                                            <a href="{{ route('about-app') }}" class="menu-link text-black">
                                                <span class="menu-icon">
                                                    <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm007.svg-->
                                                    <span class="svg-icon svg-icon-2">
                                                        <i class="fas fa-box fs-3"></i>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </span>
                                                <span class="menu-title">Uygulama Hakkında</span>
                                            </a>
                                        </div>
                                        <div class="menu-item">
                                            <a href="{{ route('cookie-policy') }}" class="menu-link text-black">
                                                <span class="menu-icon">
                                                    <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm007.svg-->
                                                    <span class="svg-icon svg-icon-2">
                                                        <i class="fas fa-cookie fs-3"></i>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </span>
                                                <span class="menu-title">Çerez Politikası</span>
                                            </a>
                                        </div>
                                    @endif
                                    @if (Auth::user()->role->product_management)
                                        <div class="menu-item">
                                            <div class="menu-content pt-8 pb-2">
                                                <span class="menu-section text-muted text-uppercase fs-8 ls-1">Ürün
                                                    Yönetimi</span>
                                            </div>
                                        </div>
                                        <div class="menu-item">
                                            <a href="{{ route('products.index') }}" class="menu-link text-black">
                                                <span class="menu-icon">
                                                    <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm007.svg-->
                                                    <span class="svg-icon svg-icon-2">
                                                        <i class="fas fa-boxes fs-3"></i>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </span>
                                                <span class="menu-title">Ürünler</span>
                                            </a>
                                        </div>
                                        <div class="menu-item">
                                            <a href="{{ route('products.create') }}" class="menu-link text-black">
                                                <span class="menu-icon">
                                                    <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm007.svg-->
                                                    <span class="svg-icon svg-icon-2">
                                                        <i class="fas fa-plus fs-3"></i>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </span>
                                                <span class="menu-title">Ürün Ekle</span>
                                            </a>
                                        </div>
                                    @endif
                                    @if (Auth::user()->role->user_management)
                                        <div class="menu-item">
                                            <div class="menu-content pt-8 pb-2">
                                                <span
                                                    class="menu-section text-muted text-uppercase fs-8 ls-1">Kullanıcı
                                                    Yönetimi</span>
                                            </div>
                                        </div>
                                        <div class="menu-item">
                                            <a href="{{ route('users.index') }}" class="menu-link text-black">
                                                <span class="menu-icon">
                                                    <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm007.svg-->
                                                    <span class="svg-icon svg-icon-2">
                                                        <i class="fas fa-users fs-3"></i>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </span>
                                                <span class="menu-title">Kullanıcılar</span>
                                            </a>
                                        </div>
                                        <div class="menu-item">
                                            <a href="{{ route('users.create') }}" class="menu-link text-black">
                                                <span class="menu-icon">
                                                    <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm007.svg-->
                                                    <span class="svg-icon svg-icon-2">
                                                        <i class="fas fa-user-plus fs-4"></i>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </span>
                                                <span class="menu-title">Kullanıcı Ekle</span>
                                            </a>
                                        </div>
                                    @endif
                                    @if (Auth::user()->role->organisation_management)
                                        <div class="menu-item">
                                            <div class="menu-content pt-8 pb-2">
                                                <span class="menu-section text-muted text-uppercase fs-8 ls-1">Kurum
                                                    Yönetimi</span>
                                            </div>
                                        </div>
                                        <div class="menu-item">
                                            <a href="{{ route('organisations.index') }}"
                                                class="menu-link text-black">
                                                <span class="menu-icon">
                                                    <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm007.svg-->
                                                    <span class="svg-icon svg-icon-2">
                                                        <i class="fas fa-building fs-3"></i>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </span>
                                                <span class="menu-title">Kurumlar</span>
                                            </a>
                                        </div>
                                        <div class="menu-item">
                                            <a href="{{ route('organisations.create') }}"
                                                class="menu-link text-black">
                                                <span class="menu-icon">
                                                    <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm007.svg-->
                                                    <span class="svg-icon svg-icon-2">
                                                        <i class="fas fa-plus fs-4"></i>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </span>
                                                <span class="menu-title">Kurum Ekle</span>
                                            </a>
                                        </div>
                                    @endif
                                    @if (Auth::user()->role->slider_management)
                                        <div class="menu-item">
                                            <div class="menu-content pt-8 pb-2">
                                                <span class="menu-section text-muted text-uppercase fs-8 ls-1">Slider
                                                    Yönetimi</span>
                                            </div>
                                        </div>
                                        <div class="menu-item">
                                            <a href="{{ route('sliders.index') }}" class="menu-link text-black">
                                                <span class="menu-icon">
                                                    <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm007.svg-->
                                                    <span class="svg-icon svg-icon-2">
                                                        <i class="fas fa-sliders-h fs-3"></i>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </span>
                                                <span class="menu-title">Sliderlar</span>
                                            </a>
                                        </div>
                                        <div class="menu-item">
                                            <a href="{{ route('sliders.create') }}" class="menu-link text-black">
                                                <span class="menu-icon">
                                                    <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm007.svg-->
                                                    <span class="svg-icon svg-icon-2">
                                                        <i class="fas fa-plus fs-3"></i>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </span>
                                                <span class="menu-title">Slider Ekle</span>
                                            </a>
                                        </div>
                                    @endif
                                    @if (Auth::user()->role->cemetery_management)
                                        <div class="menu-item">
                                            <div class="menu-content pt-8 pb-2">
                                                <span class="menu-section text-muted text-uppercase fs-8 ls-1">Mezarlık
                                                    Yönetimi</span>
                                            </div>
                                        </div>
                                        <div class="menu-item">
                                            <a href="{{ route('cemeteries.index') }}" class="menu-link text-black">
                                                <span class="menu-icon">
                                                    <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm007.svg-->
                                                    <span class="svg-icon svg-icon-2">
                                                        <i class="fas fa-id-card-alt fs-3"></i>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </span>
                                                <span class="menu-title">Mezarlıklar</span>
                                            </a>
                                        </div>
                                        <div class="menu-item">
                                            <a href="{{ route('cemeteries.create') }}" class="menu-link text-black">
                                                <span class="menu-icon">
                                                    <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm007.svg-->
                                                    <span class="svg-icon svg-icon-2">
                                                        <i class="fas fa-monument fs-3"></i>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </span>
                                                <span class="menu-title">Mezarlık Ekle</span>
                                            </a>
                                        </div>
                                    @endif
                                    @if (Auth::user()->role->dead_management)
                                        <div class="menu-item">
                                            <div class="menu-content pt-8 pb-2">
                                                <span class="menu-section text-muted text-uppercase fs-8 ls-1">Mevta
                                                    Yönetimi</span>
                                            </div>
                                        </div>
                                        <div class="menu-item">
                                            <a href="{{ route('deceased.index') }}" class="menu-link text-black">
                                                <span class="menu-icon">
                                                    <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm007.svg-->
                                                    <span class="svg-icon svg-icon-2">
                                                        <i class="fas fa-bed fs-3"></i>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </span>
                                                <span class="menu-title">Vefat Edenler</span>
                                            </a>
                                        </div>
                                        <div class="menu-item">
                                            <a href="{{ route('deceased.create') }}" class="menu-link text-black">
                                                <span class="menu-icon">
                                                    <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm007.svg-->
                                                    <span class="svg-icon svg-icon-2">
                                                        <i class="fas fa-user-plus fs-4"></i>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </span>
                                                <span class="menu-title">Mevta Ekle</span>
                                            </a>
                                        </div>
                                    @endif
                                    @if (Auth::user()->role->funeral_management)
                                        <div class="menu-item">
                                            <div class="menu-content pt-8 pb-2">
                                                <span class="menu-section text-muted text-uppercase fs-8 ls-1">Cenaze
                                                    İlanı
                                                    Yönetimi</span>
                                            </div>
                                        </div>
                                        <div class="menu-item">
                                            <a href="{{ route('funeral-notices.index') }}"
                                                class="menu-link text-black">
                                                <span class="menu-icon">
                                                    <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm007.svg-->
                                                    <span class="svg-icon svg-icon-2">
                                                        <i class="fas fa-bookmark fs-3"></i>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </span>
                                                <span class="menu-title">Cenaze İlanları</span>
                                            </a>
                                        </div>
                                    @endif
                                    @if (Auth::user()->role->prayer_management)
                                        <div class="menu-item">
                                            <div class="menu-content pt-8 pb-2">
                                                <span class="menu-section text-muted text-uppercase fs-8 ls-1">Dua
                                                    Yönetimi</span>
                                            </div>
                                        </div>
                                        <div class="menu-item">
                                            <a href="{{ route('prayers.index') }}" class="menu-link text-black">
                                                <span class="menu-icon">
                                                    <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm007.svg-->
                                                    <span class="svg-icon svg-icon-2">
                                                        <i class="fas fa-quran fs-3"></i>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </span>
                                                <span class="menu-title">Dualar</span>
                                            </a>
                                        </div>
                                        <div class="menu-item">
                                            <a href="{{ route('prayers.create') }}" class="menu-link text-black">
                                                <span class="menu-icon">
                                                    <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm007.svg-->
                                                    <span class="svg-icon svg-icon-2">
                                                        <i class="fas fa-hands fs-3"></i>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </span>
                                                <span class="menu-title">Dua Ekle</span>
                                            </a>
                                        </div>
                                    @endif
                                    @if (Auth::user()->role->notification_management)
                                        <div class="menu-item">
                                            <div class="menu-content pt-8 pb-2">
                                                <span class="menu-section text-muted text-uppercase fs-8 ls-1">Bildirim
                                                    Yönetimi</span>
                                            </div>
                                        </div>
                                        <div class="menu-item">
                                            <a href="{{ route('suggestions-complaints.index') }}"
                                                class="menu-link text-black">
                                                <span class="menu-icon">
                                                    <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm007.svg-->
                                                    <span class="svg-icon svg-icon-2">
                                                        <i class="fas fa-comment-alt fs-3"></i>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </span>
                                                <span class="menu-title">Öneri ve Şikayet</span>
                                            </a>
                                        </div>
                                        <div class="menu-item">
                                            <a href="{{ route('messages.index') }}" class="menu-link text-black">
                                                <span class="menu-icon">
                                                    <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm007.svg-->
                                                    <span class="svg-icon svg-icon-2">
                                                        <i class="fas fa-envelope fs-3"></i>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </span>
                                                <span class="menu-title">Mesajlar</span>
                                            </a>
                                        </div>
                                        <div class="menu-item">
                                            <a href="{{ route('comment.index') }}" class="menu-link text-black">
                                                <span class="menu-icon">
                                                    <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm007.svg-->
                                                    <span class="svg-icon svg-icon-2">
                                                        <i class="fas fa-comments fs-3"></i>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </span>
                                                <span class="menu-title">Yorumlar</span>
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <!--end::Menu-->
                        </div>
                    </div>
                    <!--end::Aside menu-->
                </div>
                <!--end::Aside-->
                <!--begin::Container-->
                <div class="d-flex flex-column flex-column-fluid container-fluid">
                    <!--begin::Post-->
                    @yield('content')
                    <!--end::Post-->
                    <!--begin::Footer-->
                    <div class="footer py-4 d-flex flex-center flex-column-auto align-items-center" id="kt_footer">
                        <!--begin::Copyright-->
                        <div class="text-dark order-2 order-md-1">
                            <span class="text-dark fw-bold me-1">Copyright ©️ 2021 - reklamlarim.com - Dijital Reklam
                                Ajansı</span>
                        </div>
                        <!--end::Copyright-->
                    </div>
                    <!--end::Footer-->
                </div>
                <!--end::Container-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Page-->
    </div>
    <!--end::Root-->
    <!--begin::Scrolltop-->
    <div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
        <!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
        <span class="svg-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                fill="none">
                <rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1"
                    transform="rotate(90 13 6)" fill="black" />
                <path
                    d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z"
                    fill="black" />
            </svg>
        </span>
        <!--end::Svg Icon-->
    </div>
    <!--end::Scrolltop-->
    <!--end::Main-->
    <script src="{{ asset('back/assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('back/assets/js/scripts.bundle.js') }}"></script>
    <script src="{{ asset('back/assets/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>
    <script src="{{ asset('back/assets/js/custom/widgets.js') }}"></script>
    <script src="{{ asset('back/assets/js/custom/intro.js') }}"></script>
    <script src="https://cdn.amcharts.com/lib/4/core.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <script src="{{ asset('back/assets/plugins/custom/ckeditor/ckeditor-classic.bundle.js') }}"></script>
    @if (session('success'))
        <script>
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 1500
            })
        </script>
    @endif
    @if (session('error'))
        <script>
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: "{{ session('error') }}",
                showConfirmButton: false,
                timer: 1500
            })
        </script>
    @endif
    @yield('js')
</body>

</html>
