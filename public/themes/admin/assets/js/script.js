var dataTable_url = $(".datatable").data("url");
var datatable;
show_view_container("crud_list_table");
console.log(dataTable_url);

document.addEventListener(
    "DOMContentLoaded",
    function () {
        //alert("Ready!");
        datatable = $(".datatable").DataTable({
            "dom": '<"top"i>rt<"bottom"flp><"clear">',
            paging: true,
            ordering: true,
            info: true,
            // lengthChange: false, //disable default length option
            searching: false, //disable default search option
            autoWidth: false,
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: {
                url: dataTable_url,
                dataType: "json",
                type: "POST",
                data: function (d) {
                    $.each($(".datatableForm").serializeArray(), function (key,val) {
                        d[val.name] = val.value;
                    });
                },
            },
            order: [],
            //disable ordering on last column
            columnDefs: [{ orderable: false, targets: -1 }],
        });

        $( document ).ajaxSend(function() {
            $('.loading').show();
        });

        $( document ).ajaxComplete(function() {
            $('.loading').hide();
        });
    },
    false
);

    /* function crud_change_datatable_length(){
    datatable.page.len( $('[name="length"]').val() ).draw();
} */

function crud_add() {
    // load add form
    reset_validations();
    $("#add_edit_form")[0].reset(); // reset the form
    if(typeof $('.sn_textarea').summernote==='function'){
        $('.sn_textarea').summernote('reset');
    }
    show_view_container("crud_add_edit_form");

    if (typeof get_crud_add_form_data === "function") {
        get_crud_add_form_data(data);
    }

    $("#add_edit_form").data("type", "add");
    $('#crud_card_header_label').html('Add');
}

function crud_edit(id) {
    reset_validations();
    $("#add_edit_form")[0].reset(); // reset the form
    if(typeof $('.sn_textarea').summernote==='function'){
        $('.sn_textarea').summernote('reset');
    }
    $("#add_edit_form").data("type", "edit");
    $('#crud_card_header_label').html('Edit');
    console.log(id);
    $('#add_edit_form [name="id"]').val(id);
    // load edit form

    var submit_url = $("#add_edit_form").data("submit-url");
    submit_url += "/" + id;
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
                try {
                    $('#add_edit_form [name="' + key+'"]').val(value);
                } catch (error) {
                    console.log(error);
                }
            });
            show_view_container("crud_add_edit_form");
            if (typeof get_crud_edit_form_data === "function") {
                get_crud_edit_form_data(data);
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

function crud_delete(id) {
    console.log(id);
}

function crud_back() {
    show_view_container("crud_list_table");
}
// toggle view - show / hide
function show_view_container(view_container_id) {
    $("#crud_add_edit_form").hide();
    $("#crud_list_table").hide();
    $("#crud_view_data").hide();
    $("#" + view_container_id).show();
}

//reset validation text and class
function reset_validations() {
    //console.log(typeof $('.sn_textarea').summernote);
    $(".invalid-feedback").hide().html("");
    $(".is-invalid").removeClass("is-invalid");
}

//reload datatable
function reload_data_table() {
    datatable.ajax.reload(null, false);
}

function reset_filter(){
    setTimeout(function() {
        // executes after the form has been reset
        reload_data_table();
      }, 1);
}

//collapse with icon

$(document).ready(()=>{
    $("#filter_form").on("hide.bs.collapse", function(){
        $("#card-tools-btn").html('<i class="fas fa-plus"></i>');
      });
      $("#filter_form").on("show.bs.collapse", function(){
        $("#card-tools-btn").html('<i class="fas fa-minus"></i>');
      });
})
