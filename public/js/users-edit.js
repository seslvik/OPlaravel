function getinfo_yes (id) {
    $.ajax({
        data: {"id_user": id, "value": "0"},
        type: "POST",
        url: "/user-up-down",
        headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
        dataType:"html",
        success: function (data) {
            let activ = $('#activ-'+id);
            activ.text('активен');
            activ.removeClass('badge badge-pill badge-secondary text-lowercase');
            activ.addClass('badge badge-pill badge-success text-lowercase');
           // alert(data);
        }
    });
    }

function getinfo_no (id) {
    $.ajax({
        data: {"id_user": id, "value": null},
        type: "POST",
        url: "/user-up-down",
        headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
        dataType:"html",
        success: function (data) {
           /* $('#checkbox-'+id).prop('checked', false);*/
            let activ = $('#activ-'+id);
            activ.text('не активен');
            activ.removeClass('badge badge-pill badge-success text-lowercase');
            activ.addClass('badge badge-pill badge-secondary text-lowercase');
            //alert(data);
        }
    });
}

function getinfo_admin (id) {

    if ($('#checkbox-'+id).is(':checked')){
        $.ajax({
            data: {"id_admin": id, "value": "1"},
            type: "POST",
            url: "/user-admin-up-down",
            headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
            dataType:"html",
            success: function (data) {
                let admin = $('#admin-'+id);
                admin.show();
               // console.log('da');
                /*$('#radio-'+id+'0001').prop('checked', true);
                $('#radio-'+id+'0002').prop('checked', false);*/
                //alert(data);
            }
        });
    } else {
        $.ajax({
            data: {"id_admin": id, "value": "0"},
            type: "POST",
            url: "/user-admin-up-down",
            headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
            dataType:"html",
            success: function (data) {
                let admin = $('#admin-'+id);
                admin.hide();
               // console.log('net');
               // alert(data);
            }
        });
    }
}

function getavatar (id, value) {
    $.ajax({
        data: {"id_avatar": id, "value": value},
        type: "POST",
        url: "/user-avatar",
        headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
        dataType:"html",
        success: function (data) {
            if (data === "no"){
                alert(data);
            }
        }
    });
}
