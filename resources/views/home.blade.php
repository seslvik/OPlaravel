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
    <div class="p-t-50">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card-box">
                        <h6 class="m-t-0">Нафтан</h6>
                        <div>
                            <a href="{{ route('naftanhome') }}">
                                <img class="card-img-top" src="{{ asset('img/sputnik/Нафтан100_mini.jpg') }}" alt="ОАО Нафтан">
                            </a>
                        </div>
                    </div>
                </div> <!-- end col -->
                <div class="col-lg-6">
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
    <!-- end wrapper -->
@endsection
