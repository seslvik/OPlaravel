@extends('layouts.base')

@section('content')

    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="header-title m-t-0 m-b-20">Оперативные планы пожаротушения</h4>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table id="datatable" class="table table-bordered">
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
                                <td><a href = '{{ $colum->file }}'>{{ $colum->objekt }}</a></td>
                                <td>{{ $colum->opisanie }}</td>
                                <td>{{ $colum->created_at }}</td>
                                <td><a href = ''>Показать на карте</a></td>
                                <td><a href = ''>Изменить</a></td>
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
