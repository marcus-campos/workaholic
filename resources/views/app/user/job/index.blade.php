@extends('template')

@section('container')

<div class="row">
    <div class="col-md-6">
        <form role="form">
            <div class="form-group contact-search m-b-30">
                <input type="text" id="search" class="form-control" placeholder="Pesquisar...">
                <button type="submit" class="btn btn-white"><i class="fa fa-search"></i></button>
            </div> <!-- form-group -->
        </form>
    </div>
    <div class="col-md-6">
        <a href="{{ route('user.job.create') }}" class="btn btn-default btn-md waves-effect waves-light m-b-30 pull-right" data-animation="fadein" data-plugin="custommodal"
           data-overlaySpeed="200" data-overlayColor="#36404a"><i class="md md-add"></i> Cadastrar</a>
        <div id="div_order_by">
            <span class="font-16">Ordenar por:</span>
            <a class="btn btn-default btn-sm" href="{{ queryStringMaker(url()->current(), null, null, '["title","desc"]') }}" id="order_by_title" value="title" autocomplete="off" checked> Titulo </a>
            <a class="btn btn-default btn-sm" href="{{ queryStringMaker(url()->current(), null, null, '["created_at","desc"]') }}" id="order_by_title" value="title" autocomplete="off" checked> Data de criação </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">

        @foreach($jobs as $job)
            <div class="card-box m-b-10">
                <div class="table-box opport-box">
                   {{-- <div class="table-detail checkbx-detail">
                        <div class="checkbox checkbox-primary checkbox-single m-r-15">
                            <input id="checkbox1" type="checkbox">
                            <label for="checkbox1"></label>
                        </div>
                    </div>--}}

                    <div class="table-detail">
                        <div class="member-info">
                            <h4 class="m-t-0 job-list-title"><b><a href="{{ route('user.job.show', ['job' => $job->id]) }}">{{ $job->title }}</a> </b></h4>
                            <p class="text-dark m-b-5"><b>Categoria: </b> <span class="text-muted">{{ $job->jobCategory->name }}</span></p>
                            <p class="text-dark m-b-0"><b>Data de cadastro: </b> <span class="text-muted">{{ date('d/m/Y', strtotime($job->created_at)) }}</span></p>
                        </div>
                    </div>

                    <div class="table-detail">
                        <p class="text-dark m-b-5"><b>Cidade:</b> <span class="text-muted">{{ (new \App\Models\City())->cityFromToName($job->city_id) }}</span></p>
                        <p class="text-dark m-b-0"><b>Bairro:</b> <span class="text-muted">{{ $job->neighborhood }}</span></p>
                    </div>

                   {{-- <div class="table-detail lable-detail">
                        <span class="label label-info">Hot</span>
                    </div>
--}}                <form method="post" id="job_delete" action="{{ route('user.job.destroy', ['job' => $job->id]) }}">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <div class="table-detail table-actions-bar">
                            <a href="{{ route('user.job.edit', ['job' => $job->id]) }}" class="table-action-btn"><i class="md md-edit"></i></a>
                            <a href="#" onClick="document.getElementById('job_delete').submit();" class="table-action-btn"><i class="md md-close"></i></a>
                        </div>
                    </form>
                </div>
                <div class="font-13">
                    <p class="text-dark m-b-5">
                        <b>Quando? </b>
                        <b>Dia: </b> <span class="text-muted">{{ $job->specific_date ? date('d/m/Y', strtotime($job->specific_date)) : 'A combinar' }}</span>
                        <b>De: </b> <span class="text-muted">{{ $job->initial_time ? date('H:i', strtotime($job->initial_time)) : 'A combinar' }}</span>
                        <b>Até: </b> <span class="text-muted">{{ $job->final_time ? date('H:i', strtotime($job->final_time)) : 'A combinar' }}</span>
                    </p>
                </div>
                <div class="font-13">
                    <p class="text-dark m-b-5">
                        <b>Descrição: </b> <span class="text-muted job-list-description">{{ $job->description }}</span>
                    </p>
                </div>
            </div>
        @endforeach

    </div> <!-- end col -->

    {{--<div class="col-lg-4">
        <div class="card-box">
            <h4 class="m-t-0 m-b-20 text-dark header-title">Status Chart</h4>
            <div id="pie-chart"></div>
        </div>
    </div>--}}

    <span hidden>
        <a href=""></a>
    </span>
</div>

{{$jobs->links()}}

@endsection

@section('section-js')
    <script>


        var currentUrl = window.location.href;

        if(currentUrl.indexOf('created_at')) {
            $('#order_by_created_at').prop('checked', 'true');
        }
    </script>
@endsection
