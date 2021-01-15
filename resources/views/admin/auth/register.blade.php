<x-authlayout title="Register">
  <div class="container vh-100">
    <div class="row h-100 justify-content-center align-items-center">
      <div class="col-lg-6 col-md-8">
        <x-card>
          <h5 class="text-left">{{ __('Register') }}</h5>
          <hr>
          <form method="POST" action="{{ route('admin.register') }}">
            @csrf
            <div class="form-group row">
              <div class="col-md-6">
                <label for="name" class="col-form-label text-md-right">{{ __('Name') }}</label>
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                  value="{{ old('name') }}" required autocomplete="name" autofocus>
                @error('name')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
              <div class="col-md-6">
                <label for="email" class=" col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                  value="{{ old('email') }}" required autocomplete="email">

                @error('email')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>
            <div class="form-group row">
              <div class="col-md-6">
                <label for="password" class="col-form-label text-md-right">{{ __('Password') }}</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                  name="password" required autocomplete="new-password">
                @error('password')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
              <div class="col-md-6">
                <label for="password-confirm" class="col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
                  autocomplete="new-password">
              </div>
            </div>
            <div class="form-group row mb-0">
              <div class="col-md-12">
                <x-button type="submit" class="btn-primary">
                  {{ __('Register') }}
                </x-button>
              </div>
            </div>
          </form>
        </x-card>
      </div>
    </div>
  </div>
</x-authlayout>
