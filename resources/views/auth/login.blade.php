{{--@extends('layouts.app')--}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <title>Авторизация</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
   {{-- <script src="{{ asset('js/app.js') }}" defer></script>--}}
    <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}">

    <!-- App css -->
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
                                Авторизация на сайте
                            </h6>

                        </div>

                       {{-- <div class="alert alert-icon alert-danger alert-dismissible fade show" role="alert" style="">
                            <i class="mdi mdi-block-helper"></i>
                            <strong>Ошибка!</strong>
                        </div>--}}

                        <div class="account-content">
                            <form method="post" class="form-horizontal" action="{{ route('login') }}">
                                @csrf
                                <div class="form-group m-b-20">
                                    <div class="col-12">
                                        <label for="name">Логин</label>
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"   name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group m-b-20">
                                    <div class="col-12">
                                        <label for="password">Пароль</label>
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group m-b-30">
                                    <div class="col-12">
                                        <div class="checkbox checkbox-primary">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="remember">
                                                {{ __('Запомни меня') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group account-btn text-center m-t-10">
                                    <div class="col-12">
                                        <button class="btn btn-lg btn-primary btn-block" type="submit">Вход</button>
                                        @if (Route::has('password.request'))
                                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                                {{ __('Забыли Ваш пароль?') }}
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </form>

                            <div class="clearfix"></div>

                        </div>
                    </div>
                    <!-- end card-box-->


                    <div class="row m-t-50">
                        <div class="col-sm-12 text-center">
                            <p class="text-muted">У Вас нет аккаунта? <a href="{{ route('register') }}" class="text-dark m-l-5"><span style="color: #8a6d3b">==> Регистрация</span></a></p>
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

