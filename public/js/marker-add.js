;(function($) {
    $(document).ready(function(){
        $.widget("wgm.imgNotes2", $.wgm.imgViewer2, {
            options: {
                addNote: function(data) {
                    let map = this.map,
                        loc = this.relposToLatLng(data.x, data.y);
                    let marker = L.marker(loc).bindPopup(data.note+"</br><input type=\'button\'  value=\'Скрыть отметку\' class=\'btn-outline-info marker-delete-button\'/>");
                    marker.on("popupopen", function() {
                        let temp = this;
                        $(".marker-delete-button:visible").click(function () {
                            temp.remove();
                        });
                    });
                    map.addLayer(marker);
                    markers.push(marker);
                },
                delNote: function(data) {
                    let map = this.map;
                    map.removeLayer(data);

                }
            },

            import: function(notes) {

                if (this.ready) {
                    var self = this;
                    $.each(notes, function() {
                        self.options.addNote.call(self, this);
                    });
                }
            },

            clear: function(notes) {
                if (this.ready) {
                    let self = this;
                    $.each(notes, function() {
                        self.options.delNote.call(self, this);
                    });
                }
            }
        });

        markers = [];
        $imgp = $("#image1").imgNotes2({
            onReady: function() {
                $('.leaflet-grab').css('cursor','crosshair');
            },
            onClick: function( e, pos ) {
                let poly = {},
                    posx = $("#pos_x"),
                    posy = $("#pos_y"),
                    note = $("#objekt").val();
                posx.val(pos.x.toFixed(3));
                posy.val(pos.y.toFixed(3));
                poly["x"] = posx.val();
                poly["y"] = posy.val();
                poly["note"] = note;
                let sub = [poly];
                /*console.log(poly);*/
                $imgp.imgNotes2("clear", markers);
                $imgp.imgNotes2("import", sub);
            }
        });
    });
})(jQuery);
