@extends('template')

@section('container')
    <div class="row">
        <div class="col-12">
            <div class="card-box product-detail-box">
                <div class="row">
                   <div class="col-sm-12">
                        <div class="product-right-info">
                            <h4><b>{{ inputValue('title', get_defined_vars(), ['job' => 'title']) }}</b></h4>

                            <hr/>

                            <h5 class="font-600">Descrição</h5>

                            <p class="text-muted">{{ inputValue('description', get_defined_vars(), ['job' => 'description']) }}</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="font-13 m-t-20">
                            <div>
                                <p class="text-dark m-b-0"><b>Categoria: </b> <span class="text-muted">{{ $job->jobCategory->name }}</span></p>
                                <p class="text-dark m-b-0"><b>Cidade:</b> <span class="text-muted">{{ (new \App\Models\City())->cityFromToName($job->city_id) }}</span></p>
                                <p class="text-dark m-b-0"><b>Bairro:</b> <span class="text-muted">{{ $job->neighborhood }}</span></p>
                                <p class="text-dark m-b-0">
                                    <b>Quando? </b>
                                    <b>Dia: </b> <span class="text-muted">{{ $job->specific_date ? date('d/m/Y', strtotime($job->specific_date)) : 'A combinar' }}</span>
                                    <b>De: </b> <span class="text-muted">{{ $job->initial_time ? date('H:i', strtotime($job->initial_time)) : 'A combinar' }}</span>
                                    <b>Até: </b> <span class="text-muted">{{ $job->final_time ? date('H:i', strtotime($job->final_time)) : 'A combinar' }}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="m-t-20">
                            <button type="button" class="btn btn-default waves-effect waves-light m-l-10">
                                                             <span class="btn-label"><i class="fa fa-file-text-o"></i>
                                                           </span>Fazer um proposta</button>

                        </div>
                    </div>
                    <div class="col-sm-6">
                        <p class="text-dark m-t-40 pull-right font-10">
                            <b>Data de cadastro: </b> <span class="text-muted">{{ date('d/m/Y H:i', strtotime($job->created_at)) }}</span>
                            <b>&nbsp;Última atualização: </b> <span class="text-muted">{{ date('d/m/Y H:i', strtotime($job->updated_at)) }}</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="card-box">
                <h5 class="text-muted text-uppercase m-t-0 m-b-20"><b>Fazer uma proposta</b></h5>

                <div class="form-group m-b-20">
                    <label>Detalhes da proposta<span class="text-danger">*</span></label>
                    <textarea class="form-control" name="description" rows="5" placeholder="Ex: Preciso de uma pessoa para instalar várias antenas preparadas para o sinal digital no meu condominio.">{{ inputValue('description', get_defined_vars(), ['job' => 'description']) }}</textarea>
                </div>

                <div class="form-group m-b-20">
                    <label>Valor líquido a cobrar<span class="text-danger">*</span></label>
                    <textarea class="form-control" name="description" rows="5" placeholder="Ex: Preciso de uma pessoa para instalar várias antenas preparadas para o sinal digital no meu condominio.">{{ inputValue('description', get_defined_vars(), ['job' => 'description']) }}</textarea>
                </div>

                <div class="form-group m-b-20 col-md-12 p-0">
                    <label class="m-b-15">De quanto tempo você precisa para finalizar o trabalho?</label>
                    <div class="row">
                        <div class="col-md-12">
                            <input class="form-control" type="text" name="time_to_finish_the_job" value="{{ inputValue('specific_date', get_defined_vars(), ['job' => 'specific_date']) }}">
                        </div>
                    </div>
                </div>

                <hr>

                <div class="form-group m-b-0 col-md-12 text-center">
                    <input type="submit" class="btn btn-primary" value="Enviar proposta">
                </div>
            </div>
        </div>
    </div>
@endsection