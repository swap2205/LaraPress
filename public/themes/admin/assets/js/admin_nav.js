var current_tab = 'general';
var list_id = 1;


$(document).ready(()=>{
    $('.dd').nestable({ "maxDepth" : 2 });


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
    $('.is-invalid').removeClass('is-invalid');
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
    const type = $('#nav_type').val()=='edit' ? '/'+$('#nav_admin_id').val() : '';

    var formData = new FormData($('#nav_admin_frm')[0]);
    // ajax adding data to database
    $.ajax({
        url: base_url+'/app/settings/admin_nav'+type,
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
                toastr.success('Data has been saved successfully')
            }
        },
        error: function (xhr, status, error) {
            console.log(xhr);
            console.log(status);
            if (xhr.status == 422) {
                //validation error
                toastr.error(xhr.responseJSON.message);
                $.each(xhr.responseJSON.errors, function (key, value) {
                    console.log(key);
                    $('#nav_admin_frm [name="' + key + '"]')
                        .addClass("is-invalid");
                        // .next()
                    $('#crud_validate_'+key).show().text(value);
                });
            }
            else{
                toastr.error("Please try again after sometime!!","Oops!! Error occurred");
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
                toastr.success("Admin Navigation sequence has been saved");
            }
        },
        error: function (xhr, status, error) {
            console.log(xhr);
            console.log(status);
            if (xhr.status == 422) {
                //validation error
                toastr.error(xhr.responseJSON.message);
                $.each(xhr.responseJSON.errors, function (key, value) {
                    console.log(key);
                    $('#add_edit_form [name="' + key + '"]')
                        .addClass("is-invalid");
                        // .next()
                    $('#crud_validate_'+key).show().text(value);
                });

            }
            else{
                toastr.error("Please try again after sometime!!","Oops!! Error occurred");
            }
        },
    });



}

function edit_nav_link(id){
    $('#nav_type').val('edit');
    $('#add-nav-card-title').text('Edit');
    $('.is-invalid').removeClass('is-invalid');
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

