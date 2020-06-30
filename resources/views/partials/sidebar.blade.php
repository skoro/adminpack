<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">

            <div class="sb-sidenav-menu">

                <div class="nav">

                    <div class="sb-sidenav-menu-heading">Core</div>
                    <a class="nav-link" href="{{ route('admin.home') }}">
                        <div class="sb-nav-link-icon">
                            <x-admin-icon icon="diagram-3-fill"/>
                        </div>
                        Dashboard
                    </a>

                    <div class="sb-sidenav-menu-heading">
                        {{ __('System') }}
                    </div>

                    @admincanany(['create', 'viewAny', 'manageRoles'])
                        <x-admin-menu :title="__('Users')" icon="people-fill">

                            @admincan('create')
                                <x-admin-submenu :title="__('New User')" :url="route('admin.user.create')"/>
                            @endadmincan

                            @admincan('viewAny')
                                <x-admin-submenu :title="__('List')" :url="route('admin.users')"/>
                            @endadmincan

                            @admincan('manageRoles')
                                <x-admin-submenu :title="__('Roles')" :url="route('admin.roles')"/>
                            @endadmincan
                            
                        </x-admin-menu>
                    @endadmincanany
                    

                    @admincan('manageOptions')
                        <x-admin-menu :title="__('Options')" icon="toggles" :url="route('admin.options')"/>
                    @endadmincan

                </div>
            </div>

        </nav>
    </div>