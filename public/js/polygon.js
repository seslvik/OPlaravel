function Delobj() {
    if (!$.isEmptyObject(markersobj)){
        $imgp.imgNotes2("clear", markersobj);
        $('#formobj')[0].reset();
    }
}

function Delobjposedit() {
    if (!$.isEmptyObject(markersobj)){
        $imgp.imgNotes2("clear", markersobj);
    }
    for (let i = 1; i <= 8; i++) {
        $("#pos_x_"+(i)).val('');
        $("#pos_y_"+(i)).val('');
    }
}

;(function($) {
    $(document).ready(function(){
        $.widget("wgm.imgNotes2", $.wgm.imgViewer2, {
            options: {
                delNote: function(data) {
                    let map = this.map;
                    map.removeLayer(data);
                },
                addPolygon: function(data) {
                    let map = this.map,
                        loc = [], counter  = 0;
                    for (let key in data) {
                        counter++;
                    }
                    for (let el, i = 1; i <= (counter)/2; i++) {
                        if(data['x'+i] !== '') {
                            el = this.relposToLatLng(data['x'+i], data['y'+i]);
                            loc.push(el)
                        }
                    }
                    let polygon = L.polygon(loc,{color:col}).bindPopup("</br><input type=\'button\'  value=\'Скрыть\' class=\'btn-outline-info marker-delete-button\'/>");
                    polygon.on("popupopen", function() {
                        let temp = this;
                        $(".marker-delete-button:visible").click(function () {
                            temp.remove();
                        });
                    });
                    map.addLayer(polygon);
                    markersobj.push(polygon);
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

            clear: function(notes) {
                if (this.ready) {
                    var self = this;
                    $.each(notes, function() {
                        self.options.delNote.call(self, this);
                    });
                }
            }
        });

        let col;
        markersobj = [];
        $imgp = $("#image1").imgNotes2({
            onReady: function() {
                $('.leaflet-grab').css('cursor','crosshair');
            },
            onClick: function( e, pos ) {
                let arrinput = [];
                for (let el, i = 1; i <= 8; i++) {
                    el = 'pos_x_'+i;
                    arrinput.push(el);
                }
                col = $("#color").val();
                let k = 0,
                    poly = {};
                $.each(arrinput, function (index, value) {
                    let posx = $("#pos_x_"+(index+1)),
                        posy = $("#pos_y_"+(index+1)),
                        inp = $("#"+value);
                    k++;
                    if(inp.val() === '') {
                        posx.val(pos.x.toFixed(3)).css('color', col);
                        posy.val(pos.y.toFixed(3)).css('color', col);
                        poly["x"+(index+1)] = posx.val();
                        poly["y"+(index+1)] = posy.val();
                        return false;
                    }
                    poly["x"+(index+1)] = posx.val();
                    poly["y"+(index+1)] = posy.val();
                });
                let sub = [poly];
                //console.log(poly);
                $imgp.imgNotes2("clear", markersobj);
                $imgp.imgNotes2("importobj", sub);
            }
        });
//прорисовка объекта при загрузки станицы редактирования
        let arrinput1 = [];
        for (let el, i = 1; i <= 8; i++) {
            el = 'pos_x_'+i;
            arrinput1.push(el);
        }
        col = $("#color").val();
        let poly1 = {};
        $.each(arrinput1, function (index, value) {
            if($("#"+value).val() === '') {
                return false;
            }else {
                poly1["x"+(index+1)] = $("#pos_x_"+(index+1)).val();
                poly1["y"+(index+1)] = $("#pos_y_"+(index+1)).val();
            }
        });
        let sub1 = [];
        sub1.push(poly1);
        /*console.log(poly1);*/
        $imgp.imgNotes2("importobj", sub1);

    });
})(jQuery);
