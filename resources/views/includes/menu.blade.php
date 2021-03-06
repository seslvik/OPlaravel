    <div class="topbar-main">
        <div class="container-fluid">
            <div class="logo">
                <a href="" class="logo"></a>
            </div>
            <div class="navbar-custom">
                <div id="navigation">
                    <!-- Navigation Menu-->
                    <ul class="navigation-menu">
                        <li class="has-submenu">
                            <a href="{{ route('home') }}"><span><i class="ti-home"></i></span><span> Домой </span> </a>
                        </li>
                        <li class="has-submenu">
                            <a href="{{ route('naftanhome') }}"><span><i class="ti-location-pin"></i></span><span> Нафтан </span> </a>
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
                            <a href="{{ route('polymirhome') }}"><span><i class="ti-location-pin"></i></span><span> Полимир </span> </a>
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
                            {{-- <a href="#"><span><i></i></span><span></span> </a>--}}
                            <a href="#"><span><i class="ti-export"></i></span><span> Экспорт </span> </a>
                            <ul class="submenu">
                                <li><a href="{{ route('operplan.export')}}">Оперпланы в Excell</a></li>
                                <li><hr></li>
                                <li><a href="{{ route('gidrant.export')}}">Гидранты в Excell</a></li>
                            </ul>
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
                    <li class="dropdown notification-list">
                        <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button"
                           aria-haspopup="false" aria-expanded="false">
                            @if(Auth::user()->avatar == 1)
                                <img src="{{ asset('img/avatar-1.jpg') }}" alt="user" class="rounded-circle"> <span class="ml-1 pro-user-name"> {{ Auth::user()->firstname }} <i class="mdi mdi-chevron-down"></i> </span>
                            @else
                                <img src="{{ asset('img/avatar-2.jpg') }}" alt="user" class="rounded-circle"> <span class="ml-1 pro-user-name"> {{ Auth::user()->firstname }} <i class="mdi mdi-chevron-down"></i> </span>
                            @endif
                        </a>
                        <div class="dropdown-menu dropdown-menu-right profile-dropdown ">

                            <!-- item-->
                            <a href="{{ route('restore.index')}}" class="dropdown-item notify-item">
                                <i class="ti-search"></i> <span>Восстановить объект</span>
                            </a>
                            <!-- item-->
                            @if(Auth::user()->admin == '1')
                                <a href="{{ route('user.admin.index')}}" class="dropdown-item notify-item">
                                    <i class="ti-settings"></i> <span>Настройки</span>
                                </a>
                            @endif
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
        </div> <!-- end container -->
</div>
