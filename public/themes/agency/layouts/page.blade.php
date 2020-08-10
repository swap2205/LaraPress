<!DOCTYPE html>
<html lang="en">

    <head>
        {!! meta_init() !!}
        <meta charset="utf-8" />
        <meta name="keywords" content="@get('keywords')">
        <meta name="description" content="@get('description')">
        <meta name="author" content="@get('author')">
        <link rel="icon" type="image/x-icon" href="@asset('img/favicon.ico')" />
        <title>@get('title')</title>
        <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
        @styles()

    </head>

    <body id="page-top">
        @partial('header')
                    <!-- Masthead-->
                    <header class="masthead"
                    @if (Theme::get('featured_image',null))
                    style="background: url({{ Storage::url(Theme::get('featured_image')) }})"
                    @endif
                    >
                        <div class="container">
                            <div class="masthead-subheading">Welcome To Our Studio!</div>
                            <div class="masthead-heading text-uppercase">It's Nice To Meet You</div>
                            <a class="btn btn-primary btn-xl text-uppercase js-scroll-trigger" href="#services">Tell Me More</a>
                        </div>
                    </header>
        <section class="page-section bg-light" id="portfolio">
            @content()
        </section>
        @partial('footer')

        <!-- Bootstrap core JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
        <!-- Third party plugin JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
        @scripts()

    </body>

</html>
