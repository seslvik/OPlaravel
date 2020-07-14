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
                addNote: function(data) {
                    let map = this.map,
                        loc = this.relposToLatLng(data.x, data.y);
                    let icon = L.icon({!! $icon_map !!});
                    console.log(data.note);
                    let marker = L.marker(loc, {icon: icon}).addTo(map).bindPopup(data.note+"</br><input type=\'button\'  value=\'Скрыть отметку\' class=\'btn-outline-info marker-delete-button\'/>");
                    marker.on("popupopen", function() {
                        let temp = this;
                        $(".marker-delete-button:visible").click(function () {
                            temp.remove();
                        });
                    });
                }
            },
            import: function(notes) {
                if (this.ready) {
                    let self = this;
                    $.each(notes, function() {
                        self.options.addNote.call(self, this);
                    });
                }
            }
        });
        $(document).ready( function() {
            let $img = $("#image1").imgNotes2({
                onReady: function() {
                    let notes = [ {!! $datamap_pg !!} ];
                    this.import(notes);
                }
            });
        });
    })(jQuery);
</script>';
@endsection


