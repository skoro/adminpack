<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">

    <a class="navbar-brand" href="{{ route('admin.home') }}">
        {{ config('app.name', 'Administry') }}
    </a>
    <button id="sidebarToggle" class="btn btn-link btn-sm order-1 order-lg-0">
        <i class="fas fa-bars"></i>
    </button>

    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
        <div class="input-group">
            <input class="form-control" type="text" placeholder="{{ __('Search for...') }}" aria-label="{{ __('Search') }}" aria-describedby="basic-addon2">
            <div class="input-group-append">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </form>

    <!-- Navbar-->
    <ul class="navbar-nav ml-auto ml-md-0">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-user fa-fw"></i>
                <span class="d-none d-sm-inline">
                    {{ auth_admin()->user()->name }}
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="{{ route('admin.user.profile') }}">
                    {{ __('My Profile') }}
                </a>
                <a class="dropdown-item" href="#">
                    Activity Log
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('admin.logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" method="POST" action="{{ route('admin.logout') }}" style="display:none;">
                    @csrf
                </form>
            </div>
        </li>
    </ul>
</nav>