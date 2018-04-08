@extends('template-login')
@extends('vendor.auth.header.meta')
@extends('vendor.auth.header.title-fav')
@extends('vendor.auth.css-js.css')
@extends('vendor.auth.css-js.js')

@section('content')

    <div class=" card-box">
        <div class="panel-heading">
            <h3 class="text-center"> Recuperar sua senha </h3>
        </div>

        <div class="panel-body">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            @if (isset($errors) && count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Opa!</strong> Encontramos alguns erros.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form role="form" method="POST" action="{{ url('/password/email') }}">
                {!! csrf_field() !!}
                <div class="alert alert-info alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                        ×
                    </button>
                    Digite seu <b>Email</b> e enviaremos instruções para você!
                </div>
                <div class="form-group m-b-0">
                    <div class="input-group">
                        <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-pink w-sm waves-effect waves-light">
                                Resetar
                            </button>
                        </span>
                    </div>
                </div>

            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 text-center">
            <p>Lembrou de sua senha? <a href="{{ url('/auth/login')}}" class="text-primary m-l-5"><b>Entrar</b></a></p>
        </div>
    </div>

@endsection

@section('section-css')

@endsection

@section('section-js')

@endsection
