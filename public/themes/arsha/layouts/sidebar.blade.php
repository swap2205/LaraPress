<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    {!! meta_init() !!}
    <meta name="keywords" content="@get('keywords')">
    <meta name="description" content="@get('description')">
    <meta name="author" content="@get('author')">

    <title>@get('title')</title>


    <!-- Favicons -->
    <link href="{!! Theme::asset()->url('img/favicon.png') !!}" rel="icon">
    <link href="{!! Theme::asset()->url('img/apple-touch-icon.png') !!}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    @styles()

</head>

<body>
    @partial('header')

    <main id="main">
        @if (!Theme::get('IsHome',false))
        @partial('breadcrumbs')
        @endif
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-10">
                    @content()
                </div>
                <div class="col-md-2">
                    <section class="card">
                        <div class="card-header">
                            <h3>Latest Post</h3>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><a href="#">Cras justo odio</a> </li>
                                <li class="list-group-item"><a href="#">Cras justo odio</a> </li>
                                <li class="list-group-item"><a href="#">Cras justo odio</a> </li>
                                <li class="list-group-item"><a href="#">Cras justo odio</a> </li>
                                <li class="list-group-item">Dapibus ac facilisis in</li>
                                <li class="list-group-item">Vestibulum at eros</li>
                            </ul>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </main><!-- End #main -->

    @partial('footer')

    @scripts()
</body>

</html>
