@extends('layouts.base')
@section('content')
    @php /** @var int $operplan_count */ @endphp
    <div class="p-t-50">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-5">
                    <div class="card-box">
                        {{--<h6 class="m-t-0">Нафтан</h6>--}}
                        <table class="m-t-0" style="width: 100%;border-spacing: 0;">
                            <tr>
                                <td style="width: 50%;"><h6>Нафтан</h6></td>
                                <td style="text-align: right;"><h6>ОП- {{ $operplan_count }};ПГ-{{ $gidrant_count }}</h6></td>
                            </tr>
                        </table>
                        <div>
                            <a href="{{ route('naftanhome') }}">
                                <img class="card-img-top" src="{{ asset('img/sputnik/Нафтан100_mini.jpg') }}" alt="ОАО Нафтан">
                            </a>
                        </div>
                    </div>
                </div> <!-- end col -->

                <div class="col-lg-2">
                    {{--<div class="card-box">--}}
                        {{--<h5 class="m-t-0 font-14">Donut Chart</h5>--}}
                        <div id="morris-donut" class="morris-chart"></div>
                    {{--</div>--}}
                </div> <!-- end col -->

                <div class="col-lg-5">
                    <div class="card-box">
                        <h6 class="m-t-0">Полимир</h6>
                        <div>
                            <a href="{{ route('polymirhome') }}">
                                <!--<img src="img/logo_sm.png" alt="" height="26" class="logo-small">-->
                                <img class="card-img-top" src="{{ asset('img/sputnik/Полимир100_mini.jpg') }}" alt="ОАО Нафтан">
                            </a>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div> <!-- end container -->
    </div>
    <script src="{{ asset('js/morris/morris.min.js') }}"></script>
    <script src="{{ asset('js/morris/raphael-min.js') }}"></script>
    <script>

        !function($) {
            "use strict";

            var MorrisCharts = function() {};

                //creates Donut chart
                MorrisCharts.prototype.createDonutChart = function(element, data, colors) {
                    Morris.Donut({
                        element: element,
                        data: data,
                        resize: true, //defaulted to true
                        colors: colors
                    });
                },
                MorrisCharts.prototype.init = function() {
                    //creating donut chart
                    var $donutData = [
                        {label: "Оперпланы", value: '{{ $operplan_count }}'},
                        {label: "Гидранты", value: '{{ $gidrant_count }}'},
                        {label: "Объекты", value: '{{ $object_count }}'}
                    ];
                    this.createDonutChart('morris-donut', $donutData, ['#458bc4','#604f24', '#3db9dc']);
                },
                //init
                $.MorrisCharts = new MorrisCharts, $.MorrisCharts.Constructor = MorrisCharts
        }(window.jQuery),

        //initializing
            function($) {
                "use strict";
                $.MorrisCharts.init();
            }(window.jQuery);
    </script>
@endsection
