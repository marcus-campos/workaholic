@extends('template')

@section('container')
<div id="job">
    <div class="row">
        <div class="col-12">
            <div class="card-box product-detail-box">
                <div class="row">
                   <div class="col-sm-12">
                        <div class="product-right-info">
                            <h4><b>{{ inputValue('title', get_defined_vars(), ['job' => 'title']) }}</b></h4>

                            <hr/>

                            <p class="text-muted">{{ inputValue('description', get_defined_vars(), ['job' => 'description']) }}</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="m-t-20">
                            <div>
                                <p class="text-dark m-b-0"><b>Publicado em: </b> <span class="text-muted">{{ date('d/m/Y', strtotime($job->created_at)) }} </span></p>
                                <p class="text-dark m-b-0"><b>Profissionais interessados: </b> <span class="text-muted"> {{ $job->proposals_count }} </span></p>
                                <p class="text-dark m-b-0"><b>Categoria: </b> <span class="text-muted">{{ $job->jobCategory->name }}</span></p>
                                <p class="text-dark m-b-0"><b>Cidade:</b> <span class="text-muted">{{ $job->userAddresses->city->name }}</span></p>
                                <p class="text-dark m-b-0"><b>Bairro:</b> <span class="text-muted">{{ $job->userAddresses->neighborhood }}</span></p>
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
                <div class="row m-t-20">
                    <div class="col-sm-12">
                        <div class="form-group user-sm-profile-photo">
                            <img src="{{ $job->user->photo }}" class="rounded-circle"> <span class="text-muted"> {{ $job->user->name }} </span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="m-t-20">
                            <button type="button" class="btn btn-default waves-effect waves-light" @click="showHideProposal()" v-show="showProposalButton">
                                                             <span class="btn-label"><i class="md md-assignment"></i>
                                                           </span>Fazer um proposta</button>

                            <button type="button" class="btn btn-info waves-effect waves-light" @click="redirectToProposal()" v-show="showProposalFollowingButton">
                                                             <span class="btn-label"><i class="md md-assignment"></i>
                                                           </span>Acompanhar proposta<span v-if="isMe(_ownerId)">s</span></button>

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
    </div>
    @if($job->user_id != auth()->id())
        @include('app.user.job.partials.new-proposal')
    @endif
</div>
<script>
    const _jobId = '{{ $job->id }}';
    const _userId = '{{ auth()->id() }}';
    const _ownerId = '{{ $job->user_id }}';
    const _csrf_token = '{{ csrf_token() }}';
</script>
@endsection

@section('section-js')
    <script src="{{ asset('plugins/autoNumeric/autoNumeric.js') }}" type="text/javascript"></script>
    <script src="{{ url(mix('js/jobShow.js')) }}" type="text/javascript"></script>
@endsection