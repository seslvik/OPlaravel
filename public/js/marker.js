$.widget("wgm.imgNotes2", $.wgm.imgViewer2, {
    options: {
        addNote: function(data) {
            let map = this.map,
                loc = this.relposToLatLng(data.x, data.y);
            let icon = L.icon(data.iconog);
            let marker = L.marker(loc,{icon: icon}).bindPopup(data.note+"</br><input type=\'button\'  value=\'Скрыть отметку\' class=\'btn-outline-info marker-delete-button\'/>");
            marker.on("popupopen", function() {
                let temp = this;
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
            let map = this.map;
            map.removeLayer(data);

        },
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
            markersobj.push(polygon);
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

let $imgf = $("#image1").imgNotes2();
let markersop = [];
let markerspg = [];
let markersobj = [];

$.ajax({
    data: {"pokaz_op": "1", "pokaz_pg": "0", "pokaz_obj": "0","zavod_objekt":"Нафтан",
            "iconUrl" : "img/marker-icon.png", "iconRetinaUrl": "img/marker-icon-2x.png", "shadowUrl": "img/marker-shadow.png"},
    type: "POST",
    url: "/marker",
    headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
    dataType:"json",
    success: function(datamap){
        let d = eval(datamap);
        notesop = [];
        for (let el, i = 0; i < d.length; i++) {
            el = eval("(" + d[i] + ")");
            notesop.push(el)
        }
        //console.log(notesop);
    },
    error: function() {
        alert('Запрос к базе данных (ОП) вернул ошибку! Или база данных пуста.');
    }
});

$.ajax({
    data: {"pokaz_op": "0", "pokaz_pg": "1", "pokaz_obj": "0","zavod_objekt":"Нафтан",
        "iconUrl" : "img/marker-icon_pg.png", "iconRetinaUrl": "img/marker-icon_pg-2x.png", "shadowUrl": "img/marker-shadow.png"},
    type: "POST",
    url: "/marker",
    headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
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
        alert('Запрос к базе данных (ПГ) вернул ошибку! Или база данных пуста.');
    }
});

$.ajax({
    data: {"pokaz_op": "0", "pokaz_pg": "0", "pokaz_obj": "1", "zavod_objekt":"Нафтан"},
    type: "POST",
    url: "/marker",
    headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
    dataType:"json",
    success: function(datamap){
        let d = eval(datamap);
        notesobj = [];
        for (let el, i = 0; i < d.length; i++) {
            el = eval("(" + d[i] + ")");
            notesobj.push(el)
        }
    },
    error: function() {
        alert('Запрос к базе данных (границ объектов) вернул ошибку! Или база данных пуста.');
    }
});


function Checkboxop() {
    if ($('#Checkbox_op').is(':checked')){
        $imgf.imgNotes2("import", notesop);
    } else {
        $imgf.imgNotes2('clear', markersop);
    }}

function Checkboxpg() {
    if ($('#Checkbox_pg').is(':checked')) {
        $imgf.imgNotes2("import", notespg);
    } else {
        $imgf.imgNotes2('clear', markerspg);
    }}

function Checkboxobj() {
    if ($('#Checkbox_obj').is(':checked')){
        $("label[for=Checkbox_obj]").text("вкл");
        $imgf.imgNotes2("importobj",notesobj);
    } else {
        $("label[for=Checkbox_obj]").text("выкл");
        $imgf.imgNotes2('clear', markersobj);
    }}
