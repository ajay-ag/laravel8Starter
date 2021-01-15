<div class="card">
  @if (isset($header))
    <div class="card-header">
      <h5 class="card-title">{{ $header }}</h5>
    </div>
  @endif
  <div class="card-body {{ $padding }}">
    {{ $slot }}
  </div>
</div>
