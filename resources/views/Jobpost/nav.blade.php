<header class="header_menu">
  <div class="main_menu">
    <nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
        <div class="container">
            <a class="navbar-brand" href="#"><h1 class="display-4">Open Source Job Portal</h1></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
              <div class="navbar-nav ml-auto">
                <a class="{{ request()->is('/') ? 'nav-item nav-link active' : 'nav-item nav-link'}}" href="{{URL('/')}}">Home</a>
                <a class="{{ request()->is('job-form') ? 'nav-item nav-link active' : 'nav-item nav-link'}}" href="{{route('form.create')}}">Post A Job</a>
              </div>
            </div>
        </div>
    </nav>
  </div>
</header>