<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.home') }}" class="brand-link" style="border-bottom: none;">
        <img src="{{ $setting->logo }}" alt="AdminLTE Logo" class="brand-image">
        <span class="brand-text font-weight-light"
            style=" font-size: 16px; font-weight: 600 !important; ">{{ $general_settings->store_name }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item p-1 ">
                    <a href="{{ route('admin.home') }}" class="nav-link {{ Helper::isActive(['admin.home']) }}">
                        <i class="nav-icon align-middle m-1 fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                <li
                    class="nav-item has-treeview {{ Helper::isActive(['user.*', 'role.*', 'permission.*'], 'menu-open') }} ">
                    <a href="pages/widgets.html"
                        class="nav-link  {{ Helper::isActive(['user.*', 'role.*', 'permission.*']) }}">
                        <i class="nav-icon align-middle m-1 fa fa-user f-18 "></i>
                        <p> User setting <i class="right fa fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.user.index') }}"
                                class="nav-link {{ Helper::isActive(['user.*']) }}">
                                <i class='fa fa-user f-18 m-1 px-1'></i>
                                <p class="align-middle">
                                    Users
                                </p>
                            </a>
                        </li>

                        @if (auth('admin')->check() &&
                            auth('admin')->user()->hasRole('Super Admin'))
                            <li class="nav-item">
                                <a href="{{ route('admin.role.index') }}"
                                    class="nav-link {{ Helper::isActive(['role.*']) }}">
                                    <i class="fa fa-user-shield m-1 f-18 px-1"></i>
                                    <p class="align-middle">
                                        Role
                                    </p>
                                </a>
                            </li>
                        @endif

                        @if (auth('admin')->check() &&
                            auth('admin')->user()->hasRole('Super Admin'))
                            <li class="nav-item">
                                <a href="{{ route('admin.permission.index') }}"
                                    class="nav-link {{ Helper::isActive(['permission.*']) }} ">
                                    <i class='fa fa-key f-18 px-1'></i>
                                    <p class="align-middle">
                                        Permission
                                    </p>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>

                @if (auth('admin')->check() &&
                    auth('admin')->user()->can('Categories'))
                    <li class="nav-item ">
                        <a href="{{ route('admin.category.index') }}"
                            class="nav-link {{ Helper::isActive(['category.*']) }}">
                            <i class="nav-icon align-middle fas m-1 fa-clipboard-list"></i>
                            <p>
                                Categories
                            </p>
                        </a>
                    </li>
                @endif

                @if (auth('admin')->check() &&
                    auth('admin')->user()->can('SubCategories'))
                    <li class="nav-item ">
                        <a href="{{ route('admin.sub-category.index') }}"
                            class="nav-link {{ Helper::isActive(['sub-category.*']) }}">
                            <i class="nav-icon align-middle fas m-1 fa fa-list-alt"></i>
                            <p>
                                Sub Categories
                            </p>
                        </a>
                    </li>
                @endif

                @if (auth('admin')->check() &&
                    auth('admin')->user()->can('Contact'))
                    <li class="nav-item">
                        <a href="{{ route('admin.contact.index') }}"
                            class="nav-link {{ Helper::isActive(['contact.*']) }}">
                            <i class="nav-icon align-middle fas fa fa-megaphone"></i>
                            <p>
                                Contact
                            </p>
                        </a>
                    </li>
                @endif

                @if (auth('admin')->check() &&
                    auth('admin')->user()->can('Newsletter'))
                    <li class="nav-item ">
                        <a href="{{ route('admin.newsletter.index') }}"
                            class="nav-link {{ Helper::isActive(['newsletter.*']) }}">
                            <i class="nav-icon align-middle fas fa m-1 fa-envelope"></i>
                            <p>
                                Newsletter
                            </p>
                        </a>
                    </li>
                @endif
                @if (auth('admin')->check() &&
                    auth('admin')->user()->can('Settings'))
                    <li class="nav-item">
                        <a href="{{ route('admin.website-setting') }}"
                            class="nav-link {{ Helper::isActive(['website-setting', 'website-setting.*', 'settings.*', 'smtp.*']) }}">
                            <i class="nav-icon align-middle m-1 fa fa-cog f-18 px-1"></i>
                            <p class="align-middle">
                                Setting
                            </p>
                        </a>
                    </li>
                @endif
                {{-- @if (config('log-viewer.show')) --}}
                <li
                    class="nav-item has-treeview {{ Helper::isActive(['log-viewer::dashboard', 'log-viewer::logs.list*'], 'menu-open') }} ">
                    <a href="pages/widgets.html"
                        class="nav-link  {{ Helper::isActive(['log-viewer::dashboard', 'log-viewer::logs.list*']) }}">
                        <i class="nav-icon fa fa-fw fa-list f-18  px-1"></i>
                        <p> Log viewer <i class="right fa fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('log-viewer::dashboard') }}"
                                class="nav-link {{ Helper::isActive(['log-viewer::dashboard']) }} ">
                                <i class='fa fa-tachometer-alt f-18 px-1'></i>
                                <p class="align-middle">
                                    @lang('Dashboard')
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('log-viewer::logs.list') }}"
                                class="nav-link {{ Helper::isActive(['log-viewer::logs.list']) }} ">
                                <i class="fa fa-layer-group f-18 px-1"></i>
                                <p class="align-middle">
                                    @lang('Logs')
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- @endif --}}
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
