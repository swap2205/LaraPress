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
                toastr.success('Settings saved successfully')
            }
        },
        error: function (xhr, status, error) {
            console.log(xhr);
            console.log(status);
            if (xhr.status == 422) {
                //validation error
                $.each(xhr.responseJSON.errors, function (key, value) {
                    console.log(key);
                });
                toastr.error(xhr.responseJSON.message)
            }
            else{
                toastr.error("Please try again after sometime!!","Oops!! Error occurred");
            }
        },
    });

}

$(document).ready(function() {
    $('.activate-theme-btn').click(function() {
        var formData = new FormData();
        var btn = $(this);
        formData.append('key[app_theme]',btn.data('theme-id'));
        formData.append('type','options');
        formData.append('_token',$('[name="_token"]').val());

        btn.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Activating');
        btn.attr('disabled',true);

        $.ajax({
            url: base_url+'/app/settings',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function (data) {
                console.log(data);
                if (data.status) {
                    toastr.success(btn.data('theme-id')+' has been activated successfully')
                    $('.theme-btn').attr('disabled',false).text('Activate').removeClass('btn-success btn-primary').addClass('btn-primary');
                    btn.attr('disabled',true).text('Active Theme').removeClass('btn-success').addClass('btn-success');
                }
            },
            error: function (xhr, status, error) {
                btn.attr('disabled',false);
                btn.text('Activate');
                console.log(xhr);
                console.log(status);
                if (xhr.status == 422) {
                    //validation error
                    $.each(xhr.responseJSON.errors, function (key, value) {
                        console.log(key);

                    });
                    toastr.error(xhr.responseJSON.message);
                }
                else{
                    toastr.error("Please try again after sometime!!","Oops!! Error occurred");
                }
            },
        });
    });
})
