@extends('template')

@section('container')
<div id="proposal">
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
                        @if($job->user_id != auth()->id())
                        <div class="m-t-20">
                            <button type="button" class="btn btn-default waves-effect waves-light m-l-10" @click="showHideProposal()" v-show="showProposalButton">
                                                             <span class="btn-label"><i class="fa fa-file-text-o"></i>
                                                           </span>Fazer um proposta</button>

                        </div>
                        @endif
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
    </div>
    @if($job->user_id != auth()->id())
        @include('app.user.job.partials.new-proposal')
    @endif
</div>
@endsection

@section('section-js')
    <script>
        const _jobId = '{{ $job->id }}';
        const _csrf_token = '{{ csrf_token() }}';
    </script>
    <script src="{{ asset('js/vue/job/show.js') }}" type="text/javascript"></script>
@endsection