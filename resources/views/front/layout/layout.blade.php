<!DOCTYPE html>
<html class="no-js" lang="en-US">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>NutriBites</title>
    <link href="favicon.ico" rel="shortcut icon">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('front/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('front/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ url('front/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ url('front/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ url('front/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ url('front/css/jquery-ui-range-slider.min.css') }}">
    <link rel="stylesheet" href="{{ url('front/css/utility.css') }}">
    <link rel="stylesheet" href="{{ url('front/css/bundle.css') }}">
    <link rel="stylesheet" href="{{ url('front/css/easyzoom.css') }}">
    <link rel="stylesheet" href="{{ url('front/css/custom.css') }}">
</head>

<body>
    <div class="loader">
        <img src="{{ asset('front/images/loaders/loader.gif') }}" alt="loading..." />
    </div>
    <div id="app">
        @include('front.layout.header')
        @yield('content')
        @include('front.layout.footer')
        @include('front.layout.modals')
    </div>
    <noscript>
        <div class="app-issue">
            <div class="vertical-center">
                <div class="text-center">
                    <h1>JavaScript is disabled in your browser.</h1>
                    <span>Please enable JavaScript in your browser or upgrade to a JavaScript-capable browser.</span>
                </div>
            </div>
        </div>
        <style>
            #app {
                display: none;
            }
        </style>
    </noscript>
    <script type="text/javascript" src="{{ url('front/js/vendor/modernizr-custom.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('front/js/nprogress.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('front/js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('front/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('front/js/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('front/js/jquery.scrollUp.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('front/js/jquery.elevatezoom.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('front/js/jquery-ui.range-slider.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('front/js/jquery.slimscroll.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('front/js/jquery.resize-select.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('front/js/jquery.custom-megamenu.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('front/js/jquery.custom-countdown.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('front/js/owl.carousel.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('front/js/app.js') }}"></script>
    <script type="text/javascript" src="{{ url('front/js/custom.js') }}"></script>
    <script type="text/javascript" src="{{ url('front/js/easyzoom.js') }}"></script>
    <script>
        var $easyzoom = $('.easyzoom').easyZoom();
        var api1 = $easyzoom.filter('.easyzoom--with-thumbnails').data('easyZoom');

        $('.thumbnails').on('click', 'a', function(e) {
            var $this = $(this);

            e.preventDefault();

            api1.swap($this.data('standard'), $this.attr('href'));
        });

        var api2 = $easyzoom.filter('.easyzoom--with-toggle').data('easyZoom');

        $('.toggle').on('click', function() {
            var $this = $(this);

            if ($this.data("active") === true) {
                $this.text("Switch on").data("active", false);
                api2.teardown();
            } else {
                $this.text("Switch off").data("active", true);
                api2._init();
            }
        });
    </script>
    @include('front.layout.scripts')
</body>

</html>