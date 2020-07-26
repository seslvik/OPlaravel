@extends('layouts.base')

@section('content')
    @php /** @var \App\Models\Polygon $colums */ @endphp
    @php /** @var \App\Models\Polygon $zavodlink */ @endphp
    <div class="row pr-3 pl-3 pt-3">
        <div class="col-lg-6">
            <div>
                <img alt="{{$zavod}}"  id="image1" src="{{asset('img/sputnik/'.$zavod.'100.jpg')}}" width="100%" style="border: 10px solid #555; padding:10px;" />
            </div>
        </div>
        <div class="col-lg-6">
            @include('includes.result_messages')
            <h4 class="text-center">Добавление границ объекта</h4>
            <form  action="{{ route('polygon.'.$zavodlink.'.store')}}" method="POST" id="formobj" onkeydown="if(event.keyCode==13) {return false;}">
                @csrf
                <div class="row pr-3 pl-3 pt-3">
                    <div class="col-lg-12 form-group">
                        @if($zavod === 'Нафтан')
                            <label for="zavod">Расположение: <b>ОАО "Нафтан"</b></label>
                        @else
                            <label for="zavod">Расположение: <b>завод "Полимир" ОАО "Нафтан"</b></label>
                        @endif
                    </div>
                    <div class="col-lg-10 form-group">
                        <label for="opisanie">Описание объекта</label>
                        <textarea name="opisanie" class="form-control" id="opisanie" required>{{old('opisanie')}}</textarea>
                    </div>
                    <div class="col-lg-2 form-group">
                        <label for="color">Цвет</label>
                        <input type="color" name="color" class="form-control" id="color" value="{{old('color')}}"/>
                    </div>
                </div>
                <div class="row pr-3 pl-3 pt-0">
                    <div class="col-lg-12">
                        <p>По указанным ниже координатам будет построен многоугольник. Максимальное число точек для построения равно 8. </p>
                    </div>
                    @for ($i = 1; $i <= 8; $i++)
                    <div class="col-lg-3 form-group mb-0">
                        <label for="pos_x_{{$i}}">Координата {{$i}} Х</label>
                        <input type="number" step="0.001" min="0" max="1" name="pos_x_{{$i}}" class="form-control" id="pos_x_{{$i}}" placeholder="x.xxx" >
                    </div>
                    <div class="col-lg-3 form-group mb-0">
                        <label for="pos_y_{{$i}}">Координата {{$i}} Y</label>
                        <input type="number" step="0.001" min="0" max="1" name="pos_y_{{$i}}" class="form-control" id="pos_y_{{$i}}" placeholder="x.xxx">
                    </div>
                   @endfor
                    <div class="col-lg-3 text-center" style="padding-top: 30px">
                        <button  type="submit"  class="btn btn-info">Сохранить</button>
                    </div>
                    <div class="col-lg-3 text-center" style="padding-top: 30px">
                        <button type="button" name="del_obj" class="btn btn-warning" onclick="Delobj()">Очистить</button>
                    </div>
                    <div class="col-lg-3 text-center" style="padding-top: 30px">
                        <a class="btn btn-outline-info" href="{{ route('home') }}" role="button"> Отмена </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="{{ asset('js/polygon.js') }}"></script>
@endsection

