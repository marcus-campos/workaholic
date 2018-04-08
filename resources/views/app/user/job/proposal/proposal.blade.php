@extends('template')

@section('container')
    <div id="proposal">
        <div class="row">
            <div class="col-12">
                <div class="portlet">
                    <div class="portlet-heading portlet-default">
                        <h3 class="portlet-title text-dark">
                            Trabalho
                        </h3>
                        <div class="portlet-widgets">
                            <a data-toggle="collapse" data-parent="#jobAccordion" href="#bg-job" class="collapsed" aria-expanded="false"><i class="ion-minus-round"></i></a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div id="bg-job" class="panel-collapse collapse hide" style="">
                        <div class="portlet-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="product-right-info">
                                        <h4><b>@{{ job.title }}</b></h4>

                                        <hr/>

                                        <h5 class="font-600">Descrição</h5>

                                        <p class="text-muted">@{{ job.description }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="font-13 m-t-20">
                                        <div>
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

        <div class="row" v-for="proposal in job.proposals">
            <div class="col-12">
                <div class="portlet">
                    <div class="portlet-heading portlet-default">
                        <h3 class="portlet-title text-dark">
                            Proposta de @{{ proposal.user.name }}
                        </h3>
                        <div class="portlet-widgets">
                            <a href="javascript:;" data-toggle="reload" @click="getJob()"><i class="ion-refresh"></i></a>
                            <span class="divider"></span>
                            <a data-toggle="collapse" data-parent="#proposalAccordion" :href="'#portlet_proposal_' + proposal.id" class="" aria-expanded="true"><i class="ion-minus-round"></i></a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div :id="'portlet_proposal_' + proposal.id" class="panel-collapse collapse show" style="">
                        <div class="portlet-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="product-right-info">
                                        <hr/>

                                        <h5 class="font-600">Descrição</h5>

                                        <p class="text-muted"> @{{ proposal.description }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="font-13 m-t-20">
                                        <div>
                                            <p class="text-dark m-b-0"><b>Valor cobrado: </b> <span class="text-muted"> @{{ proposal.net_value }} </span></p>
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

                                        <h5 class="font-600">Comentários</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 m-b-20">
                                    <div class="nicescroll comment-box">
                                        <div class="comment p-0" v-for="comment in proposal.comments">
                                            <div class="comment-body m-l-0 m-b-10">
                                                <div class="comment-text" v-if="isMeOnComment(comment.user_id)">
                                                    <div class="comment-header">
                                                        @{{ comment.user.name }}<span>@{{ comment.created_at }}</span>
                                                    </div>
                                                    @{{ comment.description }}
                                                </div>

                                                <div class="comment-text-odd" v-else>
                                                    <div class="comment-header">
                                                        @{{ comment.user.name }}<span>@{{ comment.created_at }}</span>
                                                    </div>
                                                    @{{ comment.description }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
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

@endsection

@section('section-js')
    <script>
        const _jobId = '{{ $jobId }}';
        const _csrf_token = '{{ csrf_token() }}';
        const _userId = '{{ auth()->id() }}';
    </script>
    <script src="{{ asset('js/vue/filters.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/vue/job/proposal/show.js') }}" type="text/javascript"></script>
@endsection