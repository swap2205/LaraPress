<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{!! Theme::asset()->url('img/favicon.ico') !!}" rel="icon">
    <title>@get('title')</title>
    @styles()
    <script src="@asset('plugins/jquery/jquery.min.js')"></script>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        @partial('navbar')
        @partial('aside')
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            @content()
        </div>
        <!-- /.content-wrapper -->

        @partial('footer')
        @partial('control-sidebar')
    </div>
    <!-- ./wrapper -->
    <div class="loading"><div class="spinner"></div></div>
    @scripts()
</body>

</html>
