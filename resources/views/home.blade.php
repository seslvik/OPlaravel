@extends('layouts.base')
{{--@section('content2')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Здесь будет домашняя страничка!!!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection--}}
@section('content')
    @php /** @var int $operplan_count */ @endphp
    <div class="p-t-50">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-5">
                    <div class="card-box">
                        <h6 class="m-t-0">Нафтан</h6>
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
