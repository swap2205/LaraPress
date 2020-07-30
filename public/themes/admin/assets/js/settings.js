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
        url: base_url+'/app/settings/',
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
