$(document).ready(function(){
    $(document).on('click','.page-link',function(e){
        e.preventDefault();
        console.log($(this)[0].tagName);
        if($(this)[0].tagName=='A'){
            let slug = $(this).attr('href').split('page=');
            console.log(slug);
            getPagination($(this).attr('href'));
        }
    })
});

function getPagination(url){
    $.ajax({
        url: url,
        type: 'GET',
        // data: formData,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function (data) {
            console.log(data);
            $('#pagination-links').html(data.paging);
            $('#page-content').html(data.data);
        },
        error: function (xhr, status, error) {
            console.log(xhr);
            console.log(status);
        },
    });
}