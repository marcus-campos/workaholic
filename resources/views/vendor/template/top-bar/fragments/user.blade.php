@section('user-header')
    <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button"
       aria-haspopup="false" aria-expanded="false">
        @if(auth()->user()->photo)
            <img src="{{getFileUrl(auth()->user()->photo)}}" alt="user" class="rounded-circle">
        @else
            {{ auth()->check() ? \Illuminate\Support\Facades\Auth::user()->name : 'Entrar' }}
        @endif
    </a>
@endsection

@section('user')
    @if(\Illuminate\Support\Facades\Auth::check())
        @if(auth()->user()->photo)
            <div class="dropdown-item noti-title">
                <h5 class="text-overflow"><small>Olá ! {{ explode(' ',trim(auth()->user()->name))[0] }}</small> </h5>
            </div>
        @endif
        <!-- item-->
        <a href="#" class="dropdown-item notify-item">
            <i class="md md-account-circle"></i> <span>Profile</span>
        </a>

        <!-- item-->
        <a href="{{ route('user.my-account.index') }}" class="dropdown-item notify-item">
            <i class="md md-settings"></i> <span>Minha conta</span>
        </a>
        <!-- item-->
        <a href="{{ route('logout') }}" class="dropdown-item notify-item">
            <i class="md md-settings-power"></i><span>Sair</span>
        </a>
    @else
        <!-- item-->
        <a href="{{ route('login.form') }}" class="dropdown-item notify-item">
            <i class="zmdi zmdi-account-circle"></i> <span>Ir para o login</span>
        </a>
    @endif
@endsection