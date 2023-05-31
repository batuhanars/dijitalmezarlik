@extends('back.layout.main')
@section('title', 'Anasayfa')
@section('content')
    <div class="content flex-column-fluid" id="kt_content">
        <div class="row">
            <div class="col-lg-6">
                <!--begin::Charts Widget 1-->
                <div class="card card-xl-stretch mb-xl-8">
                    <div class="card-header">
                        <h4 class="card-title">
                            Ziyaretçi İstatistiği
                        </h4>
                    </div>
                    <div class="card-body">
                        <div id="chart"></div>
                    </div>
                </div>
                <!--end::Charts Widget 1-->
            </div>
            <div class="col-lg-6">
                <!--begin::Row-->
                <div class="row g-5 g-xl-8">
                    <div class="col-lg-6">
                        <!--begin: Statistics Widget 6-->
                        <div class="card bg-light-success card-xl-stretch mb-xl-8">
                            <!--begin::Body-->
                            <div class="card-body my-3">
                                <a href="#" class="card-title fw-bolder text-success fs-5 mb-3 d-block fs-3">Toplam
                                    Ziyaretçi</a>
                                <div class="py-1">
                                    <span class="text-dark fs-1 fw-bolder me-2">{{ $visitorsInfo->count() }}</span>
                                    <span class="fw-bold text-muted fs-6">Kişi</span>
                                </div>
                                <div class="progress h-7px bg-success bg-opacity-50 mt-7">
                                    <div class="progress-bar bg-success" role="progressbar"
                                        style="width: {{ $visitorsInfo->count() }}%"
                                        aria-valuenow="{{ $visitorsInfo->count() }}" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>
                            </div>
                            <!--end:: Body-->
                        </div>
                        <!--end: Statistics Widget 6-->
                    </div>
                    <div class="col-lg-6">
                        <!--begin: Statistics Widget 6-->
                        <div class="card bg-light-warning card-xl-stretch mb-xl-8">
                            <!--begin::Body-->
                            <div class="card-body my-3">
                                <a href="#" class="card-title fw-bolder text-warning fs-5 mb-3 d-block fs-3">Bugün</a>
                                <div class="py-1">
                                    <span
                                        class="text-dark fs-1 fw-bolder me-2">{{ $visitorsInfo->visitorsToday() }}</span>
                                    <span class="fw-bold text-muted fs-6">Kişi</span>
                                </div>
                                <div class="progress h-7px bg-warning bg-opacity-50 mt-7">
                                    <div class="progress-bar bg-warning" role="progressbar"
                                        style="width: {{ $visitorsInfo->visitorsToday() }}%"
                                        aria-valuenow="{{ $visitorsInfo->visitorsToday() }}" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>
                            </div>
                            <!--end:: Body-->
                        </div>
                        <!--end: Statistics Widget 6-->
                    </div>
                </div>
                <!--end::Row-->
                <!--begin::Row-->
                <div class="row g-5 g-xl-8">
                    <div class="col-lg-6">
                        <!--begin: Statistics Widget 6-->
                        <div class="card bg-light-danger card-xl-stretch mb-xl-8">
                            <!--begin::Body-->
                            <div class="card-body my-3">
                                <a href="#" class="card-title fw-bolder text-danger fs-5 mb-3 d-block fs-3">Dün</a>
                                <div class="py-1">
                                    <span
                                        class="text-dark fs-1 fw-bolder me-2">{{ $visitorsInfo->visitorsYesterday() }}</span>
                                    <span class="fw-bold text-muted fs-6">Kişi</span>
                                </div>
                                <div class="progress h-7px bg-danger bg-opacity-50 mt-7">
                                    <div class="progress-bar bg-danger" role="progressbar"
                                        style="width: {{ $visitorsInfo->visitorsYesterday() }}%"
                                        aria-valuenow="{{ $visitorsInfo->visitorsYesterday() }}" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>
                            </div>
                            <!--end:: Body-->
                        </div>
                        <!--end: Statistics Widget 6-->
                    </div>
                    <div class="col-lg-6">
                        <!--begin: Statistics Widget 6-->
                        <div class="card bg-light-info card-xl-stretch mb-xl-8">
                            <!--begin::Body-->
                            <div class="card-body my-3">
                                <a href="#" class="card-title fw-bolder text-info fs-5 mb-3 d-block fs-3">Bu
                                    Ay</a>
                                <div class="py-1">
                                    <span
                                        class="text-dark fs-1 fw-bolder me-2">{{ $visitorsInfo->visitorsThisMonth() }}</span>
                                    <span class="fw-bold text-muted fs-6">Kişi</span>
                                </div>
                                <div class="progress h-7px bg-info bg-opacity-50 mt-7">
                                    <div class="progress-bar bg-info" role="progressbar"
                                        style="width: {{ $visitorsInfo->visitorsThisMonth() }}%"
                                        aria-valuenow="{{ $visitorsInfo->visitorsThisMonth() }}" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>
                            </div>
                            <!--end:: Body-->
                        </div>
                        <!--end: Statistics Widget 6-->
                    </div>
                </div>
                <!--end::Row-->
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="row g-5 g-xl-8">
                    <div class="col-lg-6">
                        <!--begin::Statistics Widget 5-->
                        <a href="#" class="card bg-warning hoverable card-xl-stretch mb-xl-8">
                            <!--begin::Body-->
                            <div class="card-body">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen032.svg-->
                                <span class="svg-icon svg-icon-white svg-icon-3x ms-n1">
                                    <i class="fas fa-id-card-alt text-white fs-3x"></i>
                                </span>
                                <!--end::Svg Icon-->
                                <div class="text-white fw-bolder fs-2 mb-2 mt-5">{{ $totalCemetery }}</div>
                                <div class="fw-bold text-white fs-3">Toplam Mezarlık Sayısı</div>
                            </div>
                            <!--end::Body-->
                        </a>
                        <!--end::Statistics Widget 5-->
                    </div>
                    <div class="col-lg-6">
                        <!--begin::Statistics Widget 5-->
                        <a href="#" class="card bg-danger hoverable card-xl-stretch mb-xl-8">
                            <!--begin::Body-->
                            <div class="card-body">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen032.svg-->
                                <span class="svg-icon svg-icon-white svg-icon-3x ms-n1">
                                    <i class="fas fa-users fs-3x text-white"></i>
                                </span>
                                <!--end::Svg Icon-->
                                <div class="text-white fw-bolder fs-2 mb-2 mt-5">{{ $deceasedInfo->count() }}</div>
                                <div class="fw-bold text-white fs-3">Toplam Vefat Sayısı</div>
                            </div>
                            <!--end::Body-->
                        </a>
                        <!--end::Statistics Widget 5-->
                    </div>
                </div>
                <div class="row g-5 g-xl-8">
                    <div class="col-lg-6">
                        <!--begin::Statistics Widget 5-->
                        <a href="#" class="card bg-success hoverable card-xl-stretch mb-xl-8">
                            <!--begin::Body-->
                            <div class="card-body">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen032.svg-->
                                <span class="svg-icon svg-icon-white svg-icon-3x ms-n1">
                                    <i class="fas fa-city fs-3x text-white"></i>
                                </span>
                                <!--end::Svg Icon-->
                                <div class="text-white fw-bolder fs-2 mb-2 mt-5">{{ $totalProvince }}</div>
                                <div class="fw-bold text-white fs-3">Toplam İl Sayısı</div>
                            </div>
                            <!--end::Body-->
                        </a>
                        <!--end::Statistics Widget 5-->
                    </div>
                    <div class="col-lg-6">
                        <!--begin::Statistics Widget 5-->
                        <a href="#" class="card bg-primary hoverable card-xl-stretch mb-xl-8">
                            <!--begin::Body-->
                            <div class="card-body">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen032.svg-->
                                <span class="svg-icon svg-icon-white svg-icon-3x ms-n1">
                                    <i class="fas fa-building fs-3x text-white"></i>
                                </span>
                                <!--end::Svg Icon-->
                                <div class="text-white fw-bolder fs-2 mb-2 mt-5">{{ $totalDistrict }}</div>
                                <div class="fw-bold text-white fs-3">Toplam İlçe Sayısı</div>
                            </div>
                            <!--end::Body-->
                        </a>
                        <!--end::Statistics Widget 5-->
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <!--begin::Charts Widget 1-->
                <div class="card card-xl-stretch mb-xl-8">
                    <div class="card-header">
                        <h4 class="card-title">Aylık Vefat İstatistiği</h4>
                    </div>
                    <div class="card-body">
                        <div id="chart2"></div>
                    </div>
                </div>
                <!--end::Charts Widget 1-->
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <!--begin::Charts Widget 2-->
                <div class="card card-xl-stretch mb-xl-8">
                    <div class="card-header">
                        <h4 class="card-title">Yıllık Vefat İstatistiği</h4>
                    </div>
                    <div class="card-body">
                        <div id="chart3"></div>
                    </div>
                </div>
                <!--end::Charts Widget 2-->
            </div>
            <div class="col-lg-6">
                <!--begin::Row-->
                <div class="row g-5 g-xl-8">
                    <div class="col-lg-6">
                        <!--begin: Statistics Widget 6-->
                        <div class="card bg-light-success card-xl-stretch mb-xl-8">
                            <!--begin::Body-->
                            <div class="card-body my-3">
                                <a href="#" class="card-title fw-bolder text-success fs-5 mb-3 d-block fs-3">Bugün Vefat
                                    Edenler</a>
                                <div class="py-1">
                                    <span
                                        class="text-dark fs-1 fw-bolder me-2">{{ $deceasedInfo->whoDiedToday() }}</span>
                                    <span class="fw-bold text-muted fs-6">Kişi</span>
                                </div>
                                <div class="progress h-7px bg-success bg-opacity-50 mt-7">
                                    <div class="progress-bar bg-success" role="progressbar"
                                        style="width: {{ $deceasedInfo->whoDiedToday() }}%"
                                        aria-valuenow="{{ $deceasedInfo->whoDiedToday() }}" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>
                            </div>
                            <!--end:: Body-->
                        </div>
                        <!--end: Statistics Widget 6-->
                    </div>
                    <div class="col-lg-6">
                        <!--begin: Statistics Widget 6-->
                        <div class="card bg-light-warning card-xl-stretch mb-xl-8">
                            <!--begin::Body-->
                            <div class="card-body my-3">
                                <a href="#" class="card-title fw-bolder text-warning fs-5 mb-3 d-block fs-3">Dün Vefat
                                    Edenler</a>
                                <div class="py-1">
                                    <span
                                        class="text-dark fs-1 fw-bolder me-2">{{ $deceasedInfo->thoseWhoDiedYesterday() }}</span>
                                    <span class="fw-bold text-muted fs-6">Kişi</span>
                                </div>
                                <div class="progress h-7px bg-warning bg-opacity-50 mt-7">
                                    <div class="progress-bar bg-warning" role="progressbar"
                                        style="width: {{ $deceasedInfo->thoseWhoDiedYesterday() }}%"
                                        aria-valuenow="{{ $deceasedInfo->thoseWhoDiedYesterday() }}" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>
                            </div>
                            <!--end:: Body-->
                        </div>
                        <!--end: Statistics Widget 6-->
                    </div>
                </div>
                <!--end::Row-->
                <!--begin::Row-->
                <div class="row g-5 g-xl-8">
                    <div class="col-lg-6">
                        <!--begin: Statistics Widget 6-->
                        <div class="card bg-light-danger card-xl-stretch mb-xl-8">
                            <!--begin::Body-->
                            <div class="card-body my-3">
                                <a href="#" class="card-title fw-bolder text-danger fs-5 mb-3 d-block fs-3">Bu Ay Vefat
                                    Edenler</a>
                                <div class="py-1">
                                    <span
                                        class="text-dark fs-1 fw-bolder me-2">{{ $deceasedInfo->whoDiedThisMonth() }}</span>
                                    <span class="fw-bold text-muted fs-6">Kişi</span>
                                </div>
                                <div class="progress h-7px bg-danger bg-opacity-50 mt-7">
                                    <div class="progress-bar bg-danger" role="progressbar"
                                        style="width: {{ $deceasedInfo->whoDiedThisMonth() }}%"
                                        aria-valuenow="{{ $deceasedInfo->whoDiedThisMonth() }}" aria-valuemin="0"
                                        aria-valuemax="100">
                                    </div>
                                </div>
                            </div>
                            <!--end:: Body-->
                        </div>
                        <!--end: Statistics Widget 6-->
                    </div>
                    <div class="col-lg-6">
                        <!--begin: Statistics Widget 6-->
                        <div class="card bg-light-info card-xl-stretch mb-xl-8">
                            <!--begin::Body-->
                            <div class="card-body my-3">
                                <a href="#" class="card-title fw-bolder text-info fs-5 mb-3 d-block fs-3">Bu
                                    Yıl Vefat Edenler</a>
                                <div class="py-1">
                                    <span class="text-dark fs-1 fw-bolder me-2">{{ $deceasedInfo->whoDiedThisYear() }}
                                    </span>
                                    <span class="fw-bold text-muted fs-6">Kişi</span>
                                </div>
                                <div class="progress h-7px bg-info bg-opacity-50 mt-7">
                                    <div class="progress-bar bg-info" role="progressbar"
                                        style="width: {{ $deceasedInfo->whoDiedThisYear() }}%"
                                        aria-valuenow="{{ $deceasedInfo->whoDiedThisYear() }}" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>
                            </div>
                            <!--end:: Body-->
                        </div>
                        <!--end: Statistics Widget 6-->
                    </div>
                </div>
                <!--end::Row-->
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        var options = {
            series: [{
                name: 'Ziyaretçi Sayısı',
                data: [
                    {{ $visitorsInfo->visitorsInJanuary() }},
                    {{ $visitorsInfo->visitorsInFebruary() }},
                    {{ $visitorsInfo->visitorsInMarch() }},
                    {{ $visitorsInfo->visitorsInApril() }},
                    {{ $visitorsInfo->visitorsInMay() }},
                    {{ $visitorsInfo->visitorsInJune() }},
                    {{ $visitorsInfo->visitorsInJuly() }},
                    {{ $visitorsInfo->visitorsInAugust() }},
                    {{ $visitorsInfo->visitorsInSeptember() }},
                    {{ $visitorsInfo->visitorsInOctober() }},
                    {{ $visitorsInfo->visitorsInNovember() }},
                    {{ $visitorsInfo->visitorsInDecember() }},
                ]
            }],
            chart: {
                height: 247,
                type: 'bar',
            },
            plotOptions: {
                bar: {
                    columnWidth: "27.5%",
                    dataLabels: {
                        position: 'top', // top, center, bottom
                    },
                }
            },
            dataLabels: {
                enabled: true,
                formatter: function(val) {
                    return val;
                },
                offsetY: -20,
                style: {
                    fontSize: '12px',
                    colors: ["#304758"]
                }
            },

            xaxis: {
                categories: ["Oca", "Şub", "Mar", "Nis", "May", "Haz", "Tem", "Ağu", "Eyl", "Eki", "Kas", "Ara"],
            },
            yaxis: {
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false,
                },
                labels: {
                    show: false,
                    formatter: function(val) {
                        return val;
                    }
                }

            },
        };
        var options2 = {
            series: [{
                name: 'Vefat Sayısı',
                data: [
                    {{ $deceasedInfo->thoseWhoDiedInJanuary() }},
                    {{ $deceasedInfo->thoseWhoDiedInFebruary() }},
                    {{ $deceasedInfo->thoseWhoDiedInMarch() }},
                    {{ $deceasedInfo->thoseWhoDiedInApril() }},
                    {{ $deceasedInfo->thoseWhoDiedInMay() }},
                    {{ $deceasedInfo->thoseWhoDiedInJune() }},
                    {{ $deceasedInfo->thoseWhoDiedInJuly() }},
                    {{ $deceasedInfo->thoseWhoDiedInAugust() }},
                    {{ $deceasedInfo->thoseWhoDiedInSeptember() }},
                    {{ $deceasedInfo->thoseWhoDiedInOctober() }},
                    {{ $deceasedInfo->thoseWhoDiedInNovember() }},
                    {{ $deceasedInfo->thoseWhoDiedInDecember() }}
                ]
            }],
            chart: {
                height: 230,
                type: 'bar',
            },
            plotOptions: {
                bar: {
                    columnWidth: '27.5%',
                    dataLabels: {
                        position: 'top', // top, center, bottom
                    },
                }
            },
            dataLabels: {
                enabled: true,
                formatter: function(val) {
                    return val;
                },
                offsetY: -20,
                style: {
                    fontSize: '12px',
                    colors: ["#304758"]
                }
            },

            xaxis: {
                categories: ["Oca", "Şub", "Mar", "Nis", "May", "Haz", "Tem", "Ağu", "Eyl", "Eki", "Kas", "Ara"]
            },
            yaxis: {
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false,
                },
                labels: {
                    show: false,
                    formatter: function(val) {
                        return val;
                    }
                }

            },
        };
        var options3 = {
            series: [{
                name: 'Vefat Sayısı',
                data: [
                    {{ $deceasedInfo->whoDiedInTwoThousandTen() }},
                    {{ $deceasedInfo->whoDiedInTwoThousandEleven() }},
                    {{ $deceasedInfo->whoDiedInTwoThousandTwelve() }},
                    {{ $deceasedInfo->whoDiedInTwoThousandThirteen() }},
                    {{ $deceasedInfo->whoDiedInTwoThousandFourteen() }},
                    {{ $deceasedInfo->whoDiedInTwoThousandFifteen() }},
                    {{ $deceasedInfo->whoDiedInTwoThousandSixteen() }},
                    {{ $deceasedInfo->whoDiedInTwoThousandSeventeen() }},
                    {{ $deceasedInfo->whoDiedInTwoThousandEighteen() }},
                    {{ $deceasedInfo->whoDiedInTwoThousandNineteen() }},
                    {{ $deceasedInfo->whoDiedInTwoThousandTwenty() }},
                    {{ $deceasedInfo->whoDiedInTwoThousandTwentyOne() }}
                ]
            }],
            chart: {
                height: 245,
                type: 'bar',
            },
            plotOptions: {
                bar: {
                    columnWidth: "25%",
                    dataLabels: {
                        position: 'top', // top, center, bottom
                    },
                }
            },
            dataLabels: {
                enabled: true,
                formatter: function(val) {
                    return val;
                },
                offsetY: -20,
                style: {
                    fontSize: '12px',
                    colors: ["#304758"]
                }
            },

            xaxis: {
                categories: ["2011", "2012", "2013", "2014", "2015", "2016", "2017", "2018", "2019", "2020", "2021",
                    "2022"
                ],
            },
            yaxis: {
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false,
                },
                labels: {
                    show: false,
                    formatter: function(val) {
                        return val;
                    }
                }

            },
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
        var chart2 = new ApexCharts(document.querySelector("#chart2"), options2);
        chart2.render();
        var chart3 = new ApexCharts(document.querySelector("#chart3"), options3);
        chart3.render();
    </script>
@endsection
