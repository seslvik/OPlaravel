@extends('layouts.base')

@section('content')
    @php /** @var \App\Models\Operplan $$colums */ @endphp
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
                                <td>{{ \Carbon\Carbon::parse($colum->updated_at)->format('d.m.Y H:i') }} Создатель: {{$colum->user->name ?? 'удалён'}}</td>
                                <td><a href = '{{ route('operplan.'.$zavod.'.show', $colum->id) }}'>Показать на карте</a></td>
                                <td><a href = '{{ route('operplan.'.$zavod.'.edit', $colum->id) }}'>Изменить</a></td>
                                {{--<td>--}}
                                    {{--<a data-toggle="modal" data-id="{{$colum->id}}" href="#" class="user_dialog">Delete</a>--}}

                                    {{--<button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#myModal">Standard Modal</button>--}}

                                    {{--<form method="post" action="{{route('operplan.'.$zavod.'.destroy', $colum->id)}}">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-link">Удалить</button>
                                    </form>--}}
                                {{--</td>--}}
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
                                {{--<th>Удалить</th>--}}
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
        /* $(document).on('click', '.user_dialog', function() {
             let data_id = $(this).data('id');
             $.ajax({
                 url: 'data/get-details',
                 type: 'GET',
                 data: 'id='+data_id,
                 dataType: 'JSON',
                 success: function(data, textStatus, jqXHR){
                     let name = data.objekt;
                     $('.modal-body').html('<span>Modal Header ' + name + '</span>');
                     $('#myModal').modal('show');
                 },
                 error: function(jqXHR, textStatus, errorThrown){

                 },
             });
       });

         /*$(document).on("click", ".user_dialog", function () {
             var Userid = $(this).data('id');
             $(".modal-body #user_id").val( Userid );
         });*/
    </script>
@endsection
