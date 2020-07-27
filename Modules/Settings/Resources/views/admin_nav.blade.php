<style>
    /**
         * Nestable Draggable Handles
         */

    .dd3-content {
        display: block;
        height: 30px;
        line-height: 28px;
        margin: 5px 0;
        padding: 0px 10px 5px 40px;
        color: #333;
        text-decoration: none;
        font-weight: bold;
        border: 1px solid #ccc;
        background: #fafafa;
        background: -webkit-linear-gradient(top, #fafafa 0%, #eee 100%);
        background: -moz-linear-gradient(top, #fafafa 0%, #eee 100%);
        background: linear-gradient(top, #fafafa 0%, #eee 100%);
        -webkit-border-radius: 3px;
        border-radius: 3px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
    }

    .dd3-content:hover {
        color: #2ea8e5;
        background: #fff;
    }

    .dd-dragel>.dd3-item>.dd3-content {
        margin: 0;
    }

    .dd3-item>button {
        margin-left: 30px;
    }

    .dd3-handle {
        position: absolute;
        margin: 0;
        left: 0;
        top: 0;
        cursor: pointer;
        width: 30px;
        text-indent: 30px;
        white-space: nowrap;
        overflow: hidden;
        border: 1px solid #aaa;
        background: #ddd;
        background: -webkit-linear-gradient(top, #ddd 0%, #bbb 100%);
        background: -moz-linear-gradient(top, #ddd 0%, #bbb 100%);
        background: linear-gradient(top, #ddd 0%, #bbb 100%);
        border-top-right-radius: 0;
        border-bottom-right-radius: 0;
    }

    .dd3-handle:before {
        content: '≡';
        display: block;
        position: absolute;
        left: 0;
        top: 3px;
        width: 100%;
        text-align: center;
        text-indent: 0;
        color: #fff;
        font-size: 20px;
        font-weight: normal;
    }

    .dd3-handle:hover {
        background: #ddd;
    }
</style>
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Admin Navigation</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
                    <li class="breadcrumb-item active">Admin Navigation</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <div class="card">
                    {{-- <div class="card-header">
                        <h3 class="card-title">Admin Navigation - Order</h3>
                        <button class="btn btn-primary btn-sm float-right" type="button" onclick="save_navigation()">Save Order</button>
                    </div> --}}
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card card-info">
                                    <div class="card-header">
                                        <h3 class="card-title"> Navigation Order</h3>
                                        <button class="btn btn-default btn-xs float-right" onclick="add_nav()">Add New</button>
                                    </div>
                                    <div class="card-body">
                                <div class="dd" id="nestable3">
                                    <ol class="dd-list" id="nestable-list">
                                        @foreach ($navs as $item)
                                        <li id="li_nav_link_id_{{$item['id']}}" class="dd-item dd3-item" data-id="{{$item['id']}}" data-nav-title="{{$item['title']}}" data-nav-icon="{{$item['icon_class']}}" data-nav-uri="{{$item['uri']}}" >
                                            <div class="dd-handle dd3-handle">Drag</div>
                                            <div class="dd3-content"><span><i class="{{$item['icon_class']}}"></i> {{$item['title']}}</span>
                                                <button type="button" class="btn btn-xs btn-primary float-right" onclick="edit_nav_link({{$item['id']}})"><i class="fa fa-pen"></i></button>
                                            </div>
                                            @isset($item['children'])
                                            <ol class="dd-list">
                                                @foreach ($item['children'] as $child)
                                                <li id="li_nav_link_id_{{$child['id']}}" class="dd-item dd3-item" data-id="{{$child['id']}}" data-nav-title="{{$child['title']}}" data-nav-icon="{{$child['icon_class']}}" data-nav-uri="{{$child['uri']}}" >
                                                    <div class="dd-handle dd3-handle">Drag</div>
                                                    <div class="dd3-content"><span><i class="{{$child['icon_class']}}"></i> {{$child['title']}}</span>
                                                        <button type="button" class="btn btn-xs btn-primary float-right" onclick="edit_nav_link({{$child['id']}})"><i class="fa fa-pen"></i></button>
                                                    </div>
                                                </li>
                                                @endforeach
                                            </ol>
                                            @endisset
                                        </li>
                                        @endforeach
                                        {{-- <li class="dd-item dd3-item" data-id="13" data-nav-title="Test123" data-nav-icon="fa-pencil">
                                            <div class="dd-handle dd3-handle">Drag</div>
                                            <div class="dd3-content">Item 13
                                                <button type="button" class="btn btn-xs btn-primary float-right"><i class="fa fa-pen"></i></button>
                                            </div>
                                        </li>
                                        <li class="dd-item dd3-item" data-id="14">
                                            <div class="dd-handle dd3-handle">Drag</div>
                                            <div class="dd3-content">Item 14</div>
                                        </li>
                                        <li class="dd-item dd3-item" data-id="15">
                                            <div class="dd-handle dd3-handle">Drag</div>
                                            <div class="dd3-content">Item 15</div>
                                            <ol class="dd-list">
                                                <li class="dd-item dd3-item" data-id="16">
                                                    <div class="dd-handle dd3-handle">Drag</div>
                                                    <div class="dd3-content">Item 16</div>
                                                </li>
                                                <li class="dd-item dd3-item" data-id="17">
                                                    <div class="dd-handle dd3-handle">Drag</div>
                                                    <div class="dd3-content">Item 17</div>
                                                </li>
                                                <li class="dd-item dd3-item" data-id="18">
                                                    <div class="dd-handle dd3-handle">Drag</div>
                                                    <div class="dd3-content">Item 18</div>
                                                </li> --}}
                                            </ol>
                                        </li>
                                    </ol>
                                </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="float-right">
                                            <button class="btn btn-primary btn-sm float-right" type="button" onclick="save_navigation()">Save Order</button>
                                        </div>
                                    </div>
                            </div>
                            </div>
                            <div class="col-md-6">
                                <!-- Horizontal Form -->
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title"><span id="add-nav-card-title">Add</span> a Navigation</h3>
                        {{-- <button class="btn btn-default btn-sm float-right" onclick="add_nav()">Add New</button> --}}
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <input type="hidden" name="type" id="nav_type" value="add">
                    <form class="form-horizontal" action="#" id="nav_admin_frm">
                        @csrf
                        <input type="hidden" name="id" value="" id="nav_admin_id">
                        <div class="card-body">
                            {{-- <div class="row">
                                <div class="col-sm-6"> --}}
                                    <div class="form-group row">
                                        <label for="frm_nav_title" class="col-sm-3 col-form-label">Title</label>
                                        <div class="col-sm-9">
                                            <input type="text" maxlength="100" class="form-control" id="frm_nav_title"
                                                placeholder="Enter Title" name="title">
                                        </div>
                                    </div>
                                {{-- </div> --}}
                                {{-- <div class="col-sm-6"> --}}
                                    <div class="form-group row">
                                        <label for="frm_nav_uri" class="col-sm-3 col-form-label">URI</label>
                                        <div class="col-sm-9">
                                            <input type="text" maxlength="100" class="form-control" id="frm_nav_uri"
                                                placeholder="Enter URI" name="uri">
                                        </div>
                                    </div>
                                {{-- </div> --}}
                                {{-- <div class="col-sm-6"> --}}
                                    <div class="form-group row">
                                        <label for="frm_nav_icon" class="col-sm-3 col-form-label">Icon Class</label>
                                        <div class="col-sm-9">
                                            <input type="text" maxlength="100" class="form-control" id="frm_nav_icon"
                                                placeholder="Enter ICON Class" name="icon_class">
                                        </div>
                                    </div>
                                {{-- </div> --}}
                                {{-- <div class="col-sm-6">
                                    <div class="form-group row">
                                        <label for="frm_nav_parent_id" class="col-sm-2 col-form-label">Parent</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" name="parent_id" id="frm_nav_parent_id">
                                                <option value="0">No Parent</option>
                                                <option>option 2</option>
                                                <option>option 3</option>
                                                <option>option 4</option>
                                                <option>option 5</option>
                                              </select>
                                        </div>
                                    </div>

                                </div> --}}
                                {{-- <div class="col-sm-6"> --}}
                                    <div class="form-group row">
                                        <label for="exampleCheck2" class="col-sm-3 col-form-label">Status</label>
                                        <div class="col-sm-9">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="exampleCheck2"
                                                    name="nav_status" value="1">
                                                <label class="form-check-label" for="exampleCheck2">Enabled</label>
                                            </div>
                                        </div>
                                    {{-- </div>
                                </div> --}}
                            </div>


                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <div class="float-right">
                                <button type="reset" class="btn btn-default btn-sm" onclick="add_nav()">Clear</button>
                                <button type="button" class="btn btn-info btn-sm btn_add_link" onclick="save_link_db()">Save</button>
                            </div>
                        </div>
                        <!-- /.card-footer -->
                    </form>
                </div>
                <!-- /.card -->
                            </div>
                        </div>
                    </div>
                    <div class="card-footer"></div>
                </div>

            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        <!-- END CUSTOM TABS -->
    </div>
</section>
