<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Admin Users</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Admin Users</li>
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
                    <div class="card-header">
                        {{-- <h3 class="card-title">DataTable with default features</h3> --}}
                        <div class="float-right">
                            <button class="btn btn-sm btn-primary" onclick="crud_add()" id="crud_add_button"><i
                                    class="fa fa-plus"></i> Add
                                Admin User</button>
                        </div>
                    </div>
                    <div class="card-header">
                        <form action="#" method="post" class="datatableForm">
                            @csrf
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
                                        <input type="text" name="search[value]" class="form-control form-control-sm"
                                            placeholder="Enter Search Keyword">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <!-- select -->
                                    <div class="form-group">
                                        <label>Admin Type:</label>
                                        <select type="text" name="is_super" class="form-control form-control-sm">
                                            <option value="">All</option>
                                            <option value="1">Super Admin</option>
                                            <option value="0">Normal Admin</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-sm btn-info" onclick="reload_data_table();">Filter <i
                                    class="fa fa-filter"></i></button>
                        </form>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered table-striped table-sm datatable"
                            data-url="/admin/users/list">
                            <thead>
                                <tr>
                                    <th>Email</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                            <tfoot>
                                <tr>
                                    <th>Email</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
            <div class="col-12" id="crud_add_edit_form">
                <!-- Horizontal Form -->
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title"><span class="crud_card_header_label">Add</span> Admin User Form</h3>
                        <button class="btn btn-xs btn-default float-right" onclick="crud_back()"><i
                                class="fa fa-arrow-left"></i> Back</button>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form class="form-horizontal" id="add_edit_form" data-type="add" data-submit-url="/admin/users">
                        @csrf
                        <input type="hidden" name="id" value="">
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="crud_input_name" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="name" id="crud_input_name"
                                        placeholder="Admin Name">
                                    <span class="error invalid-feedback"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="crud_input_email" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" name="email" id="crud_input_email"
                                        placeholder="Email">
                                    <span class="error invalid-feedback"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="crud_input_password" class="col-sm-2 col-form-label">Password</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" name="password" id="crud_input_password"
                                        placeholder="Password">
                                    <span class="error invalid-feedback"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="offset-sm-2 col-sm-10">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="crud_checkbox_super_admin"
                                            name="is_super" value="1">
                                        <label class="form-check-label" for="crud_checkbox_super_admin">Make Super
                                            Admin</label>
                                    </div>
                                </div>
                            </div>
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

            <div class="col-md-12" id="crud_view_data" style="display:hidden;">
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
                                <tr>
                                    <th>Name</th>
                                    <td id="crud_view_name"></td>
                                </tr>
                                <tr>
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
                                </tr>
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
    $('[name="name"]').val(data.name);
    $('[name="email"]').val(data.email);
    $('[name="is_super"]').prop('checked',data.is_super);
    $('[name="password"]').parent().parent().hide();
}

    //get view data for admin users
function get_crud_view_data(data) {
    console.log(data);
    $.each(data, function (key, value) {
        // console.log(key);
        $('#crud_view_' + key).html(value);
    });
}

</script>
