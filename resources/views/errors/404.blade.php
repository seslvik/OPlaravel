@extends('errors::minimal')

@section('title', __('Страница не найдена.'))
@section('code', '404')
@section('message', __($exception->getMessage() ?: 'Страница не найдена.')
