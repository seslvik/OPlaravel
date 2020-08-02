@extends('errors::minimal')

@section('title', __('Доступ запрещён'))
@section('code', '403')
@section('message', __($exception->getMessage() ?: 'Доступ запрещён'))
