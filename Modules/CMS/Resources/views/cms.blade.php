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

    //file manager integration in summernote editor
    $(document).ready(function(){
    // File manager button (image icon)
    const FMButton = function(context) {
      const ui = $.summernote.ui;
      const button = ui.button({
        contents: '<i class="note-icon-picture"></i> ',
        tooltip: 'File Manager',
        click: function() {
          window.open('/file-manager/summernote', 'fm', 'width=1400,height=800');
        }
      });
      console.log(button);
      return button.render();
    };
    $('.sn_textarea').summernote({
      toolbar: [
        // [groupName, [list of button]]
        ['style', ['bold', 'italic', 'underline', 'clear']],
        ['font', ['strikethrough', 'superscript', 'subscript']],
        ['fontsize', ['fontsize']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['height', ['height']],
        ['fm-button', ['fm']],
        ['view', ['fullscreen', 'codeview']],
      ],
      buttons: {
        fm: FMButton
      }
    });
  });
  // set file link
  function fmSetLink(url) {
    var file_ext = url.substring(url.lastIndexOf('.')+1);
    var embed_files = ['pdf','mp4'];
    if(embed_files.indexOf(file_ext)>-1){
	    var HTMLstring = '<iframe src="'+url+'" height="200" width="300"></iframe>';
	    $('.sn_textarea').summernote('pasteHTML', HTMLstring);
	}
	else{	
    	$('.sn_textarea').summernote('insertImage', url);
    }
  }
</script>

@endsection
