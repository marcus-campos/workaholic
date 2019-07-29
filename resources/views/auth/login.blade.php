@extends('template-login')
@extends('vendor.auth.header.meta')
@extends('vendor.auth.header.title-fav')
@extends('vendor.auth.css-js.css')
@extends('vendor.auth.css-js.js')

@section('content')

	<div class=" card-box">
		<div class="panel-heading">
			<h3 class="text-center"> Entrar em <strong class="text-custom">{{ env('APP_NAME')  }}</strong> </h3>
		</div>


		<div class="panel-body">
			@if (Session::has('error'))
				<div class="alert alert-info">
					<strong>Ooops.</strong><br><br>
					<ul>
						@foreach (Session::get('error') as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			@endif
			@if (isset($errors) && count($errors) > 0)
				<div class="alert alert-danger">
					<strong>Ooops!</strong> Encontramos alguns erros.<br><br>
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			@endif
			<form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/login') }}">
				{!! csrf_field() !!}

				<div class="form-group ">
					<div class="col-xs-12">
						<input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email">
					</div>
				</div>

				<div class="form-group">
					<div class="col-xs-12">
						<input type="password" class="form-control" name="password" placeholder="Senha">
					</div>
				</div>

				<div class="form-group text-center m-t-40">
					<div class="col-xs-12">
						<button class="btn btn-default btn-block text-uppercase waves-effect waves-light" type="submit">Entrar</button>
					</div>
				</div>

				<div class="form-group m-t-30 m-b-0">
					<div class="col-sm-12">
						<a href="{{ url('/password/reset')}}" class="text-dark"><i class="fa fa-lock m-r-5"></i> Esqueceu sua senha?</a>
					</div>
				</div>
			</form>

		</div>
	</div>
	<div class="row">
		<div class="col-sm-12 text-center">
			<p>Ainda não é cadastrado? <a href="{{ url('/auth/register')}}" class="text-primary m-l-5"><b>Cadastrar-se</b></a></p>
		</div>
	</div>
@endsection

@section('extra-css')

@endsection

@section('extra-js')

@endsection
