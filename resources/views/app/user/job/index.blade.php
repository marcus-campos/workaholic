@extends('template')

@section('container')
<div id="index-jobs">
    <div class="row">
        <div class="col-md-6">
            <form role="form">
                <div class="form-group contact-search m-b-30">
                    <input type="text" id="search" class="form-control" placeholder="Pesquisar..." v-model="search">
                    <button type="submit" class="btn btn-white"><i class="fa fa-search"></i></button>
                </div> <!-- form-group -->
            </form>
        </div>
        <div class="col-md-6">
            <a :href="'/user/job/create'" class="btn btn-default btn-md waves-effect waves-light m-b-30 pull-right" data-animation="fadein" data-plugin="custommodal"
               data-overlaySpeed="200" data-overlayColor="#36404a" v-show="page === '/user/job/client'"><i class="md md-add"></i> Cadastrar</a>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card-box m-b-10" v-for="job in jobs">
                <div class="table-box opport-box">
                   {{-- <div class="table-detail checkbx-detail">
                        <div class="checkbox checkbox-primary checkbox-single m-r-15">
                            <input id="checkbox1" type="checkbox">
                            <label for="checkbox1"></label>
                        </div>
                    </div>--}}

                    <div class="row">
                        <div class="col-sm-10">
                            <h4 class="m-t-0 m-b-20 job-list-title"><b>@{{ job.title }}</b></h4>
                            <p class="text-dark m-b-1"><b>Categoria: </b> <span class="text-muted">@{{ job.job_category.name }}</span></p>
                            <p class="text-dark m-b-1"><b>Data de cadastro: </b> <span class="text-muted"> @{{ job.created_at | c-dmy }} </span></p>
                            <p class="text-dark m-b-1"><b>Cidade:</b> <span class="text-muted"> @{{ job.city.name }} </span></p>
                            <p class="text-dark m-b-1"><b>Bairro:</b> <span class="text-muted"> @{{ job.neighborhood }} </span></p>
                            <p class="text-dark m-b-1">
                                <b>Quando? </b>
                                <b>Dia: </b> <span class="text-muted"> @{{ job.specific_date | c-dmy }} </span>
                                <b>De: </b> <span class="text-muted"> @{{ job.initial_time | c-HHss }} </span>
                                <b>Até: </b> <span class="text-muted"> @{{ job.final_time | c-HHss }} </span>
                            </p>
                            <p class="text-dark m-b-0 job-list-description">
                                <b>Descrição: </b> <span class="text-muted">@{{ job.description }}</span>
                            </p>
                        </div>
                        <div class="col-sm-2 job-action-btn">
                            <a :href="'{{ url('/') }}/user/job/' + job.id" class="table-action-btn" v-show="page === '/user/job'"><i class="fa fa-eye"></i></a>
                            <a :href="'{{ url('/') }}/user/proposal/job/' + job.id" class="table-action-btn" v-show="page !== '/user/job'"><i class="md md-assignment"></i></a>
                            <a :href="'{{ url('/') }}/user/job/' + job.id + '/edit'" class="table-action-btn" v-show="page === '/user/job/client'"><i class="md md-edit"></i></a>
                            <a href="#" @click="submitDelete(job)" class="table-action-btn" v-show="page === '/user/job/client'"><i class="md md-close"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <h2 v-show="jobs.length < 1"> Oooops!!! Nenhum trabalho foi encontrado. </h2>
        </div> <!-- end col -->
        {{--<div class="col-sm-4">
            <div class="card-box">
                <h4 class="m-t-0 m-b-20 text-dark header-title">Status Chart</h4>
                <div id="pie-chart"></div>
            </div>
        </div>--}}
    </div>
    <div class="row" v-if="pagination.last_page > 1">
        <div class="col-sm-12">
            <div class="text-center m-b-10">
                    <button class="btn btn-default m-r-15" @click="getJobs(pagination.prev_page_url)"
                            :disabled="!pagination.prev_page_url">
                        Voltar
                    </button>
                    <span>Pagina @{{pagination.current_page}} de @{{pagination.last_page}}</span>
                    <button class="btn btn-default m-l-15" @click="getJobs(pagination.next_page_url)"
                            :disabled="!pagination.next_page_url">Próximo
                    </button>
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
        const _csrf_token = '{{ csrf_token() }}';
    </script>
    <script src="{{ asset('plugins/sweet-alert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('js/vue/filters.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/vue/job/index.js') }}" type="text/javascript"></script>
@endsection
