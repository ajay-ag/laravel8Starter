<x-authlayout title="Reset Password">
  <div class="container vh-100">
    <div class="row h-100 justify-content-center align-items-center">
      <div class="col-md-4">
        <x-card>
          <h5 class="text-left">{{ __('Reset Password') }}</h5>
          <hr>
          @if (session('status'))
            <div class="alert alert-success" role="alert">
              {{ session('status') }}
            </div>
          @endif
          <form method="POST" action="{{ route('admin.password.email') }}" aria-label="{{ __('Reset Password') }}">
            @csrf

            <div class="form-group row">

              <div class="col-md-12">
                <label for="email" class="col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                  value="{{ old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>

            <div class="form-group row mb-0">
              <div class="col-md-12">
                <x-button type="submit" class="btn-primary">
                  {{ __('Send Password Reset Link') }}
                </x-button>
              </div>
              <div class="col-md-12 mt-4  text-center ">
                <a class="btn-link text-gray-500" href="{{ route('admin.login') }}">
                  {{ __('BACK TO LOGIN') }}
                </a>
              </div>
            </div>
          </form>
        </x-card>
      </div>
    </div>
  </div>
</x-authlayout>
