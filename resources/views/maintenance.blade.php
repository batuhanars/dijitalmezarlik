<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <title>{{ $setting ? $setting->title : '' }} - Bakım Modu</title>
    <meta charset="utf-8" />
    <meta name="description" content="{{ $setting ? $setting->description : '' }}" />
    <meta name="keywords" content="{{ $setting ? $setting->keywords : '' }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" href="{{ $setting ? $setting->favicon : '' }}" />
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    <link href="{{ asset('back/assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('back/assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->
    <!--Begin::Google Tag Manager -->
    <!--End::Google Tag Manager -->
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body" class="bg-body">
    <!--begin::Main-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Authentication - Coming Soon-->
        <div
            class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed pt-20">
            <!--begin::Content-->
            <div class="d-flex flex-column flex-center p-10 p-lg-20">
                <!--begin::Coming soon-->
                <div class="d-flex flex-column flex-center">
                    <!--begin::Title-->
                    <h3 class="fw-bolder fs-2qx text-dark m-0 pb-10">{{ $maintenance ? $maintenance->title : '' }}</h3>
                    <!--end::Title-->
                    <!--begin::Counter-->
                    <div id="timer" class="d-flex text-center mb-10 mb-lg-15">
                        <div class="w-65px rounded-3 bg-body shadow-sm py-4 px-5 mx-3">
                            <div id="days" class="fs-2 fw-bolder text-gray-800"></div>
                            <div class="fs-7 fw-bold text-muted">Gün</div>
                        </div>
                        <div class="w-65px rounded-3 bg-body shadow-sm py-4 px-5 mx-3">
                            <div id="hours" class="fs-2 fw-bolder text-gray-800"></div>
                            <div class="fs-7 text-muted">Saat</div>
                        </div>
                        <div class="w-65px rounded-3 bg-body shadow-sm py-4 px-5 mx-3">
                            <div id="minutes" class="fs-2 fw-bolder text-gray-800"></div>
                            <div class="fs-7 text-muted">Dakika</div>
                        </div>
                        <div class="w-65px rounded-3 bg-body shadow-sm py-4 px-5 mx-3">
                            <div id="seconds" class="fs-2 fw-bolder text-gray-800"></div>
                            <div class="fs-7 text-muted">Saniye</div>
                        </div>
                    </div>
                    <!--end::Counter-->
                    <!--begin::Description-->
                    <div class="fw-bolder fs-2 text-muted mb-5 text-center">
                        {{ $maintenance ? $maintenance->description : '' }}</div>
                    <!--end::Description-->
                </div>
                <!--end::Coming soon-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Authentication - Coming Soon-->
    </div>
    <!--end::Main-->
    <!--begin::Javascript-->
    <!--begin::Global Javascript Bundle(used by all pages)-->
    <script src="{{ asset('back/assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('back/assets/js/scripts.bundle.js') }}"></script>
    <!--end::Global Javascript Bundle-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js" type="application/javascript"></script>

    <script src="https://cdn.rawgit.com/hilios/jQuery.countdown/2.2.0/dist/jquery.countdown.min.js"
        type="application/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            function makeTimer() {
                var endTime = new Date("{{ $maintenance ? $maintenance->opening_date : '' }}");
                endTime = (Date.parse(endTime) / 1000);

                var now = new Date();
                now = (Date.parse(now) / 1000);

                var timeLeft = endTime - now;

                var days = Math.floor(timeLeft / 86400);
                var hours = Math.floor((timeLeft - (days * 86400)) / 3600);
                var minutes = Math.floor((timeLeft - (days * 86400) - (hours * 3600)) / 60);
                var seconds = Math.floor((timeLeft - (days * 86400) - (hours * 3600) - (minutes * 60)));

                if (hours < "10") {
                    hours = "0" + hours;
                }
                if (minutes < "10") {
                    minutes = "0" + minutes;
                }
                if (seconds < "10") {
                    seconds = "0" + seconds;
                }

                $("#days").html(days);
                $("#hours").html(hours);
                $("#minutes").html(minutes);
                $("#seconds").html(seconds);

            }

            setInterval(function() {
                makeTimer();
            }, 1000);
        });
    </script>
    <!--end::Javascript-->
</body>
<!--end::Body-->

</html>
