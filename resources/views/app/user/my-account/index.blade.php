@extends('template')

@section('container')
    <div class="row">
        <div class="col-12">
            <ul class="nav nav-tabs tabs" style="width: 100%;">
                <li class="tab" style="width: 25%;">
                    <a href="#my-account" data-toggle="tab" aria-expanded="false">
                        Dados
                    </a>
                </li>
                <li class="tab" style="width: 25%;">
                    <a href="#pass-through" data-toggle="tab" aria-expanded="false" class="">
                        Endereço
                    </a>
                </li>
                <div class="indicator" style="right: 450.375px; left: 0px;"></div></ul>
            <div class="tab-content">
                <div class="tab-pane active" id="my-account" style="">
                    @include('app.user.my-account.fragments.data')
                </div>
                <div class="tab-pane" id="pass-through" style="display: none;">
                    @include('app.user.my-account.fragments.address')
                </div>
            </div>
        </div><!-- end col -->
    </div>
@endsection

@section('section-css')
    <link href="{{ asset('plugins/sweet-alert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('section-js')
    <script>
        const _csrf_token = '{{ csrf_token() }}';
        const _userId = '{{ auth()->id() }}';
    </script>
    <script src="{{ asset('plugins/sweet-alert2/sweetalert2.min.js') }}"></script>
    <script src="{{ url(mix('js/user-my-account.js')) }}" type="text/javascript"></script>
@endsection