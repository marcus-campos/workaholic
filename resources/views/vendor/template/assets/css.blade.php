@section('style-sheets')

    <!--Morris Chart CSS -->
    <link rel="stylesheet" href="{{ asset('plugins/morris/morris.css') }}">

    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/icons.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url(mix('css/app.css'))}}" rel="stylesheet" type="text/css" />

    <script src="{{asset('assets/js/modernizr.min.js')}}"></script>

    @yield('component-css')

    @yield('section-css')

    @yield('partial-css')
@endsection