@extends('layouts.base')

@section('content')
    @php /** @var \App\Models\Gidrant $colums */ @endphp
    @php /** @var \App\Models\Gidrant $zavodlink */ @endphp

    <div class="row pr-3 pl-3 pt-3">
        <div class="col-lg-6">
            <div>
                <img alt="{{$zavod}}"  id="image1" src="{{asset('img/sputnik/'.$zavod.'100.jpg')}}" width="100%" style="border: 10px solid #555; padding:10px;" />
            </div>
        </div>
        <div class="col-lg-6">
            @include('includes.result_messages')
            <h4 class="text-center">Добавление пожарного гидранта</h4>
            <form  action="{{ route('gidrant.'.$zavodlink.'.store')}}" method="POST" id="formobj" enctype="multipart/form-data" onkeydown="if(event.keyCode==13) {return false;}">
                @csrf
                <div class="row pr-3 pl-3 pt-3">
                    <div class="col-lg-12 form-group">
                        @if($zavod === 'Нафтан')
                            <label for="zavod">Расположение: <b>ОАО "Нафтан"</b></label>
                        @else
                            <label for="zavod">Расположение: <b>завод "Полимир" ОАО "Нафтан"</b></label>
                        @endif
                    </div>
                    <div class="col-lg-12 form-group">
                        <label for="objekt">Название объекта</label>
                        <input type="text" name="objekt" class="form-control" id="objekt" value="{{old('objekt')}}" required>
                    </div>
                    <div class="col-lg-12 form-group">
                        <label for="opisanie">Описание объекта</label>
                        <textarea name="opisanie" class="form-control" id="opisanie" required>{{old('opisanie')}}</textarea>

                    </div>
                    <div class="col-lg-12 input-group ">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="inputFile" name="inputFile" aria-describedby="inputGroupFileAddon" required>
                            <label class="custom-file-label" for="inputFile">Выбери файл с пожарным гидрантом</label>
                        </div>
                    </div>
                    <script>
                        $(document).ready(function () {
                            bsCustomFileInput.init()
                        })
                    </script>
                </div>
                <div class="row pr-3 pl-3 pt-3">
                    <div class="col-lg-12">
                        <p>Укажите на карте место расположения объекта и его координаты автоматически запишутся в соответствующие поля.
                            Для изменения координат, необходимо повторно указать место на карте.</p>
                    </div>
                    <div class="col-lg-3 form-group mb-0">
                        <label for="pos_x">Координата Х</label>
                        <input type="number" step="0.001" min="0" max="1" name="pos_x" class="form-control" id="pos_x" value="{{old('pos_x')}}" required>
                    </div>
                    <div class="col-lg-3 form-group mb-0">
                        <label for="pos_y">Координата Y</label>
                        <input type="number" step="0.001" min="0" max="1" name="pos_y" class="form-control" id="pos_y" value="{{old('pos_y')}}" required>
                    </div>
                    <div class="col-lg-3 text-center" style="padding-top: 30px">
                        <button  type="submit"  class="btn btn-info">Сохранить</button>
                    </div>
                    <div class="col-lg-3 text-center" style="padding-top: 30px">
                        <a class="btn btn-outline-info" href="{{ route('home') }}" role="button"> Отмена </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="{{ asset('js/marker-add.js') }}"></script>
@endsection
