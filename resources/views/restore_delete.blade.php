@extends('layouts.base')

@section('content')

@include('includes.result_messages')

        <div class="row">
            <div class="wrapper-page">
                    <div class="card-box">
                        <div class="col-12 text-center">
                            <h3 class="text-uppercase m-t-0 m-b-30">
                                <strong class="text-danger">Удаление объекта!</strong>
                            </h3>
                        </div>
                        <div class="container ">
                            <div class="col-12  m-b-20 text-center">
                                <h5>Вы действительно хотите удалить этот <b>{{$vid_objekta}}</b>?</h5>
                            </div>
                            <div class="col-12">
                                <label>Расположение: <b>{{ $colums->zavod}}</b></label>
                            </div>
                            <div class="col-12">
                                <label>Название: <b>{{ $colums->objekt}}</b></label>
                            </div>
                            <div class="col-12">
                                <label>Описание: <b>{{ $colums->opisanie}}</b></label>
                            </div>

                                <form method="post" action="{{route($objekt.'.softdestroy', $colums->id)}}">
                                    @method('DELETE')
                                    @csrf
                                    <div class="col-12 ">
                                        <button type="submit" class="btn-block  btn-lg btn-danger">ДА</button>
                                        <a class="btn btn-lg btn-success btn-block" href=" {{route('restore.index')}}" role="button"> {{ __('НЕТ') }} </a>
                                    </div>
                                </form>
                                {{--<a class="btn btn-lg btn-danger btn-block" href="" role="button"> {{ __('ДА') }} </a>--}}



                        </div>
                    </div>
            </div>
        </div>
        <div class="clearfix"></div>
@endsection
