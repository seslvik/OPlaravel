@extends('layouts.base')

@section('checkbox')
    <li class="notification-list">
        <div class="checkbox custom-switch form-check-inline">
            <input type="checkbox" class="custom-control-input" id="Checkbox_obj" onchange="Checkboxobj()" title="Показать грааницы объектов">
            <label class="custom-control-label" for="Checkbox_obj" title="Показать грааницы объектов">выкл</label>
        </div>
        <div class="checkbox checkbox-info form-check-inline mt-4">
            <input type="checkbox" id="Checkbox_op" value="0" onchange="Checkboxop()" title="Показать объекты с оперативными планами пожаротушения">
            <label class="Checkbox_l" for="Checkbox_op" title="Показать объекты с оперативными планами пожаротушения"><b> ОП </b></label>
        </div>
        <div class="checkbox checkbox-warning form-check-inline">
            <input type="checkbox" id="Checkbox_pg" value="0" onchange="Checkboxpg()" title="Показать пожарные гидранты">
            <label class="Checkbox_l" for="Checkbox_pg" title="Показать пожарные гидранты"><b> ПГ </b></label>
        </div>
    </li>
@endsection

@section('content')
    <table  border="0" style="width: 100%; min-width: 320px;">
        <tr>
            <td style="padding: 3px">
                <div align="center">
                    <img  id="image1" src="{{ asset('img/sputnik/Нафтан100.jpg') }}" width="100%" alt=""/>
                </div>
            </td>
        </tr>
    </table>


    <script src="{{ asset('js/marker.js') }}"></script>
@endsection

