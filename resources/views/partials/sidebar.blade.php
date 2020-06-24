<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">

            <div class="sb-sidenav-menu">

                <div class="nav">

                    <div class="sb-sidenav-menu-heading">Core</div>
                    <a class="nav-link" href="index.html">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>

                    <div class="sb-sidenav-menu-heading">Interface</div>
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        Layouts
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav"><a class="nav-link" href="layout-static.html">Static Navigation</a><a class="nav-link" href="layout-sidenav-light.html">Light Sidenav</a></nav>
                    </div>
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                        <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                        Pages
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">Authentication
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div></a>
                            <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                <nav class="sb-sidenav-menu-nested nav"><a class="nav-link" href="login.html">Login</a><a class="nav-link" href="register.html">Register</a><a class="nav-link" href="password.html">Forgot Password</a></nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">Error
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div></a>
                            <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                <nav class="sb-sidenav-menu-nested nav"><a class="nav-link" href="401.html">401 Page</a><a class="nav-link" href="404.html">404 Page</a><a class="nav-link" href="500.html">500 Page</a></nav>
                            </div>
                        </nav>
                    </div>

                    <div class="sb-sidenav-menu-heading">
                        {{ __('System') }}
                    </div>
                    
                    @admincan(['create', 'viewAny', 'manageRoles'])
                    <a href="#" class="nav-link collapsed" data-toggle="collapse" data-target="#collapseUsers" aria-expanded="false" aria-controls="collapseUses">
                        <div class="sb-nav-link-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        {{ __('Users') }}
                        <div class="sb-sidenav-collapse-arrow">
                            <i class="fas fa-angle-down"></i>
                        </div>
                    </a>
                    <div id="collapseUsers" class="collapse" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">

                            @admincan('create1'))
                                <a href="{{ route('admin.user.create') }}" class="nav-link">
                                    {{ __('New User') }}
                                </a>
                            @endadmincan

                            @admincan('viewAny')
                                <a href="{{ route('admin.users') }}" class="nav-link">
                                    {{ __('List') }}
                                </a>
                            @endadmincan

                            @can('manageRoles', \Skoro\AdminPack\Models\User::class)
                                <a href="{{ route('admin.roles') }}" class="nav-link">
                                    {{ __('Roles') }}
                                </a>
                            @endcan
                        </nav>
                    </div>
                    @endadmincan

                    @can('manageOptions')
                    <a class="nav-link" href="{{ route('admin.options') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        {{ __('Options') }}
                    </a>
                    @endcan

                </div>
            </div>

        </nav>
    </div>