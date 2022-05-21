<nav class="main-header navbar navbar-expand navbar-white border-bottom bg-white">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link p-1" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars" style="font-size: 30px;"></i></a>
    </li>
  </ul>
  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <!-- Notifications Dropdown Menu -->
    <li class="nav-item dropdown ">
      <a class="nav-link py-0" data-toggle="dropdown" href="#" aria-expanded="false">
        <img src="{{ $adminUser->profile_src ?? '' }}" id="image" style="width:35px;" class="user-image  img-circle elevation-2"
          alt="User Image">
        <span class="d-none d-md-inline">{{ $adminUser->first_name ?? '' }}</span>
      </a>
      <div class="dropdown-menu dropdown-menu-right mt-2">
        <a href="{{ route('admin.profile.index') }}" class="dropdown-item text-gray">
          <i class="fa fa-user f-18 pr-1"></i> Profile
        </a>
        <a href="{{ route('admin.logout') }}" class="dropdown-item text-gray">
          <i class="fa fa-power-off f-18 pr-1"></i> Logout
        </a>
      </div>
    </li>
  </ul>
</nav>
