$.widget("wgm.imgNotes2", $.wgm.imgViewer2, {
    options: {
        addNote: function(data) {
            var map = this.map,
                loc = this.relposToLatLng(data.x, data.y);
            var icon = L.icon(data.iconog);
            var marker = L.marker(loc,{icon: icon}).bindPopup(data.note+"</br><input type=\'button\'  value=\'Скрыть отметку\' class=\'btn-outline-info marker-delete-button\'/>");
            marker.on("popupopen", function() {
                var temp = this;
                $(".marker-delete-button:visible").click(function () {
                    temp.remove();
                });
            });
            map.addLayer(marker);
            if (data.iconog.iconUrl === "img/marker-icon.png"){
                markersop.push(marker);
            }
            if (data.iconog.iconUrl === "img/marker-icon_pg.png") {
                markerspg.push(marker);
            }
        },
        delNote: function(data) {
            var map = this.map;
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
            var self = this;
            $.each(notes, function() {
                self.options.delNote.call(self, this);
            });
        }
    }

});

let $imgf = $("#image1").imgNotes2();
let markersop = [];
let markerspg = [];

$.ajax({
    data: {"pokaz_op": "1", "pokaz_pg": "0", "zavod_objekt":"Нафтан"},
    type: "POST",
    url: "ajax/marker.php",
    dataType:"json",
    success: function(datamap){
        let d = eval(datamap);
        notesop = [];
        for (let el, i = 0; i < d.length; i++) {
            el = eval("(" + d[i] + ")");
            notesop.push(el)
        }
    },
    error: function() {
        alert('Запрос к базе данных вернул ошибку!');
    }
});

$.ajax({
    data: {"pokaz_op": "0", "pokaz_pg": "1", "zavod_objekt":"Нафтан"},
    type: "POST",
    url: "ajax/marker.php",
    dataType:"json",
    success: function(datamap){
        let d = eval(datamap);
        notespg = [];
        for (let el, i = 0; i < d.length; i++) {
            el = eval("(" + d[i] + ")");
            notespg.push(el)
        }
    },
    error: function() {
        alert('Запрос к базе данных вернул ошибку!');
    }
});

function Checkboxop() {
    if ($('#Checkbox_op').is(':checked')){
        $imgf.imgNotes2("import", notesop);
    } else {
        $imgf.imgNotes2('clear', markersop);
    }
}

function Checkboxpg() {
    if ($('#Checkbox_pg').is(':checked')) {
        $imgf.imgNotes2("import", notespg);
    } else {
        $imgf.imgNotes2('clear', markerspg);
    }
}
