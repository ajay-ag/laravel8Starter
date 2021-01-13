<x-app :title="$title">
  <x-slot name="style">
    <style type="text/css">
      .btn.btn-primary {
        height: 36px !important;
        width: 46px !important;
      }

      .page-header .page-header-title i {
        float: left;
        width: 40px;
        height: 40px;
        border-radius: 5px;
        margin-right: 15px;
        vertical-align: middle;
        font-size: 22px;
        color: #fff;
        display: inline-flex;
        -webkit-justify-content: center;
        -moz-justify-content: center;
        -ms-justify-content: center;
        justify-content: center;
        -ms-flex-pack: center;
        -webkit-align-items: center;
        -moz-align-items: center;
        -ms-align-items: center;
        align-items: center;
        -webkit-box-shadow: 0 2px 12px -3px rgba(0, 0, 0, 0.5);
        -moz-box-shadow: 0 2px 12px -3px rgba(0, 0, 0, 0.5);
        box-shadow: 0 2px 12px -3px rgba(0, 0, 0, 0.5);
      }

      .settings li {
        font-size: 18px;
        font-weight: 400;
      }

      .settings li i {
        padding-right: 15px;
      }

    </style>
  </x-slot>
  <x-admin.UI.page-header :title="$title" />
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="align-items-center col-sm-12 col-md-4 d-flex py-3">
              <a href="{{ route('admin.settings.index') }}" role="button" type="button"
                class="btn btn-primary shdow mr-3 shadow">
                <i class="fa fa-cogs"></i>
              </a>
              <span class="text-muted">
                <a href="{{ route('admin.settings.index') }}">
                  <h6 class="text-capitalize mb-1"><b> Genaral setting </b></h6>
                </a>
                {{-- Here you can config site name,email, address etc...
                --}}
              </span>
            </div>
            <div class="align-items-center col-sm-12 col-md-4 d-flex py-3">
              <a href="{{ route('admin.smtp.index') }}" role="button" type="button"
                class="btn btn-primary shdow mr-3 shadow">
                <i class="fa fa-at"></i>
              </a>
              <span class="text-muted">
                <a href="{{ route('admin.smtp.index') }}">
                  <h6 class="text-capitalize mb-1"><b> SMTP Configuration </b></h6>
                </a>
                {{-- Here you can configure your smtp details that will use to send a
                email... --}}
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app>
