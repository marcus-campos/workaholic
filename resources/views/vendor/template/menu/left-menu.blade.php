@section('left-menu')
    <div class="left side-menu">
        <div class="sidebar-inner slimscrollleft">
            <!--- Divider -->
            <div id="sidebar-menu">
                <ul>
                    @includeWhen((auth()->check() && auth()->user()->role == 'admin'), 'default.menu.admin')
                    @include('default.menu.user')
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    </div>
@endsection