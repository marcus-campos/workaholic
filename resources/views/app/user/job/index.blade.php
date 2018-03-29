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
   <script>
       function debounce(func) {
           var wait = arguments.length <= 1 || arguments[1] === undefined ? 100 : arguments[1];

           var timeout = void 0;
           return function () {
               var _this = this;

               for (var _len = arguments.length, args = Array(_len), _key = 0; _key < _len; _key++) {
                   args[_key] = arguments[_key];
               }

               clearTimeout(timeout);
               timeout = setTimeout(function () {
                   func.apply(_this, args);
               }, wait);
           };
       }


       new Vue({
           el: '#index-jobs',
           data: {
              jobs: [],
              pagination: {},
              search: ''
           },
           mounted() {
               let vm = this;
               vm.getJobs();
           },
           methods: {
               getJobs: function (pageUrl) {
                   let vm = this;
                   pageUrl = pageUrl || '{{ route('user.job.client') }}';

                   if (vm.search !== '') {
                       pageUrl += '?filters=' + encodeURIComponent('[["title","like","%' + vm.search + '%"]]');
                   }

                   vm.$http.get(pageUrl).then(function (data, status, request) {
                       let result = data.data;
                       vm.jobs = result.data.map(i => i);
                       vm.makePagination(result);
                   });
               },
               applyFilter: debounce(function () {
                  let vm = this;
                  vm.getJobs();
               }),
               makePagination: function(data){
                   let vm = this;
                   let pagination = {
                       current_page: data.current_page,
                       last_page: data.last_page,
                       next_page_url: data.next_page_url,
                       prev_page_url: data.prev_page_url
                   };

                   vm.pagination = pagination;
               }
           },
           watch: {
               search: function () {
                   let vm = this;
                   vm.applyFilter();
               }
           }
       });
   </script>
@endsection
