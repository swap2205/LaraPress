<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{ Str::of($page_title)->plural()->title() }}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active">{{ Str::of($page_title)->plural()->title() }}</li>
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
                            {{-- Add button --}}
                            @if ($has_add)

                            <button class="btn btn-sm btn-primary" onclick="crud_add()" id="crud_add_button"><i
                            class="fa fa-plus"></i> Add {{ Str::of($page_title)->singular()->title() }}</button>
                            @endif
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
                            <div class="row">
                                <div class="col-sm-3">
                                    <!-- select -->
                                    <div class="form-group">
                                        <label>Search</label>
                                        <input type="search" name="search[value]" class="form-control {{-- form-control-sm --}}"
                                            placeholder="Enter Search Keyword">
                                    </div>
                                </div>
                                @section('filter_form')

                                {!! $filter_data !!}
                                @show

                            </div>
                            <button type="button" class="btn btn-sm btn-info" onclick="reload_data_table();">Filter <i
                                    class="fa fa-filter"></i></button>
                            <button type="reset" class="btn btn-sm btn-default" onclick="reset_filter();">Reset <i
                                    class="fa fa-ban"></i></button>
                        </form>
                    </div>
                </div>
                {!!get_dataTable($datatable_url,$datatable_columns)!!}
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
            @if ($has_add)


            <div class="col-12" id="crud_add_edit_form">
                <!-- Horizontal Form -->
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title"><span class="crud_card_header_label">Add</span> {{ Str::of($page_title)->singular()->title() }} Form</h3>
                        <button class="btn btn-xs btn-default float-right" onclick="crud_back()"><i
                            class="fa fa-arrow-left"></i> Back</button>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form class="form-horizontal" id="add_edit_form" data-type="add" data-submit-url="{{$form_submit_url}}">
                            @csrf
                            <input type="hidden" name="page_type" id="crud_input_page_type" value="{{$page_title}}"/>
                            <input type="hidden" name="id" value="">
                            <div class="card-body">
                                @section('add_edit_form')
                                {!! $form_fields !!}
                                @show

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
            @endif
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
@yield('cms_script')
