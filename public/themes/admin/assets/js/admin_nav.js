var current_tab = 'general';
var list_id = 1;


$(document).ready(()=>{
    var json = '[{"id":1},{"id":2},{"id":3,"children":[{"id":4},{"id":5,"foo":"bar"}]}]';
    var options = {'json': json}
    $('.dd').nestable({ /* config options */ });


    // Toggle plus minus icon on show hide of collapse element
    $(".collapse").on('show.bs.collapse', function(){
        $(this).prev(".card-header").find(".fa").removeClass("fa-plus").addClass("fa-minus");
    }).on('hide.bs.collapse', function(){
        $(this).prev(".card-header").find(".fa").removeClass("fa-minus").addClass("fa-plus");
    });
});

function add_nav(){
    $('#add-nav-card-title').text('Add');
    $('#nav_type').val('add');
    $('#nav_admin_frm')[0].reset();
}

function save_nav_link(item){

    if($('#nav_type').val()=='add'){
        $('#nestable-list').append(build_item(item));
    }
    else{
        $('#li_nav_link_id_'+item.id).data('nav-title',item.title);
        $('#li_nav_link_id_'+item.id).data('nav-icon',item.icon_class);
        $('#li_nav_link_id_'+item.id).data('nav-uri',item.uri);

        $('#li_nav_link_id_'+item.id+'>.dd3-content>span').html('<i class="'+item.icon_class+'"></i> '+item.title);
    }
}
function save_link_db(){
    //ajax
    const type = $('#nav_type').val()=='edit' ? $('#nav_admin_id').val() : '';

    var formData = new FormData($('#nav_admin_frm')[0]);
    // ajax adding data to database
    $.ajax({
        url: '/app/settings/admin_nav/'+type,
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function (data) {
            console.log(data);
            if (data.status) {
                save_nav_link(data.nav_data);
                add_nav();
                alert("Record Saved Successfully!!");
            }
        },
        error: function (xhr, status, error) {
            console.log(xhr);
            console.log(status);
            if (xhr.status == 422) {
                //validation error
                $.each(xhr.responseJSON.errors, function (key, value) {
                    console.log(key);
                    $('#nav_admin_frm [name="' + key + '"]')
                        .addClass("is-invalid");
                        // .next()
                    $('#crud_validate_'+key).show().text(value);
                });
            }
        },
    });
}
function save_navigation(){
    // console.log($('.dd').nestable('serialize'));
    console.log($('.dd').nestable('toArray'));
    var formData = new FormData();
    formData.append('nav_order',JSON.stringify($('.dd').nestable('toArray')));
    formData.append('_token',$('[name="_token"]').val());
    $.ajax({
        url: '/app/settings/admin_nav/update_order',
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

function edit_nav_link(id){
    $('#nav_type').val('edit');
    $('#add-nav-card-title').text('Edit');

    console.log(id);
    $('#nav_admin_id').val(id);
    $('#frm_nav_title').val($('#li_nav_link_id_'+id).data('nav-title'));
    $('#frm_nav_icon').val($('#li_nav_link_id_'+id).data('nav-icon'));
    $('#frm_nav_uri').val($('#li_nav_link_id_'+id).data('nav-uri'));
}
function build_item(data){
    console.log(data);
    var html = '';
    html += '<li id="li_nav_link_id_'+data.id+'" class="dd-item dd3-item" data-id="'+data.id+'" data-nav-title="'+data.title+'" data-nav-icon="'+data.icon_class+'" data-nav-uri="'+data.uri+'">';
    html += '<div class="dd-handle dd3-handle">Drag</div>';
    html += '<div class="dd3-content"><span><i class="'+data.icon_class+'"></i>'+data.title+'</span>';
    html += '<button type="button" class="btn btn-xs btn-primary float-right" onclick="edit_nav_link('+data.id+')"><i class="fa fa-pen"></i></button>';
    html += '</div>';
    if(data.children){
        html += '<ol class="dd-list">';
        $.each(data.children, function(index,item){
            html += build_item(item);
        });
        html += '</ol>'
    }
    html += '</li>';
    return html;
}

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
