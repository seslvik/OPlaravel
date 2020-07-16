@extends('layouts.base')

@section('content')
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="header-title m-t-0 m-b-20">Настройки пользователей</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table id="datatable" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>№</th>
                                    <th>Логин</th>
                                    <th>Email</th>
                                    <th>Вкл.</th>
                                    <th>Админ</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($colums as $colum)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $colum->name }}</td>
                                    <td>{{ $colum->email }}</td>
                                    <td>
                                        <div class='custom-control custom-radio'>
                                            <input onClick='getinfo_yes({{$colum->id}});' type='radio' @if( $colum->admin >= 0 ) checked @endempty  name='radio-{{ $colum->id }}' id='radio-{{ $colum->id }}0001' class='custom-control-input'>
                                            <label class='custom-control-label' for='radio-{{ $colum->id }}0001'>Вкл.</label>
                                        </div>
                                        <div class='custom-control custom-radio'>
                                            <input onClick='getinfo_no({{$colum->id}});' type='radio'  @if( $colum->admin == null ) checked @endempty name='radio-{{ $colum->id }}' id='radio-{{ $colum->id }}0002' class='custom-control-input'>
                                            <label class='custom-control-label' for='radio-{{ $colum->id }}0002'>Выкл.</label>
                                        </div>
                                    </td>
                                    <td><div class='checkbox'><input onClick='getinfo_admin({{$colum->id}});' type='checkbox' @if( $colum->admin == 1 ) checked @endempty name='checkbox-{{ $colum->id }}' id='checkbox-{{ $colum->id }}'><label for='checkbox-{{ $colum->id }}'></label></div></td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>№</th>
                                <th>Логин</th>
                                <th>Email</th>
                                <th>Вкл.</th>
                                <th>Админ</th>
                            </tr>
                            </tfoot>
                        </table>
                        <script>
                            $(document).ready(function() {
                                $('#datatable').DataTable();
                            } );
                        </script>
                    </div>
                </div>
            </div> <!-- end row -->
        </div>
    </div>

<script src="{{ asset('js/users-edit.js') }}"></script>
@endsection

    {{--<script type="text/javascript">
                function getinfo_yes (id) {
                    $.ajax({
                        data: {"id_yes": id},
                        type: "POST",
                        url: "shablon/getinfo_yes.php",
                        dataType:"html",
                        success: function () {
                            alert('Пользователь активен!');
                        }
                    });
                }

                function getinfo_no (id) {
                    $.ajax({
                        data: {"id_no": id},
                        type: "POST",
                        url: "shablon/getinfo_no.php",
                        dataType:"html",
                        success: function () {
                            $('#checkbox-'+id).prop('checked', false);
                            alert('Пользователь отключен!');
                        }
                    });
                }

                function getinfo_admin (id) {
                    if ($('#checkbox-'+id).is(':checked')){
                        $.ajax({
                            data: {"id_admin": id, "value": "on"},
                            type: "POST",
                            url: "shablon/getinfo_admin.php",
                            dataType:"html",
                            success: function () {
                                $('#radio-'+id+'0001').prop('checked', true);
                                $('#radio-'+id+'0002').prop('checked', false);
                                alert('Права администратора включены!');
                            }
                        });
                    } else {
                        $.ajax({
                            data: {"id_admin": id, "value": "off"},
                            type: "POST",
                            url: "shablon/getinfo_admin.php",
                            dataType:"html",
                            success: function () {
                                alert('Права администратора отключены!');
                            }
                        });
                    }
                }
            </script>--}}








