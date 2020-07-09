@extends('layouts.base')

@section('content')
    @php /** @var \App\Models\Operplan $$colums */ @endphp
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="header-title m-t-0 m-b-20">Оперативные планы пожаротушения</h4>
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
                                <th>Удалить</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($colums as $colum)
                            <tr>
                                <td>{{$loop->iteration }}</td>
                                <td>{{ $colum->zavod }}</td>
                                <td><a href = '{{ $colum->file }}'>{{ $colum->objekt }}</a></td>
                                <td>{{ $colum->opisanie }}</td>
                                <td>{{ \Carbon\Carbon::parse($colum->created_at)->format('d.M.Y H:i') }}</td>
                                <td><a href = '{{ route('operplan.'.$zavod.'.show', $colum->id) }}'>Показать на карте</a></td>
                                <td><a href = '{{ route('operplan.'.$zavod.'.edit', $colum->id) }}'>Изменить</a></td>
                                <td>
                                    <form method="post" action="{{route('operplan.'.$zavod.'.destroy', $colum->id)}}">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-link">Удалить</button>
                                    </form>
                                </td>
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
                                <th>Удалить</th>
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
