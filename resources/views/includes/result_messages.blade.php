@if($errors->any())
    <div class="alert alert-icon alert-danger alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert"
                aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        @foreach($errors->all() as $errorTxt)
            <i class="mdi mdi-block-helper"></i>
            <strong>Ошибка!</strong> {{$errorTxt}}
            <br>
        @endforeach
    </div>
@endif
@if(session('success'))
    <div class="alert alert-icon alert-success alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert"
                aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <i class="mdi mdi-check-all"></i>
        <strong>Выполнено!</strong> {{session()->get('success')}}
    </div>
@endif
