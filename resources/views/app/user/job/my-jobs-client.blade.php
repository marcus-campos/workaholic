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
        <div class="h5 m-0">
            <span class="font-16">Ordenar por:</span>
            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                <label class="btn btn-secondary active">
                    <input type="radio" name="options" id="option1" autocomplete="off" checked> Nome
                </label>
                <label class="btn btn-secondary">
                    <input type="radio" name="options" id="option2" autocomplete="off"> Categoria
                </label>
            </div>
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
                            <h4 class="m-t-0 job-list-title"><b>{{ $job->title }} </b></h4>
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
--}}
                    <div class="table-detail table-actions-bar">
                        <a href="#" class="table-action-btn"><i class="md md-edit"></i></a>
                        <a href="#" class="table-action-btn"><i class="md md-close"></i></a>
                    </div>
                </div>
                <div class="font-13">
                    <p class="text-dark m-b-5">
                        <b>Quando? </b>
                        <b>Dia: </b> <span class="text-muted">{{ $job->specific_date ? date('d-m-Y', strtotime($job->specific_date)) : 'A combinar' }}</span>
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
</div>

{{$jobs->links()}}

@endsection