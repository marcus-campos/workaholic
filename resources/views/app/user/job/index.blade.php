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
            <a href="{{ route('user.job.create') }}" class="btn btn-default btn-md waves-effect waves-light m-b-30 pull-right" data-animation="fadein" data-plugin="custommodal"
               data-overlaySpeed="200" data-overlayColor="#36404a"><i class="md md-add"></i> Cadastrar</a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card-box m-b-10" v-for="job in jobs">
                <div class="table-box opport-box">
                   {{-- <div class="table-detail checkbx-detail">
                        <div class="checkbox checkbox-primary checkbox-single m-r-15">
                            <input id="checkbox1" type="checkbox">
                            <label for="checkbox1"></label>
                        </div>
                    </div>--}}

                    <div class="table-detail">
                        <div class="member-info">
                            <h4 class="m-t-0 job-list-title"><b><a :href="'{{ url('/') }}/user/job/' + job.id" >@{{ job.title }}</a> </b></h4>
                            <p class="text-dark m-b-5"><b>Categoria: </b> <span class="text-muted">@{{ job.job_category.name }}</span></p>
                            <p class="text-dark m-b-0"><b>Data de cadastro: </b> <span class="text-muted"> INSERIR_DADO </span></p>
                        </div>
                    </div>

                    <div class="table-detail">
                        <p class="text-dark m-b-5"><b>Cidade:</b> <span class="text-muted"> INSERIR_DADO </span></p>
                        <p class="text-dark m-b-0"><b>Bairro:</b> <span class="text-muted"> INSERIR_DADO </span></p>
                    </div>

                   {{-- <div class="table-detail lable-detail">
                        <span class="label label-info">Hot</span>
                    </div>
--}}                <form method="post" id="job_delete" action="#">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <div class="table-detail table-actions-bar">
                            <a :href="'{{ url('/') }}/job/' + job.id + '/edit'" class="table-action-btn"><i class="md md-edit"></i></a>
                            <a href="#" onClick="document.getElementById('job_delete').submit();" class="table-action-btn"><i class="md md-close"></i></a>
                        </div>
                    </form>
                </div>
                <div class="font-13">
                    <p class="text-dark m-b-5">
                        <b>Quando? </b>
                        <b>Dia: </b> <span class="text-muted"> INSERIR_DADO </span>
                        <b>De: </b> <span class="text-muted"> INSERIR_DADO </span>
                        <b>Até: </b> <span class="text-muted"> INSERIR_DADO </span>
                    </p>
                </div>
                <div class="font-13">
                    <p class="text-dark m-b-5">
                        <b>Descrição: </b> <span class="text-muted job-list-description">@{{ job.description }}</span>
                    </p>
                </div>
            </div>

        </div> <!-- end col -->

        {{--<div class="col-lg-4">
            <div class="card-box">
                <h4 class="m-t-0 m-b-20 text-dark header-title">Status Chart</h4>
                <div id="pie-chart"></div>
            </div>
        </div>--}}
    </div>
    <div class="row" v-if="pagination.last_page > 1">
        <div class="col-lg-12">
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

@section('section-js')
   <script src="{{ asset('js/vue/job/index.js') }}" type="text/javascript"></script>
@endsection
