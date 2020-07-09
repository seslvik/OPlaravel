@extends('layouts.base')

@section('content')
    @php /** @var \App\Models\Operplan $$colums */ @endphp
    <h4>Здесь будет страница редактирования для оперплана id={{$colums->id}}.</h4>
    <h4>Объект => {{$colums->zavod}}.</h4>
    <h4>Описание => {{$colums->opisanie}}.</h4>
    <h4>Координаты => {{$colums->pos_x}}<-->{{$colums->pos_y}}</h4>

@endsection
