@extends('template-login')
@extends('vendor.auth.header.meta')
@extends('vendor.auth.header.title-fav')
@extends('vendor.auth.css-js.css')
@extends('vendor.auth.css-js.js')

@section('content')
	<div class=" card-box">
		<div class="panel-heading">
			<h3 class="text-center"> Registrar em <strong class="text-custom">{{ env('APP_NAME')  }}</strong> </h3>
		</div>

		<div id="app" class="panel-body">
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
			<form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/register') }}">
				{!! csrf_field() !!}

				<div class="form-group ">
					<div class="col-xs-12">
						<input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Nome">
					</div>
				</div>

				<div class="form-group ">
					<div class="col-xs-12">
						<input type="text" class="form-control" name="cpf" value="{{ old('cpf') }}" placeholder="CPF">
					</div>
				</div>

				<div class="form-group ">
					<div class="col-xs-12">
						<input type="text" class="form-control" id="cep" name="cep" value="{{ old('cep') }}" placeholder="CEP" maxlength="8">
					</div>
				</div>

                <div class="form-group ">
                    <div class="col-xs-12">
                        <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}" placeholder="Logradouro" disabled>
                    </div>
                </div>

                <div class="form-group ">
                    <div class="col-xs-12">
                        <input type="text" class="form-control" id="number" name="number" value="{{ old('number') }}" placeholder="Número">
                    </div>
                </div>

                <div class="form-group ">
                    <div class="col-xs-12">
                        <input type="text" class="form-control" id="complement" name="complement" value="{{ old('complement') }}" placeholder="Complemento">
                    </div>
                </div>

                <div class="form-group ">
                    <div class="col-xs-12">
                        <input type="text" class="form-control" id="neighborhood" name="neighborhood" value="{{ old('neighborhood') }}" placeholder="Bairro" disabled>
                    </div>
                </div>

				<div class="form-group ">
					<div class="col-xs-12">
						@include('components.cities')
					</div>
				</div>

                <div class="form-group ">
                    <div class="col-xs-12">
                        <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}" placeholder="Telefone">
                    </div>
                </div>

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

				<div class="form-group">
					<div class="col-xs-12">
						<input type="password" class="form-control" name="password_confirmation" placeholder="Confirmar senha">
					</div>
				</div>

				<div class="form-group text-center m-t-40">
					<div class="col-xs-12">
						<button class="btn btn-default btn-block text-uppercase waves-effect waves-light" type="submit">
							Registrar
						</button>
					</div>
				</div>

			</form>

		</div>
	</div>

	<div class="row">
		<div class="col-sm-12 text-center">
			<p>
				Já possui uma conta?<a href="{{ url('/auth/login')}}" class="text-primary m-l-5"><b>Entrar</b></a>
			</p>
		</div>
	</div>
@endsection

@section('section-js')
	<script>
        $(function() {
            $('#cep').change(function (event) {
                var cep = $('#cep').val();
                if(cep.length === 8) {
                    setTimeout(function () {
                        getCepData(cep, function (data) {
                            $('#address').val(data.logradouro);
                            $("#address").removeAttr('disabled');
                            $('#city').val(data.localidade).trigger('change');
                            $('#city').removeAttr('disabled');
                            $('#neighborhood').val(data.bairro);
                            $("#neighborhood").removeAttr('disabled');
                        });
                    }, 0);
                }
            });

            function getCepData(cep, callback) {
                const url = 'https://viacep.com.br/ws/' + cep + '/json/';
                $.post(url, function (result)  {
					callback(result);
                });
            }

            $('#city').attr('disabled', 'disabled');
        });
	</script>
@endsection
