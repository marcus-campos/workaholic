@section('user-header')
    <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button"
       aria-haspopup="false" aria-expanded="false">
        {{ auth()->check() ? \Illuminate\Support\Facades\Auth::user()->name : 'Entrar' }}
    </a>
@endsection

@section('user')
    @if(\Illuminate\Support\Facades\Auth::check())
        <!-- item-->
        <a href="#" class="dropdown-item notify-item">
            <i class="zmdi zmdi-account-circle"></i> <span>Minha conta</span>
        </a>
        <!-- item-->
        <a href="{{ route('logout') }}" class="dropdown-item notify-item">
            <i class="zmdi zmdi-account-circle"></i> <span>Sair</span>
        </a>
    @else
        <!-- item-->
        <a href="{{ route('login.form') }}" class="dropdown-item notify-item">
            <i class="zmdi zmdi-account-circle"></i> <span>Ir para o login</span>
        </a>
    @endif
@endsection