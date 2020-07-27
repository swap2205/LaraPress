var current_tab = 'general';
function set_current_tab(id) {
    current_tab = id;
}


function save_settings() {
    console.log(current_tab);
    var formData = new FormData($('#'+current_tab+'_settings_form')[0]);
    // var formData = new FormData($(current_tab+'_settings_form')[0]);
    // ajax adding data to database
    $.ajax({
        url: '/app/settings/',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function (data) {
            console.log(data);
            if (data.status) {
                alert("Record Saved Successfully!!");
                crud_back();
                reload_data_table();
            }
        },
        error: function (xhr, status, error) {
            console.log(xhr);
            console.log(status);
            if (xhr.status == 422) {
                //validation error
                $.each(xhr.responseJSON.errors, function (key, value) {
                    console.log(key);
                    $('#add_edit_form [name="' + key + '"]')
                        .addClass("is-invalid");
                        // .next()
                    $('#crud_validate_'+key).show().text(value);
                });
            }
        },
    });

}
function crud_view(id) {
    // display view data in simple table format
    console.log(id);
    var submit_url = $("#add_edit_form").data("submit-url");
    submit_url += "/view/" + id;
    // ajax adding data to database
    $.ajax({
        url: submit_url,
        type: "GET",
        // data: formData,
        // contentType: false,
        // processData: false,
        dataType: "JSON",
        success: function (data) {
            console.log(data);
            $.each(data, function (key, value) {
                // console.log(key);
                $('#crud_view_' + key).html(value);
            });
            show_view_container("crud_view_data");
            if (typeof get_crud_view_data === "function") {
                get_crud_view_data(data);
            }
            else{
                console.error("Method Not Found: get_crud_edit_form_data, does not exists in view file");
            }
        },
        error: function (xhr, status, error) {
            console.log(xhr);
        },
    });
}

function crud_save() {
    // console.log(id);
    reset_validations();
    console.log($("#add_edit_form").data("submit-url"));
    console.log($("#add_edit_form").data("type"));
    console.log($('#add_edit_form [name="id"]').val());
    var submit_url = $("#add_edit_form").data("submit-url");
    var method_type = "POST";
    if ($("#add_edit_form").data("type") == "edit") {
        submit_url += "/" + $('#add_edit_form [name="id"]').val();
        // method_type = "PUT";
    }
    var formData = new FormData($("#add_edit_form")[0]);
    // ajax adding data to database
    $.ajax({
        url: submit_url,
        type: method_type,
        data: formData,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function (data) {
            console.log(data);
            if (data.status) {
                alert("Record Inserted Successfully!!");
                crud_back();
                reload_data_table();
            }
        },
        error: function (xhr, status, error) {
            console.log(xhr);
            console.log(status);
            if (xhr.status == 422) {
                //validation error
                $.each(xhr.responseJSON.errors, function (key, value) {
                    console.log(key);
                    $('#add_edit_form [name="' + key + '"]')
                        .addClass("is-invalid");
                        // .next()
                    $('#crud_validate_'+key).show().text(value);
                });
            }
        },
    });
}
