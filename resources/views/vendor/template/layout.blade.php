<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Plataforma para unir clientes e prestadores de serviços.">
        <meta name="author" content="Marcus Vinícius Campos">

        <!-- <link rel="shortcut icon" href=""> -->

        <title>Cupdev - Platform</title>

        @yield('style-sheets')
    </head>


<body class="fixed-left">

    <!-- Begin page -->
    <div id="wrapper">

        <!-- Top Bar Start -->
        @yield('top-bar')
        <!-- Top Bar End -->

        <!-- ========== Left Sidebar Start ========== -->

        @yield('left-menu')
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="content-page">
            <!-- Start content -->
            <div class="content">
                <div class="container-fluid">

                    <!-- Page-Title -->
                    @yield('page-title')

                    @yield('container')
                </div> <!-- container -->
            </div> <!-- content -->
        </div>

        <!-- Right Sidebar -->
        @yield('right-menu')
        <!-- /Right-bar -->

    </div>
    <!-- END wrapper -->

@yield('modal')

<script src="{{asset('assets/js/vue/vue.min.js')}}"></script>
<script src="{{asset('assets/js/vue/plugins/vue-resource-1.5.0.min.js')}}"></script>

@yield('script')

</body>
</html>