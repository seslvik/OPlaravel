@extends('layouts.base')

@section('content')
    @php /** @var \App\Models\Gidrant $$colums */ @endphp
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="header-title m-t-0 m-b-20">Пожарные гидранты на территории {{$gde}}</h4>
                </div>
            </div>

            <div class="row">
                <div class="col-12">

                    @include('includes.result_messages')
                    {{--include('includes.modal_form')--}}

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
                                {{--<th>Удалить</th>--}}
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($colums as $colum)
                            <tr>
                                <td>{{$loop->iteration }}</td>
                                <td>{{ $colum->zavod }}</td>
                                <td><a href = '{{ $colum->file }}' target="_blank">{{ $colum->objekt }}</a></td>
                                <td>{{ $colum->opisanie }}</td>
                                <td>{{ \Carbon\Carbon::parse($colum->created_at)->format('d.m.Y H:i') }} Создатель: {{$colum->user->name}}</td>
                                <td><a href = '{{ route('gidrant.'.$zavod.'.show', $colum->id) }}'>Показать на карте</a></td>
                                <td><a href = '{{ route('gidrant.'.$zavod.'.edit', $colum->id) }}'>Изменить</a></td>
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
            // Default Datatable
            $('#datatable').DataTable();
        } );

    </script>
@endsection
