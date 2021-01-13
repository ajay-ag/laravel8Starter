<x-authlayout title="Verify Email">
  <div class="container  vh-100">
    <div class="row h-100 justify-content-center align-items-center">
      <div class="col-md-8">
        <x-card>
          <h5>{{ __('Verify Your Email Address') }}</h5>
          <hr>
          @if (session('resent'))
            <div class="alert alert-success" role="alert">
              {{ __('A fresh verification link has been sent to your email address.') }}
            </div>
          @endif
          <p>
            {{ __('Before proceeding, please check your email for a verification link.') }}
            {{ __('If you did not receive the email') }},
          </p>

          <form class="d-inline " method="POST" action="{{ route('admin.verification.resend') }}">
            @csrf
            <x-button type="submit">
              {{ __('click here to request another') }}
            </x-button>
          </form>
        </x-card>
      </div>
    </div>
  </div>
</x-authlayout>
