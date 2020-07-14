<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>ОП и ПГ</title>{{--{{ config('app.name', 'Laravel') }}--}}

    <!-- App css -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/icons.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/jquery-ui.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/leaflet.css') }}" rel="stylesheet" type="text/css" />
    <!-- DataTables -->
    <link href="{{ asset('css/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

    <script type="text/javascript" src="{{ asset('js/jquery-1.12.4.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery-ui.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/imgViewer2.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/leaflet.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bs-custom-file-input.js') }}"></script>
</head>
<body>

<header id="topnav">
    <div class="topbar-main">
        <div class="container-fluid">
            <div class="logo">
                <a href="" class="logo"></a>
            </div>

           {{-- @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Вход') }}</a>
                </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Регистрация') }}</a>
                    </li>
                @endif
            @else
--}}

            <div class="navbar-custom">
                <div id="navigation">
                    <!-- Navigation Menu-->
                    <ul class="navigation-menu">
                        <li class="has-submenu">
                            <a href="{{ route('home') }}">
                                <span><i class="ti-home"></i></span><span> Домой </span> </a>
                        </li>

                        <li class="has-submenu">
                            <a href="#"><span><i class="ti-spray"></i></span><span> ОП Нафтан </span> </a>
                            <ul class="submenu">
                                <li class="has-submenu">
                                    <a href="#">Оперативные планы</a>
                                    <ul class="submenu">
                                        <li><a href="{{ route('operplan.naftan.index')}}">Просмотр оперпланов</a></li>
                                        <li><hr></li>
                                        <li><a href="{{ route('operplan.naftan.create') }}">Добавить оперплан</a></li>
                                    </ul>
                                </li>
                                <li class="has-submenu">
                                    <a href="">Пожарные гидранты</a>
                                    <ul class="submenu">
                                        <li><a href="{{ route('gidrant.naftan.index')}}">Просмотр гидрантов</a></li>
                                        <li><hr></li>
                                        <li><a href="{{ route('gidrant.naftan.create') }}">Добавить гидрант</a></li>
                                    </ul>
                                </li>
                                <li class="has-submenu">
                                    <a href="">Границы объектов</a>
                                    <ul class="submenu">
                                        <li><a href="{{ route('polygon.naftan.index')}}">Просмотр объектов</a></li>
                                        <li><hr></li>
                                        <li><a href="{{ route('polygon.naftan.create') }}">Добавить объект</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>

                        <li class="has-submenu">
                            <a href="#"><span><i class="ti-spray"></i></span><span> ОП Полимир </span> </a>
                            <ul class="submenu">
                                <li class="has-submenu">
                                    <a href="#">Оперативные планы</a>
                                    <ul class="submenu">
                                        <li><a href="{{ route('operplan.polymir.index')}}">Просмотр оперпланов</a></li>
                                        <li><hr></li>
                                        <li><a href="{{ route('operplan.polymir.create') }}">Добавить оперплан</a></li>
                                    </ul>
                                </li>
                                <li class="has-submenu">
                                    <a href="">Пожарные гидранты</a>
                                    <ul class="submenu">
                                        <li><a href="{{ route('gidrant.polymir.index')}}">Просмотр гидрантов</a></li>
                                        <li><hr></li>
                                        <li><a href="{{ route('gidrant.polymir.create') }}">Добавить гидрант</a></li>
                                    </ul>
                                </li>
                                <li class="has-submenu">
                                    <a href="">Границы объектов</a>
                                    <ul class="submenu">
                                        <li><a href="{{ route('polygon.polymir.index')}}">Просмотр объектов</a></li>
                                        <li><hr></li>
                                        <li><a href="{{ route('polygon.polymir.create') }}">Добавить объект</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>

                        <li class="has-submenu">
                            <a href="#"><span><i></i></span><span></span> </a>
                        </li>

                    </ul>
                    <!-- End navigation menu -->
                </div> <!-- end #navigation -->
            </div> <!-- end navbar-custom -->

            <div class="menu-extras topbar-custom">
                <ul class="list-unstyled topbar-right-menu float-right mb-0">

                    <li class="menu-item">
                        <!-- Mobile menu toggle-->
                        <a class="navbar-toggle nav-link">
                            <div class="lines">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </a>
                        <!-- End mobile menu toggle-->
                    </li>

                    @yield('checkbox')

                    {{--<li class="dropdown notification-list hide-phone">
                        <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button"
                           aria-haspopup="false" aria-expanded="false">
                            <i class="mdi mdi-earth"></i> Карта с координатами <i class="mdi mdi-chevron-down"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">

                            <a href="" class="dropdown-item" target="_blank">
                                ОАО Нафтан (координаты)
                            </a>

                            <a href="" class="dropdown-item" target="_blank">
                                Завод Полимир (координаты)
                            </a>

                        </div>
                    </li>--}}

                    <li class="dropdown notification-list">
                        <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button"
                           aria-haspopup="false" aria-expanded="false">
                            <img src="{{ asset('img/avatar-2.jpg') }}" alt="user" class="rounded-circle"> <span class="ml-1 pro-user-name"> {{ Auth::user()->name }} <i class="mdi mdi-chevron-down"></i> </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right profile-dropdown ">

                            <!-- item-->
                            <a href="" class="dropdown-item notify-item">
                                <i class="ti-user"></i> <span>Добавить пользователя</span>
                            </a>

                            <!-- item-->
                            <a href="" class="dropdown-item notify-item">
                                <i class="ti-lock"></i> <span>Удалить пользователя</span>
                            </a>

                            <!-- item-->
                            <a href="" class="dropdown-item notify-item">
                                <i class="ti-settings"></i> <span>Настройки</span>
                            </a>

                            <a class="dropdown-item notify-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                <i class="ti-power-off"></i> <span>{{ __('Выход') }}</span>
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>

                        </div>
                    </li>
                </ul>
            </div>
            <!-- end menu-extras -->
            {{--@endguest--}}
        </div> <!-- end container -->
    </div>
    <!-- end topbar-main -->



    <div class="clearfix"></div>
</header>

@yield('content')

{{--<script src="{{ asset('js/popper.min.js') }}"></script>--}}
<script src="{{ asset('js/app.js') }}"></script>

<!-- Required datatable js -->
<script src="{{ asset('js/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/datatables/dataTables.bootstrap4.min.js') }}"></script>

<script src="{{ asset('js/jquery.app.js') }}"></script>


</body>
</html>
