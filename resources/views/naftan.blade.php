@extends('layouts.base')

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

    <script type="text/javascript" src="{{ asset('js/marker.js') }}"></script>
    <?php
/*    if (isset($_GET['vid'])) {
        echo $karta_vse->displayKartaPos('Нафтан', $_GET['pos_x'], $_GET['pos_y'], $_GET['vid']);
    }
    else{ //Если необходимо показать ОП и ПГ с разными маркерами
        echo '<script type="text/javascript" src="{{ asset('js/marker.js') }}"></script>';
    }

    */?>


@endsection
