{{--<li class="has_sub" id="dashboard">
    <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-home"></i> <span> Início </span> </a>
</li>--}}

<li class="has_sub" id="find-a-job">
    <a href="{{ route('user.job.create') }}" class="waves-effect"><i class="fa fa-plus-square-o"></i> <span> Cadastre um freela </span> </a>
</li>

<li class="has_sub" id="find-a-job">
    <a href="{{ route('user.job.client') }}" class="waves-effect"><i class="fa fa-briefcase"></i> <span> Em negociação </span> </a>
</li>

<li class="has_sub" id="find-a-job">
    <a href="{{ route('user.job.client.accepted') }}" class="waves-effect"><i class="fa fa-tasks"></i> <span> Em andamento </span> </a>
</li>