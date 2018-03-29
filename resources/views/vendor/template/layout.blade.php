<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Plataforma de chatbots.">
        <meta name="author" content="Devyzi - Marcus Vinícius Campos">

        <link rel="shortcut icon" href="{{ asset('assets/images/favicon_1.ico') }}">

        <title>Anny Platform</title>

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

                    <!--<div style="min-height: 1000px;"></div>-->


                </div> <!-- container -->

            </div> <!-- content -->

            <footer class="footer text-right">
               Orkaholic ©  Copyright {{ date('Y') == '2018' ? date('Y') : '2018 - ' . date('Y') }}. Todos os direitos reservados.
            </footer>

        </div>


        <!-- ============================================================== -->
        <!-- End Right content here -->
        <!-- ============================================================== -->


        <!-- Right Sidebar -->
        @yield('right-menu')
        <!-- /Right-bar -->

    </div>
    <!-- END wrapper -->

@yield('modal')

@yield('script')

</body>
</html>