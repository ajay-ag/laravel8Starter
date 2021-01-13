<x-authlayout title="Reset Password">
  <div class="container vh-100">
    <div class="row justify-content-center align-items-center h-100">
      <div class="col-md-5">
        <x-card>
          <h5 class="text-left">{{ __('Reset Password') }}</h5>
          <hr>
          <form method="POST" action="{{ route('admin.password.request') }}" aria-label="{{ __('Reset Password') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="form-group row">
              <div class="col-md-12">
                <label for="email" class="col-form-label mx-2 text-md-right">{{ __('E-Mail Address') }}</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                  value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>

            <div class="form-group row">
              <div class="col-md-12">
                <label for="password" class="col-form-label text-md-right">{{ __('Password') }}</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                  name="password" required autocomplete="new-password">
                @error('password')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>

            <div class="form-group row">
              <div class="col-md-12">
                <label for="password-confirm" class="col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
                  autocomplete="new-password">
              </div>
            </div>

            <div class="form-group row mb-0">
              <div class="col-md-12">
                <x-button type="submit" class="btn-primary">
                  {{ __('Reset Password') }}
                </x-button>
              </div>
            </div>
          </form>
        </x-card>
      </div>
    </div>
  </div>
</x-authlayout>
