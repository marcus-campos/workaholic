@section('script')

    <script src="{{asset('assets/js/vue/vue.min.js')}}"></script>
    <script src="{{asset('assets/js/vue/plugins/vue-resource-1.5.0.min.js')}}"></script>

    <script>
        var resizefunc = [];
    </script>

    <!-- jQuery  -->
    <script src="{{asset('assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('plugins/moment/moment.js')}}"></script>
    <script src="{{asset('assets/js/popper.min.js')}}"></script><!-- Popper for Bootstrap -->
    <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/js/detect.js')}}"></script>
    <script src="{{asset('assets/js/fastclick.js')}}"></script>
    <script src="{{asset('assets/js/jquery.slimscroll.js')}}"></script>
    <script src="{{asset('assets/js/jquery.blockUI.js')}}"></script>
    <script src="{{asset('assets/js/waves.js')}}"></script>
    <script src="{{asset('assets/js/wow.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.nicescroll.js')}}"></script>
    <script src="{{asset('assets/js/jquery.scrollTo.min.js')}}"></script>


    <script src="{{asset('assets/js/jquery.app.js')}}"></script>
    <script src="{{asset('assets/js/jquery.core.js')}}"></script>

    @yield('section-js')

    @yield('component-js')
@endsection