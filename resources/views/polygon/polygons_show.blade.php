@extends('layouts.base')

@section('content')
<table  border="0" style="width: 100%; min-width: 320px;">
    <tr>
        <td style="padding: 3px">
            <div align="center">
                <img  id="image1" src="{{ asset('img/sputnik/'.$zavodlink.'100.jpg') }}" width="100%" alt=""/>
            </div>
        </td>
    </tr>
</table>
<script type="text/javascript">
    ;(function($) {
        $.widget("wgm.imgNotes2", $.wgm.imgViewer2, {
            options: {
                 addPolygon: function(data) {
                    let map = this.map,
                        loc = [], counter  = 0;
                    for (let key in data) {
                        counter++;
                    }
                    for (let el, i = 1; i <= (counter-1)/2; i++) {
                        if(data['x'+i] !== '') {
                            el = this.relposToLatLng(data['x'+i], data['y'+i]);
                            loc.push(el)
                        }
                    }
                    let polygon = L.polygon(loc,{color:data.color}).bindPopup(data.note+"</br><input type=\'button\'  value=\'Скрыть\' class=\'btn-outline-info marker-delete-button\'/>");
                    polygon.on("popupopen", function() {
                        let temp = this;
                        $(".marker-delete-button:visible").click(function () {
                            temp.remove();
                        });
                    });
                    map.addLayer(polygon);
                 }
            },
            importobj: function(notes) {
                if (this.ready) {
                    var self = this;
                    $.each(notes, function() {
                        self.options.addPolygon.call(self, this);
                    });
                }
            },
        });
        $(document).ready( function() {
            let $img = $("#image1").imgNotes2({
                onReady: function() {
                    let notes = [ {!! $datamap_pol !!} ];
                    this.importobj(notes);
                }
            });
        });
    })(jQuery);
</script>';

@endsection
