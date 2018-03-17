@section('notification')
    <a class="nav-link dropdown-toggle arrow-none waves-light waves-effect" data-toggle="dropdown" href="#" role="button"
       aria-haspopup="false" aria-expanded="false">
        <i class="dripicons-bell noti-icon"></i>
        <span class="badge badge-pink noti-icon-badge">4</span>
    </a>
    <div class="dropdown-menu dropdown-menu-right dropdown-arrow dropdown-lg" aria-labelledby="Preview">
        <!-- item-->
        <div class="dropdown-item noti-title">
            <h5><span class="badge badge-danger float-right">5</span>Notification</h5>
        </div>

        <!-- item-->
        <a href="javascript:void(0);" class="dropdown-item notify-item">
            <div class="notify-icon bg-success"><i class="icon-bubble"></i></div>
            <p class="notify-details">Robert S. Taylor commented on Admin<small class="text-muted">1 min ago</small></p>
        </a>

        <!-- item-->
        <a href="javascript:void(0);" class="dropdown-item notify-item">
            <div class="notify-icon bg-info"><i class="icon-user"></i></div>
            <p class="notify-details">New user registered.<small class="text-muted">1 min ago</small></p>
        </a>

        <!-- item-->
        <a href="javascript:void(0);" class="dropdown-item notify-item">
            <div class="notify-icon bg-danger"><i class="icon-like"></i></div>
            <p class="notify-details">Carlos Crouch liked <b>Admin</b><small class="text-muted">1 min ago</small></p>
        </a>

        <!-- All-->
        <a href="javascript:void(0);" class="dropdown-item notify-item notify-all">
            View All
        </a>

    </div>
@endsection