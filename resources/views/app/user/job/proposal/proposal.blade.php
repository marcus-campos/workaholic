@extends('template')

@section('container')
    <div id="proposal">
        <div v-if="!pageLoading">
            <div class="row">
                <div class="col-12">
                    <div class="portlet">
                        <div class="portlet-heading portlet-default">
                            <h3 class="portlet-title text-dark">
                                Trabalho
                            </h3>
                            <div class="portlet-widgets">
                                <a data-toggle="collapse" data-parent="#jobAccordion" href="#portlet_job" class="collapsed" aria-expanded="false"><i class="ion-minus-round"></i></a>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div id="portlet_job" class="panel-collapse collapse" style="">
                            <div class="portlet-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="product-right-info">
                                            <a :href="'{{ url('/') }}/user/job/' + job.id"><h4 class="m-t-0 m-b-20 job-list-title"><b>@{{ job.title }}</b></h4></a>
                                            <hr/>
                                            <p class="text-muted">@{{ job.description }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="m-t-20">
                                            <div>
                                                <p class="text-dark m-b-0"><b>Publicado em: </b> <span class="text-muted"> @{{ job.created_at | c-dmy }} </span></p>
                                                <p class="text-dark m-b-0"><b>Profissionais interessados: </b> <span class="text-muted"> @{{ job.proposals_count }} </span></p>
                                                <p class="text-dark m-b-0"><b>Categoria: </b> <span class="text-muted"> @{{ job.job_category.name }} </span></p>
                                                <p class="text-dark m-b-0"><b>Cidade:</b> <span class="text-muted"> @{{ job.city.name }} </span></p>
                                                <p class="text-dark m-b-0"><b>Bairro:</b> <span class="text-muted"> @{{ job.neighborhood }} </span></p>
                                                <p class="text-dark m-b-0">
                                                    <b>Quando? </b>
                                                    <b>Dia: </b> <span class="text-muted">@{{ job.specific_date | c-dmy }}</span>
                                                    <b>De: </b> <span class="text-muted">@{{ job.initial_time | c-HHss }}</span>
                                                    <b>Até: </b> <span class="text-muted">@{{ job.final_time | c-HHss }}</span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">

                                    </div>
                                    <div class="col-sm-6">
                                        <p class="text-dark m-t-40 pull-right font-10">
                                            <b>Data de cadastro: </b> <span class="text-muted"> @{{ job.created_at | dmyHHss }}</span>
                                            <b>&nbsp;Última atualização: </b> <span class="text-muted"> @{{ job.updated_at | dmyHHss }} </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row" v-if="isMe(job.user_id)">
                <div class="col-12">
                    <div class="m-b-20 proposal-title">
                        PROPOSTAS
                    </div>
                </div>
            </div>
            <div class="row" v-for="proposal in job.proposals">
                <div class="col-12">
                    <div class="portlet">
                        <div class="portlet-heading portlet-default">
                            <h3 class="portlet-title text-dark">
                                @{{ isMe(proposal.user_id) ? 'Minha proposta': proposal.user.name }}
                            </h3>
                            <div class="portlet-widgets">
                                <span v-if="isMe(job.user_id) && proposal.status !== 'accepted'">
                                    <a class="btn btn-sm btn-success waves-effect waves-light" @click="acceptProposal(proposal)">Aceitar proposta</a>
                                    <span class="divider"></span>
                                </span>
                                <span v-else-if="proposal.status === 'rejected'">
                                    <span class="label label-warning">Outra proposta foi aceita</span>
                                    <span class="divider"></span>
                                </span>
                                <span v-else-if="proposal.status === 'waiting'">
                                    <span class="label label-info">Proposta em avaliação</span>
                                    <span class="divider"></span>
                                </span>
                                <span v-else>
                                    <span class="label label-success">Proposta aceita</span>
                                    <span class="divider"></span>
                                </span>
                                <a href="javascript:;" data-toggle="reload" @click="getJob()"><i class="ion-refresh"></i></a>
                                <span class="divider"></span>
                                <a data-toggle="collapse" data-parent="#proposalAccordion" :href="'#portlet_proposal_' + proposal.id" aria-expanded="true"><i class="ion-minus-round"></i></a>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div :id="'portlet_proposal_' + proposal.id" class="panel-collapse collapse show" style="">
                            <div class="portlet-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="product-right-info">
                                            <hr/>
                                            <p class="text-muted"> @{{ proposal.description }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="m-t-20">
                                            <div>
                                                <p class="text-dark m-b-0"><b>Valor cobrado: </b> <span class="text-muted"> @{{ proposal.net_value | currency('R$ ', 2, {thousandsSeparator: '.', decimalSeparator: ','}) }} </span></p>
                                                <p class="text-dark m-b-0"><b>Tempo necessário para terminar o trabalho:</b> <span class="text-muted"> @{{ proposal.time_to_finish_the_job }} </span></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                    </div>
                                    <div class="col-sm-6">
                                        <p class="text-dark m-t-40 pull-right font-10">
                                            <b>Data de cadastro: </b> <span class="text-muted"> @{{ proposal.created_at | dmyHHss }}</span>
                                            <b>&nbsp;Última atualização: </b> <span class="text-muted"> @{{ proposal.updated_at | dmyHHss }} </span>
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="product-right-info">
                                            <hr/>
                                            <h5 class="font-600">Comentários <span class="label label-info">@{{ proposal.comments.length <= 999 ? proposal.comments.length: '999+' }}</span></h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 m-b-20">
                                        <div class="nicescroll comment-box">
                                            <div class="comment p-0" v-for="comment in proposal.comments">
                                                <div class="comment-body m-l-0 m-b-10">
                                                    <div class="comment-text" v-if="isMe(comment.user_id)">
                                                        <div class="comment-header">
                                                            @{{ comment.user.name }}<span>@{{ comment.created_at | dmyHHss }}</span>
                                                        </div>
                                                        @{{ comment.description }}
                                                    </div>

                                                    <div class="comment-text-odd" v-else>
                                                        <div class="comment-header">
                                                            @{{ comment.user.name }}<span>@{{ comment.created_at | dmyHHss }}</span>
                                                        </div>
                                                        @{{ comment.description }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" v-if="proposal.status !== 'rejected'">
                                    <div class="col-sm-12">
                                        <span class="input-icon icon-right">
                                            <textarea rows="2" class="form-control" placeholder="Adicionar novo comentário" v-model="commentData.description"></textarea>
                                        </span>
                                        <div class="p-t-10 pull-right">
                                            <a class="btn btn-sm btn-primary waves-effect waves-light" :class="{disabled: commentData.disableSendButton}" :onkeypress="enableSendButton()" @click="submitComment(proposal.id)">Enviar</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection

@section('section-css')
    <link href="{{ asset('plugins/sweet-alert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('section-js')
    <script>
        const _jobId = '{{ $jobId }}';
        const _csrf_token = '{{ csrf_token() }}';
        const _userId = '{{ auth()->id() }}';
    </script>
    <script src="{{ asset('plugins/sweet-alert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('assets/js/vue/plugins/vue2-filters.min.js') }}"></script>
    <script src="{{ asset('js/vue/filters.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/vue/job/proposal/show.js') }}" type="text/javascript"></script>
@endsection