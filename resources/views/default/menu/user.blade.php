<li class="has_sub" id="dashboard">
    <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-home"></i> <span> Início </span> </a>
</li>

<li class="has_sub" id="search">
    <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-search"></i> <span> Encontrar trabalho </span> </a>
</li>


<li class="has_sub">
    <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-briefcase"></i> <span> Meus trabalhos </span> <span class="menu-arrow"></span> </a>
    <ul class="list-unstyled">
        <li><a href="/jobs/list" id="pro">Como profissional</a></li>
        <li><a href="{{ route('user.job.client') }}" id="client">Como cliente</a></li>
        <li><a href="{{ route('user.job.create') }}" id="new_job">Cadastrar um trabalho</a></li>
    </ul>
</li>