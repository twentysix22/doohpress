<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Doohpress.com</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <link rel="shortcut icon" href="/images/favicon.ico">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- App css -->
        <link href="{{ mix('css/app.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ mix('css/theme.css') }}" rel="stylesheet" type="text/css" />


        <script src="/js/themejs/modernizr.min.js"></script>

    </head>


    <body>

        @yield('content')







        <!-- Main compiled JS !-->
        <script src="{{ mix('/js/app.js') }}"></script>


        <!-- Theme specific JS !-->

        <script src="/js/themejs/jquery.min.js"></script>

        <script src="/js/themejs/popper.min.js"></script><!-- Popper for Bootstrap -->
        <script src="/js/themejs/bootstrap.min.js"></script>

        <script src="/js/themejs/waves.js"></script>
        <script src="/js/themejs/jquery.slimscroll.js"></script>
        <script src="/js/themejs/jquery.scrollTo.min.js"></script>

        <!-- Theme App Specific js -->
        <script src="/js/themejs/jquery.core.js"></script>
        <script src="/js/themejs/jquery.app.js"></script>

        <!-- External CDN services !-->
        <script src="https://static.filestackapi.com/v3/filestack-0.9.8.js"></script>

    </body>
</html>
