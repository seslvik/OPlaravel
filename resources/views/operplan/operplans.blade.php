@extends('layouts.base')

@section('content')
    @php /** @var \App\Models\Operplan $colums */ @endphp
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="header-title m-t-0 m-b-20">Оперативные планы пожаротушения {{$gde}}</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    @include('includes.result_messages')
                    <div class="table-responsive">
                        <table id="datatable" class="table table-bordered table-hover table-sm">
                            <thead>
                            <tr>
                                <th>№</th>
                                <th>Завод</th>
                                <th>Объект</th>
                                <th>Описание объекта</th>
                                <th>Дата</th>
                                <th>На карте</th>
                                <th>Изменить</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($colums as $colum)
                            <tr>
                                <td>{{$loop->iteration }}</td>
                                <td>{{ $colum->zavod }}</td>
                                <td><a href = '{{ $colum->file }}' target="_blank">{{ $colum->objekt }}</a></td>
                                <td>{{ $colum->opisanie }}</td>
                                <td>{{ \Carbon\Carbon::parse($colum->updated_at)->format('d.m.Y H:i') }} Создатель: {{$colum->user->firstname ?? 'удалён'}}</td>
                                <td><a href = '{{ route('operplan.'.$zavod.'.show', $colum->id) }}'>Показать на карте</a></td>
                                <td><a href = '{{ route('operplan.'.$zavod.'.edit', $colum->id) }}'>Изменить</a></td>
                            </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>№</th>
                                <th>Завод</th>
                                <th>Объект</th>
                                <th>Описание объекта</th>
                                <th>Дата</th>
                                <th>На карте</th>
                                <th>Изменить</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div> <!-- end row -->
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#datatable').DataTable();
        } );
    </script>
@endsection
