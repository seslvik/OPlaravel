function getinfo_yes (id) {
    $.ajax({
        data: {"id_user": id, "value": "0"},
        type: "POST",
        url: "/user-up-down",
        headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
        dataType:"html",
        success: function (data) {
            alert(data);
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
            $('#checkbox-'+id).prop('checked', false);
            alert(data);
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
                $('#radio-'+id+'0001').prop('checked', true);
                $('#radio-'+id+'0002').prop('checked', false);
                alert(data);
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
                alert(data);
            }
        });
    }
}
