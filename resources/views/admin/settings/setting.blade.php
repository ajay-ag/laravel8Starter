<x-app title="Dashboard">

  <x-slot name="style">
    <style type="text/css">
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


  <div class="row ">

    @include('admin.settings.sidebar',[
    'heading' => 'Setting',
    'description' => 'Here you can define all the information about tour site '
    ])

    <div class="col-sm-12 col-md-8 mb-5">
      <form action="{{ route('admin.settings.store') }}" id="settingsForm" enctype="multipart/form-data" method="post">
        @csrf
        <x-card>
          <div class="row ">
            <div class="col-sm-12">
              <div class="form-group">
                <label for="store_name">Store name <span class="text-danger">*</span> </label>
                <input required id="store_name" value="{{ $setting->response->store_name ?? '' }}" class="form-control"
                  type="text" name="store_name">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label for="email">Email <span class="text-danger">*</span></label>
                <input required id="email" class="form-control" value="{{ $setting->response->email ?? '' }}"
                  type="text" name="email">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label for="contact">Contact Us <span class="text-danger">*</span></label>
                <input required id="contact" value="{{ $setting->response->contact ?? '' }}" class="form-control"
                  type="text" name="contact">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label for="country">Country <span class="text-danger">*</span></label>
                <input required id="country" value="{{ $setting->response->country ?? '' }}" class="form-control"
                  type="text" name="country">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label for="state">State <span class="text-danger">*</span></label>
                <input required id="state" value="{{ $setting->response->state ?? '' }}" class="form-control"
                  type="text" name="state">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label for="city">City <span class="text-danger">*</span></label>
                <input required id="city" value="{{ $setting->response->city ?? '' }}" class="form-control" type="text"
                  name="city">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label for="postal_code">Postal code <span class="text-danger">*</span></label>
                <input required id="postal_code" value="{{ $setting->response->postal_code ?? '' }}"
                  class="form-control" type="text" name="postal_code">
              </div>
            </div>
            <div class="col-sm-12">
              <div class="form-group">
                <label for="address">Address</label>
                <textarea class="form-control" name="address" id="address"
                  rows="4">{{ $setting->response->address ?? '' }}</textarea>
              </div>
            </div>
            <div class="col-sm-12">
              <div class="form-group">
                <label for="copyrights">Copyright <span class="text-danger">*</span></label>
                <input required id="copyrights" value="{{ $setting->response->copyrights ?? '' }}" class="form-control"
                  type="text" name="copyrights">
              </div>
            </div>
          </div>
          <hr>
          <div class="row">

            <div class="col-sm-12 col-md-2 clearfix ">
              <x-admin.UI.imagepriview height="100px" label='Logo' name='logo' id='logo'
                priview='{{ $setting->logo ?? null }}' />
            </div>
            <div class="col-sm-12 col-md-2 clearfix ">
              <x-admin.UI.imagepriview height="100px" label='Favicon' name='favicon' id='favicon'
                priview='{{ $setting->favicon ?? null }}' />
            </div>
          </div>
          <hr style="margin: 15px -20px">
          <div class="row">
            <h5 class="pl-2 mb-3">Social Link</h5>
            <br>
            <div class="col-12  ">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="fab fa-facebook-square"></i>
                  </span>
                </div>
                <input class="form-control" type="text" name="facebook" value="{{ $setting->response->facebook ?? '' }}"
                  placeholder="Recipient's text" aria-label="Recipient's ">
              </div>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="fab fa-instagram"></i>
                  </span>
                </div>
                <input class="form-control" value="{{ $setting->response->instagram ?? '' }}" type="text"
                  name="instagram" placeholder="Recipient's text" aria-label="Recipient's ">
              </div>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="fab fa-whatsapp"></i>
                  </span>
                </div>
                <input class="form-control" type="text" name="whatsapp" value="{{ $setting->response->whatsapp ?? '' }}"
                  placeholder="Recipient's text" aria-label="Recipient's ">
              </div>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="fab fa-linkedin-in"></i>
                  </span>
                </div>
                <input class="form-control" type="text" value="{{ $setting->response->linkedin ?? '' }}" name="linkedin"
                  placeholder="Recipient's text" aria-label="Recipient's ">
              </div>

            </div>
          </div>
          <hr style="margin: 15px -20px">
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="offertext">Offer Slide</label>
                <textarea id="offertext" class="form-control" name="offertext"
                  rows="3">{!!  $setting->response->offertext ?? '' !!}</textarea>
                <span class="text-sm">Seprate with ## </span>
              </div>
            </div>
          </div>
        </x-card>
        <x-button type="submit" class="btn-primary float-right">
          Save
        </x-button>
      </form>
    </div>

  </div>
  <x-slot name="javascript">

    <script>
      $(document).ready(function() {

        $('#settingsForm').validate({
          debug: false,
          ignore: '.select2-search__field,:hidden:not("textarea,.files,select")',
          errorPlacement: function(error, element) {
            error.appendTo(element.parent()).addClass('text-danger');
          }
        });

        $('.shipping-charge').on('change', function() {
          var el = $(this);
          var target = $(el.data('target'));
          target.parent().children().addClass('hidden');
          target.removeClass('hidden');
        });;
      });

    </script>
  </x-slot>
</x-app>
