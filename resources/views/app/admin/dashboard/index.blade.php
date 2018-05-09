@extends('template')

@section('container')
    <div class="row">
        <div class="col-md-6 col-lg-6 col-xl-3">
            <div class="widget-panel widget-style-2 bg-white">
                <i class="fa fa-briefcase text-info"></i>
                <h2 class="m-0 text-dark counter font-600">{{ \App\Models\Job::count() }}</h2>
                <div class="text-muted m-t-5">Trabalhos</div>
            </div>
        </div>
        <div class="col-md-6 col-lg-6 col-xl-3">
            <div class="widget-panel widget-style-2 bg-white">
                <i class="md md md-assignment text-info"></i>
                <h2 class="m-0 text-dark counter font-600">{{ \App\Models\Proposal::count() }}</h2>
                <div class="text-muted m-t-5">Propostas</div>
            </div>
        </div>
        <div class="col-md-6 col-lg-6 col-xl-3">
            <div class="widget-panel widget-style-2 bg-white">
                <i class="md md-comment text-info"></i>
                <h2 class="m-0 text-dark counter font-600">{{ \App\Models\ProposalComment::count() }}</h2>
                <div class="text-muted m-t-5">Comentários</div>
            </div>
        </div>
        <div class="col-md-6 col-lg-6 col-xl-3">
            <div class="widget-panel widget-style-2 bg-white">
                <i class="md md-account-child text-info"></i>
                <h2 class="m-0 text-dark counter font-600">{{ \App\Models\User::count() }}</h2>
                <div class="text-muted m-t-5">Usuários</div>
            </div>
        </div>
    </div>
    <div class="row m-t-10">
        <div class="col-sm-12">
            <iframe  width="100%" height="400" style="border:none;" src="https://s3-sa-east-1.amazonaws.com/staging95.orkaholic.com.br/doodles/index.html"></iframe>
        </div>
    </div>
@endsection