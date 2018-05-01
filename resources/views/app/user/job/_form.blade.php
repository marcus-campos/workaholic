<div id="job-form">
    <div class="col-sm-12">
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
    <div class="card-box">
        <h5 class="text-muted text-uppercase m-t-0 m-b-20"><b>Cadastrar um novo job</b></h5>

        <div class="form-group m-b-20">
            <label>Titulo <span class="text-danger">*</span></label>
            <input type="text" name="title" class="form-control" placeholder="Ex: Instalador de antena"
                   value="{{ inputValue('title', get_defined_vars(), ['job' => 'title']) }}">
        </div>

        <div class="form-group m-b-20">
            <label>Categoria <span class="text-danger">*</span></label>
            <select class="form-control select2" id="job_category_id" name="job_category_id">
                @foreach($jobCategories as $jobCategory)
                    <option value="{{ $jobCategory->id }}">{{ $jobCategory->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group m-b-20">
            <label class="m-b-15">Trabalho remoto? <span class="text-danger">*</span></label>
            <br>
            <div class="radio radio-inline">
                <input type="radio" value="1" @change="changeRemote" id="remote"
                       name="remote" {{ inputValue('remote', get_defined_vars(), ['job' => 'remote']) == 1 ? 'checked' : '' }}>
                <label for="inlineRadio1"> Sim </label>
            </div>
            <div class="radio radio-inline">
                <input type="radio" value="0" @change="changeRemote" id="remote"
                       name="remote" {{ inputValue('remote', get_defined_vars(), ['job' => 'remote']) == 0 ? 'checked' : '' }}
                        {{ inputValue('remote', get_defined_vars(), ['job' => 'remote']) == null ? 'checked' : '' }}>
                <label for="inlineRadio2"> Não </label>
            </div>
        </div>

        <div class="form-group m-b-20" v-show="isRemote == 0">
            <label>Endereço <span class="text-danger">*</span></label>
            <select class="form-control select2" id="user_address_id" name="user_address_id">
                <option value="new-address">
                   Cadastrar novo endereço
                </option>
                <option v-for="address in addresses" :value="address.id" :selected="address.primary === 1">
                    @{{ address.address }}
                    @{{ address.number }},
                    @{{ address.complement }},
                    @{{ address.neighborhood }} -
                    @{{ address.city.name }}/@{{ address.city.state.initials }}
                </option>
            </select>
        </div>

        <div v-show="isNewAddress">
            <div class="col-sm-12">
                <div class="card-box m-b-10">
                    <div class="table-box opport-box">

                        <h4 class="m-t-0 header-title"><b>Novo endereço</b></h4>

                            <div class="row">
                                <div class="col-12">
                                    <div class="p-20">
                                        <div class="form-group row">
                                            <label class="col-2 col-form-label">Logradouro <span class="text-danger">*</span></label>
                                            <div class="col-10">
                                                <input type="text" class="form-control" placeholder="Ex: Rua ABC"
                                                       v-model="addressData.address">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-2 col-form-label">Número <span class="text-danger">*</span></label>
                                            <div class="col-10">
                                                <input type="text" class="form-control" placeholder="Ex: 222"
                                                       v-model="addressData.number">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-2 col-form-label">Complemento</label>
                                            <div class="col-10">
                                                <input name="name" type="text" class="form-control" placeholder="Ex: Apartamento 201"
                                                       v-model="addressData.complement">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-2 col-form-label">Bairro <span class="text-danger">*</span></label>
                                            <div class="col-10">
                                                <input name="name" type="text" class="form-control" placeholder="Ex: Centro"
                                                       v-model="addressData.neighborhood">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-2 col-form-label">Cep <span class="text-danger">*</span></label>
                                            <div class="col-10">
                                                <input name="name" type="text" class="form-control" placeholder="Ex: 30130010"
                                                       v-model="addressData.zip_code" maxlength="8">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-2 col-form-label">Cidade <span class="text-danger">*</span></label>
                                            <div class="col-10">
                                                @include('components.cities')
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end row -->

                            <!-- end row -->
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="text-sm-center">
                                        <a class="btn btn-success waves-effect waves-light" @click="submitAddress()">
                                           <span class="btn-label"><i class="fa fa-check"></i>
                                           </span>Salvar
                                        </a>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group m-b-20 col-md-12 p-0">
            <label class="m-b-15">Quando?</label>
            <div class="row">
                <div class="col-md-4">
                    Dia: <input class="form-control" type="date" name="specific_date"
                                value="{{ inputValue('specific_date', get_defined_vars(), ['job' => 'specific_date']) }}">
                </div>
                <div class="col-md-4">
                    De: <input class="form-control" type="time" name="initial_time"
                               value="{{ inputValue('initial_time', get_defined_vars(), ['job' => 'initial_time']) }}">
                </div>
                <div class="col-md-4">
                    Até: <input class="form-control" type="time" name="final_time"
                                value="{{ inputValue('final_time', get_defined_vars(), ['job' => 'final_time']) }}">
                </div>
            </div>
        </div>

        <div class="form-group m-b-20">
            <label>Descrição<span class="text-danger">*</span></label>
            <textarea class="form-control" name="description" rows="5"
                      placeholder="Ex: Preciso de uma pessoa para instalar várias antenas preparadas para o sinal digital no meu condomínio.">{{ inputValue('description', get_defined_vars(), ['job' => 'description']) }}</textarea>
        </div>

        <hr>

        <div class="form-group m-b-0 col-md-12 text-center">
            <input type="submit" class="btn btn-primary" value="Publicar">
        </div>
    </div>
</div>
</div>

@section('partial-css')
    <link href="{{ asset('plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('plugins/sweet-alert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('partial-js')
    <script>
        const _csrf_token = '{{ csrf_token() }}';
        const _userId = '{{ auth()->id() }}';
    </script>
    <script src="{{ asset('plugins/sweet-alert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/js/select2.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('plugins/select2/js/i18n/pt-BR.js') }}" type="text/javascript"></script>
    <script>
        $(function () {
            $('#job_category_id').val(['{{ ($jobCategory = inputValue('job_category_id', get_defined_vars(), ['job' => 'job_category_id'])) ? $jobCategory : 'null' }}']).trigger('change');

            $('#job_category_id').select2({
                "language": "pt-BR",
                placeholder: "Selecione uma categoria"
            });

            $('#user_address_id').val(['{{ ($jobUserAddress = inputValue('user_address_id', get_defined_vars(), ['job' => 'user_address_id'])) ? $jobUserAddress : 'null' }}']).trigger('change');

            $('#user_address_id').select2({
                "language": "pt-BR",
                placeholder: "Selecione um endereço"
            });

            $('#user_address_id').on('select2:select', function (e) {
                var data = e.params.data;
                window.jobForm.selectedAddress = data.id;
            });
        });
    </script>
    <script src="{{ url(mix('js/jobForm.js')) }}" type="text/javascript"></script>
@endsection