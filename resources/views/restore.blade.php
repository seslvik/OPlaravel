@extends('layouts.base')

@section('content')
    @php /** @var \App\Models\Operplan $operplans */ @endphp
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="header-title m-t-0 m-b-20">Восстановление (окончательное удаление) удаленных объектов</h4>
                </div>
            </div>

            <div class="row">
                <div class="col-12">

                    @include('includes.result_messages')

                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Оперативные планы</a>
                            <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Пожарные гидранты</a>
                            <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Объекты</a>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                            <div class="table-responsive">
                                <table id="datatable" class="table table-bordered table-hover table-sm">
                                    <thead>
                                    <tr>
                                        <th>№</th>
                                        <th>Завод</th>
                                        <th>Объект</th>
                                        <th>Описание объекта</th>
                                        <th>Дата удаления</th>
                                        <th>Восстановить</th>
                                        <th>Удалить</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <form  action="" method="GET">
                                        @csrf
                                            @foreach($operplans as $operplan)
                                                <tr>
                                                    <td>{{$loop->iteration }}</td>
                                                    <td>{{ $operplan->zavod }}</td>
                                                    <td><a href = '{{ $operplan->file }}' target="_blank">{{ $operplan->objekt }}</a></td>
                                                    <td>{{ $operplan->opisanie }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($operplan->deleted_at)->format('d.m.Y H:i') }} Создатель: {{$operplan->user->name ?? 'удалён'}}</td>
                                                    @if($operplan->zavod == 'Нафтан')
                                                        <td><a href = '{{ route('operplan.naftan.restore', $operplan->id) }}'>Восстановить</a></td>
                                                    @else
                                                        <td><a href = '{{ route('operplan.polymir.restore', $operplan->id) }}'>Восстановить</a></td>
                                                    @endif


                                                    <td><a href = ''>Удалить</a></td>
                                                </tr>
                                            @endforeach
                                        </form>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>№</th>
                                        <th>Завод</th>
                                        <th>Объект</th>
                                        <th>Описание объекта</th>
                                        <th>Дата удаления</th>
                                        <th>Восстановить</th>
                                        <th>Удалить</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                            <div class="table-responsive">
                                <table id="datatable2" class="table table-bordered table-hover table-sm">
                                    <thead>
                                    <tr>
                                        <th>№</th>
                                        <th>Завод</th>
                                        <th>Объект</th>
                                        <th>Описание объекта</th>
                                        <th>Дата удаления</th>
                                        <th>Восстановить</th>
                                        <th>Удалить</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <form  action="" method="GET" >
                                        @csrf
                                        @foreach($gidrants as $gidrant)
                                            <tr>
                                                <td>{{$loop->iteration }}</td>
                                                <td>{{ $gidrant->zavod }}</td>
                                                <td><a href = '{{ $gidrant->file }}' target="_blank">{{ $gidrant->objekt }}</a></td>
                                                <td>{{ $gidrant->opisanie }}</td>
                                                <td>{{ \Carbon\Carbon::parse($gidrant->deleted_at)->format('d.m.Y H:i') }} Создатель: {{$gidrant->user->name ?? 'удалён'}}</td>
                                                @if($gidrant->zavod == 'Нафтан')
                                                    <td><a href = '{{ route('gidrant.naftan.restore', $gidrant->id) }}'>Восстановить</a></td>
                                                @else
                                                    <td><a href = '{{ route('gidrant.polymir.restore', $gidrant->id) }}'>Восстановить</a></td>
                                                @endif


                                                <td><a href = ''>Удалить</a></td>
                                            </tr>
                                        @endforeach
                                    </form>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>№</th>
                                        <th>Завод</th>
                                        <th>Объект</th>
                                        <th>Описание объекта</th>
                                        <th>Дата удаления</th>
                                        <th>Восстановить</th>
                                        <th>Удалить</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                            <div class="table-responsive">
                                <table id="datatable3" class="table table-bordered table-hover table-sm">
                                    <thead>
                                    <tr>
                                        <th>№</th>
                                        <th>Завод</th>
                                        <th>Описание объекта</th>
                                        <th>Дата удаления</th>
                                        <th>Восстановить</th>
                                        <th>Удалить</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <form  action="" method="GET" >
                                        @csrf
                                        @foreach($polygons as $polygon)
                                            <tr>
                                                <td>{{$loop->iteration }}</td>
                                                <td>{{ $polygon->zavod }}</td>
                                                <td>{{ $polygon->opisanie }}</td>
                                                <td>{{ \Carbon\Carbon::parse($polygon->deleted_at)->format('d.m.Y H:i') }} Создатель: {{$polygon->user->name ?? 'удалён'}}</td>
                                                @if($polygon->zavod == 'Нафтан')
                                                    <td><a href = '{{ route('polygon.naftan.restore', $polygon->id) }}'>Восстановить</a></td>
                                                @else
                                                    <td><a href = '{{ route('polygon.polymir.restore', $polygon->id) }}'>Восстановить</a></td>
                                                @endif


                                                <td><a href = ''>Удалить</a></td>
                                            </tr>
                                        @endforeach
                                    </form>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>№</th>
                                        <th>Завод</th>
                                        <th>Описание объекта</th>
                                        <th>Дата удаления</th>
                                        <th>Восстановить</th>
                                        <th>Удалить</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>


                </div>
            </div> <!-- end row -->
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#datatable').DataTable();
            $('#datatable2').DataTable();
            $('#datatable3').DataTable();
        } );
    </script>
@endsection

