@extends('layouts.base')

@section('content')
    @php /** @var User $colums */use App\User; @endphp
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="header-title m-t-0 m-b-20">Настройки пользователей</h4>
                    @include('includes.result_messages')
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
                                    <th>Имя</th>
                                    <th>Email</th>
                                    <th>Вкл.</th>
                                    <th>Админ</th>
                                    <th>Статус</th>
                                    <th>Avatar</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($colums as $colum)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $colum->name }}</td>
                                    <td>{{ $colum->firstname }}</td>
                                    <td>{{ $colum->email }}</td>
                                    <td>
                                        <div class='custom-control custom-radio'>
                                            <input onClick='getinfo_yes({{$colum->id}});' type='radio' @if( $colum->activ >= '0' ) checked @endif  name='radio-{{ $colum->id }}' id='radio-{{ $colum->id }}0001' class='custom-control-input'>
                                            <label class='custom-control-label' for='radio-{{ $colum->id }}0001'>Вкл.</label>
                                        </div>
                                        <div class='custom-control custom-radio'>
                                            <input onClick='getinfo_no({{$colum->id}});' type='radio'  @if( $colum->activ == null ) checked @endif name='radio-{{ $colum->id }}' id='radio-{{ $colum->id }}0002' class='custom-control-input'>
                                            <label class='custom-control-label' for='radio-{{ $colum->id }}0002'>Выкл.</label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class='checkbox'>
                                            <input onClick='getinfo_admin({{$colum->id}});' type='checkbox' @if( $colum->admin == 1 ) checked @endif name='checkbox-{{ $colum->id }}' id='checkbox-{{ $colum->id }}'>
                                            <label for='checkbox-{{ $colum->id }}'></label>
                                        </div>
                                    </td>
                                    <td>
                                        @if( $colum->activ == null )
                                            <span id="activ-{{$colum->id}}" class="badge badge-pill badge-secondary text-lowercase">не активен</span>
                                        @else
                                            <span id="activ-{{$colum->id}}" class="badge badge-pill badge-success text-lowercase">активен</span>
                                        @endif

                                        @if( $colum->admin == 1 )
                                            <span id="admin-{{$colum->id}}" class="badge badge-pill badge-danger text-lowercase">admin</span>
                                        @else
                                            <span id="admin-{{$colum->id}}" class="badge badge-pill badge-danger text-lowercase" style="display: none">admin</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class='custom-control-inline custom-radio'>
                                            <input onClick='getavatar({{$colum->id}}, "1");' type='radio' @if( $colum->avatar == '1' ) checked @endif  name='radio-{{ $colum->id }}-avatar' id='radio-{{ $colum->id }}-avatar1' class='custom-control-input'>
                                            <label class='custom-control-label' for='radio-{{ $colum->id }}-avatar1'> <img src="{{ asset('img/avatar-1.jpg') }}" alt="avatar-user" class="rounded-circle" style="height: 33px"> </label>
                                        </div>
                                        <div class='custom-control-inline custom-radio'>
                                            <input onClick='getavatar({{$colum->id}}, "2");' type='radio'  @if( $colum->avatar == '2' ) checked @endif name='radio-{{ $colum->id }}-avatar' id='radio-{{ $colum->id }}-avatar2' class='custom-control-input'>
                                            <label class='custom-control-label' for='radio-{{ $colum->id }}-avatar2'> <img src="{{ asset('img/avatar-2.jpg') }}" alt="avatar-user" class="rounded-circle"  style="height: 33px"> </label>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>№</th>
                                <th>Логин</th>
                                <th>Имя</th>
                                <th>Email</th>
                                <th>Вкл.</th>
                                <th>Админ</th>
                                <th>Статус</th>
                                <th>Avatar</th>
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
