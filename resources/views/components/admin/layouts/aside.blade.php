<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item ">
                    <a href="{{ route('admin.home') }}" class="nav-link {{ Helper::isActive(['home']) }}">
                        <i class="nav-icon align-middle  fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a href="{{ route('admin.category.index') }}"
                        class="nav-link {{ Helper::isActive(['category.*']) }}">
                        <i class="nav-icon align-middle fas fa-clipboard-list"></i>
                        <p>
                            categories
                        </p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a href="{{ route('admin.sub-category.index') }}"
                        class="nav-link {{ Helper::isActive(['sub-category.*']) }}">
                        <i class="nav-icon align-middle fas fa-clipboard-list"></i>
                        <p>
                            Sub Categories
                        </p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a href="{{ route('admin.contact.index') }}"
                        class="nav-link {{ Helper::isActive(['sub-category.*']) }}">
                        <i class="nav-icon align-middle fas fa fa-megaphone"></i>
                        <p>
                            Contact
                        </p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a href="{{ route('admin.newsletter.index') }}"
                        class="nav-link {{ Helper::isActive(['sub-category.*']) }}">
                        <i class="nav-icon align-middle fas fa fa-envelope"></i>
                        <p>
                            Newsletter
                        </p>
                    </a>
                </li>
                <li
                    class="nav-item has-treeview {{ Helper::isActive(['user.*', 'role.*', 'permission.*'], 'menu-open') }} ">
                    <a href="pages/widgets.html"
                        class="nav-link  {{ Helper::isActive(['user.*', 'role.*', 'permission.*']) }}">
                        <i class="nav-icon align-middle  fa fa-user f-18  px-1"></i>
                        <p> User setting <i class="right fa fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview  ">
                        <li class="nav-item">
                            <a href="{{ route('admin.user.index') }}"
                                class="nav-link {{ Helper::isActive(['user.*']) }}">
                                <i class='fa fa-user f-18 px-1'></i>
                                <p class="align-middle">
                                    Users
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.role.index') }}"
                                class="nav-link {{ Helper::isActive(['role.*']) }}">
                                <i class="fa fa-user-shield f-18 px-1"></i>
                                <p class="align-middle">
                                    Role
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.permission.index') }}"
                                class="nav-link {{ Helper::isActive(['permission.*']) }} ">
                                <i class='fa fa-key f-18 px-1'></i>
                                <p class="align-middle">
                                    Permission
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.website-setting') }}"
                        class="nav-link {{ Helper::isActive(['website-setting', 'website-setting.*', 'settings.*', 'smtp.*']) }}">
                        <i class="nav-icon align-middle  fa fa-cog f-18 px-1"></i>
                        <p class="align-middle">
                            Setting
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="pages/widgets.html"
                        class="nav-link  {{ Helper::isActive(['log-viewer::dashboard', 'log-viewer::logs.list']) }}">
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
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
