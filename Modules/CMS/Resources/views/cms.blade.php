@extends('laracrud::index')

{{-- [optional] On page - Filter form content  --}}
@section('filter_form')
    @parent

@endsection

{{-- [optional] On page - Add Edit form content  --}}
@section('add_edit_form')
    @parent

@endsection

{{-- [optional] On page - Scripts section  --}}
@section('cms_script')
<script>
    $(document).ready(function(){
        // add extra code here
    });

    // add form manipulation for the add_edit form
    function get_crud_add_form_data(data) {
        $('#crud_validate_featured_image').next().remove('img');
    }

    // edit form manipulation for the add_edit form
    function get_crud_edit_form_data(data) {
        console.log(data);
        $('#crud_validate_featured_image').next().remove('img');
        if(data.featured_image){
            $('#crud_validate_featured_image').after("<img src='"+data.featured_image+"' class='img-thumbnail'>")
        }

        if(typeof $('.sn_textarea').summernote==='function'){
            $('.sn_textarea').summernote('code',data.content);
        }

    }

    //get view data for admin users
    function get_crud_view_data(data) {
        console.log(data);
        if(data.file_exists){
            $('#crud_view_featured_image').html("<img src='"+data.featured_image+"' class='img-thumbnail'>");
        }
    }
</script>

@endsection
