<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <title>Регистрация</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}">
    <link href="{{ asset('css/icons.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/style.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="wrapper-page">
                    <div class="m-t-40 card-box">
                        <div class="text-center">
                            <h6 class="text-uppercase m-t-0 m-b-30">
                                <a href="{{ route('home') }}" class="text-success">
                                    <span><img src="{{ asset('img/logo.png') }}" alt="" height="50"></span>
                                </a>
                                Регистрация нового пользователя
                            </h6>
                        </div>
                        <div class="account-content">
                                <div class="form-group m-b-20">
                                    <div class="col-12 text-center">
                                        <h3><strong class="text-success">Отлично, Вы зарегистрированы!</strong>  Для активации аккаунта необходимо позвонить инженеру-программисту!</h3>
                                    </div>
                                </div>
                                <div class="form-group account-btn text-center m-t-10">
                                    <div class="col-12">
                                        <a class="btn btn-lg btn-primary btn-block" href="{{ route('register')}}" role="button"> {{ __('ОК') }} </a>
                                    </div>
                                </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <!-- end card-box-->
                    <div class="row m-t-50">
                        <div class="col-sm-12 text-center">
                            <p class="text-muted">У Вас уже есть аккаунт?  <a href="{{ route('login') }}" class="text-dark m-l-5"><span style="color: #8a6d3b">==> Авторизация</span></a></p>
                        </div>
                    </div>
                </div>
                <!-- end wrapper -->
            </div>
        </div>
    </div>
</section>
<script src="{{ asset('js/bootstrap.min.js') }}" defer></script>
</body>
</html>

