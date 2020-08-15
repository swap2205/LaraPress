<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{ Str::of($page_type)->plural()->title() }}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active">{{ Str::of($page_type)->plural()->title() }}</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12" id="crud_list_table">
                <div class="card">
                    <div class="card-header" data-card-widget="collapse">
                        <h3 class="card-title">Filters</h3>

                        <div class="card-tools">
                            <button class="btn btn-sm btn-primary" onclick="crud_add()" id="crud_add_button"><i
                            class="fa fa-plus"></i> Add {{ Str::of($page_type)->singular()->title() }}</button>
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                              <i class="fas fa-minus"></i>
                            </button>
                          </div>

                        <div class="float-right">
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="#" method="post" class="datatableForm">
                            @csrf
                            <input type="hidden" name="page_type" value="{{$page_type}}">
                            <div class="row">
                                {{-- <div class="col-sm-2">
                                  <!-- select -->
                                  <div class="form-group">
                                    <label>Show Entries:</label>
                                    <select class="form-control form-control-sm" name="length" onchange="crud_change_datatable_length()">
                                      <option value="2">2</option>
                                      <option value="10">10</option>
                                      <option value="20">20</option>
                                      <option value="30">30</option>
                                      <option value="50">50</option>
                                      <option value="100">100</option>
                                      <option value="200">200</option>
                                    </select>
                                  </div>
                                </div> --}}
                                <div class="col-sm-3">
                                    <!-- select -->
                                    <div class="form-group">
                                        <label>Search:</label>
                                        <input type="search" name="search[value]" class="form-control form-control-sm"
                                            placeholder="Enter Search Keyword">
                                    </div>
                                </div>
                                {{-- <div class="col-sm-3">
                                    <!-- select -->
                                    <div class="form-group">
                                        <label>Admin Type:</label>
                                        <select type="text" name="is_super" class="form-control form-control-sm">
                                            <option value="">All</option>
                                            <option value="1">Super Admin</option>
                                            <option value="0">Normal Admin</option>
                                        </select>
                                    </div>
                                </div> --}}
                            </div>
                            <button type="button" class="btn btn-sm btn-info" onclick="reload_data_table();">Filter <i
                                    class="fa fa-filter"></i></button>
                            <button type="reset" class="btn btn-sm btn-default" onclick="reload_data_table();">Reset <i
                                    class="fa fa-ban"></i></button>
                        </form>
                    </div>
                </div>
                {!!get_dataTable('/admin/cms/list',$datatable_columns)!!}
                {{-- <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered table-striped table-sm datatable"
                            data-url="/admin/cms/list">
                            <thead>
                                <tr>
                                @foreach ($datatable_columns as $item)
                                    <th>{{$item}}</th>
                                @endforeach
                                </tr>
                            </thead>
                            <tbody></tbody>
                            <tfoot>
                                <tr>
                                @foreach ($datatable_columns as $item)
                                    <th>{{$item}}</th>
                                @endforeach
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div> --}}
                <!-- /.card -->
            </div>
            <!-- /.col -->
            <div class="col-12" id="crud_add_edit_form">
                <!-- Horizontal Form -->
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title"><span class="crud_card_header_label">Add</span> {{ Str::of($page_type)->singular()->title() }} Form</h3>
                        <button class="btn btn-xs btn-default float-right" onclick="crud_back()"><i
                            class="fa fa-arrow-left"></i> Back</button>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form class="form-horizontal" id="add_edit_form" data-type="add" data-submit-url="/admin/cms">
                            @csrf
                            <input type="hidden" name="page_type" id="crud_input_page_type" value="{{$page_type}}"/>
                            <input type="hidden" name="id" value="">
                            <div class="card-body">
                            {!! $form_fields !!}

                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <div class="float-right">
                                <button type="button" onclick="crud_save()" class="btn btn-info">Save</button>
                                <button type="reset" class="btn btn-default">Clear</button>
                            </div>
                        </div>
                        <!-- /.card-footer -->
                    </form>
                </div>

            </div>

            <div class="col-md-12" id="crud_view_data">
                <div class="card card-info">
                    <div class="card-header">
                        {{-- <h3 class="card-title">Bordered Table</h3> --}}
                        <button class="btn btn-xs btn-default float-right" onclick="crud_back()"><i
                                class="fa fa-arrow-left"></i> Back</button>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tbody>
                            @foreach ($view_fields as $vk=>$view_item)
                            <tr>
                                <th>{{$view_item}}</th>
                                <td id="crud_view_{{$vk}}"></td>
                            </tr>
                            @endforeach
                            {{--     <tr>
                                    <th>Email</th>
                                    <td id="crud_view_email"></td>
                                </tr>
                                <tr>
                                    <th>Is Super Admin</th>
                                    <td id="crud_view_is_super"></td>
                                </tr>
                                <tr>
                                    <th>Created At</th>
                                    <td id="crud_view_created_at"></td>
                                </tr> --}}
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->
<script>
    $(document).ready(function(){
        $('#crud_add_button').on('click',function(){
            $('[name="password"]').parent().parent().show();
        });
    });

    //get edit form data for admin users
function get_crud_edit_form_data(data) {
    console.log(data);
    // $('[name="name"]').val(data.name);
    // $('[name="email"]').val(data.email);
    // $('[name="is_super"]').prop('checked',data.is_super);
    // $('[name="password"]').parent().parent().hide();


}

    //get view data for admin users
function get_crud_view_data(data) {
    console.log(data);
}
</script>
