<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>App Settings</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
                    <li class="breadcrumb-item active">App Settings</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- Custom Tabs -->
                <div class="card card-primary card-outline card-tabs">
                    <div class="card-header p-0 pt-1 border-bottom-0">
                        {{-- <h3 class="card-title p-3">Settings</h3> --}}
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab"
                                    onclick="set_current_tab('general')">General</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab"
                                    onclick="set_current_tab('options')">Options</a></li>
                            <li class="nav-item"><a class="nav-link" href="#tab_3" data-toggle="tab"
                                    onclick="set_current_tab('email')">Email</a></li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">
                                    Actions <span class="caret"></span>
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" tabindex="-1" href="javascript:void(0)"
                                        onclick="save_settings()">Save</a>
                                    {{-- <a class="dropdown-item" tabindex="-1" href="#">Another action</a>
                      <a class="dropdown-item" tabindex="-1" href="#">Something else here</a> --}}
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" tabindex="-1" href="#">Reset Form</a>
                                </div>
                            </li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_1">
                                <form role="form" class="form-horizontal" method="POST" action="#"
                                    id="general_settings_form">
                                    @csrf
                                    <input type="hidden" name="type" value="general">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <!-- text input -->
                                            <div class="form-group">
                                                <label><i class="far fa-bell"></i> Application Name</label>
                                                <input type="text" class="form-control"
                                                    placeholder="Enter Application Name" name="key[app_name]"
                                                    value="{{ $settings_data['app_name'] ?? '' }}">
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <!-- textarea -->
                                            <div class="form-group">
                                                <label><i class="far fa-bell"></i> Application Description</label>
                                                <textarea class="form-control" rows="1"
                                                    placeholder="Enter Application Description"
                                                    name="key[app_description]">{{ $settings_data['app_description'] ?? '' }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input"
                                                        id="shortcode_id" name="key[app_shortcode]" value="1"
                                                        {{ isset($settings_data['app_shortcode']) && $settings_data['app_shortcode'] ? 'checked':'' }}>
                                                    <label class="custom-control-label" for="shortcode_id">Toggle this
                                                        switch to enable/disable Shortcode Feature</label>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- <div class="col-sm-6">

                                            <!-- checkbox -->
                                            <div class="form-group row">
                                                <div class="form-check col-sm-4">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="checkbox"> Enable
                                                        Shortcode</label>
                                                </div>


                                                <div class="form-check  col-sm-4">
                                                    <input class="form-check-input" type="checkbox" checked>
                                                    <label class="form-check-label">Checkbox checked</label>
                                                </div>
                                            </div>
                                        </div> --}}



                                        <div class="col-sm-6">
                                            <!-- radio -->
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <label for="">Maintenance Mode</label>
                                                </div>
                                                <div class="form-check col-sm-2">
                                                    <input class="form-check-input" type="radio" value="1"
                                                        name="key[maintennance_mode]"
                                                        {{ isset($settings_data['maintennance_mode']) && $settings_data['maintennance_mode'] ? 'checked':'' }}>
                                                    <label class="form-check-label">On</label>
                                                </div>
                                                {{-- </div> --}}
                                                {{-- <div class="col-sm-3"> --}}
                                                <div class="form-check col-sm-2">
                                                    <input class="form-check-input" type="radio" value="0"
                                                        name="key[maintennance_mode]"
                                                        {{ isset($settings_data['maintennance_mode']) && !$settings_data['maintennance_mode'] ? 'checked':'' }}>
                                                    <label class="form-check-label">Off</label>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- <div class="col-sm-6">
                                            <!-- select -->
                                            <div class="form-group">
                                                <label>Select</label>
                                                <select class="form-control">
                                                    <option>option 1</option>
                                                    <option>option 2</option>
                                                    <option>option 3</option>
                                                    <option>option 4</option>
                                                    <option>option 5</option>
                                                </select>
                                            </div>
                                        </div> --}}
                                    </div>
                                </form>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="tab_2">
                                <form role="form" class="form-horizontal" method="POST" action="#"
                                    id="options_settings_form">
                                    @csrf
                                    <input type="hidden" name="type" value="options">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <!-- select -->
                                            <?php $settings_data['app_theme'] = $settings_data['app_theme'] ?? 'default'; ?>
                                            <div class="form-group">
                                                <label>Frontend Theme</label>
                                                <select class="form-control" name="key[app_theme]">
                                                    @foreach ($themes as $k=>$theme)
                                                    <option value="{{$k}}"
                                                        {{ ($settings_data['app_theme']==$k) ? 'selected':'' }}>
                                                        {{$theme}}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="tab_3" id="email_settings_form">
                                Email Content
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                    <div class="card-footer">
                        <button type="button" class="btn btn-info" onclick="save_settings()">Save</button>
                        <button type="reset" class="btn btn-default">Reset</button>
                    </div>
                </div>
                <!-- ./card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        <!-- END CUSTOM TABS -->
    </div>
</section>
