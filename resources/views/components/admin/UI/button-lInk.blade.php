<a {{ $attributes->merge(['class' => 'btn rounded btn-sm btn-primary']) }}>
  @if ($icon)
    <i class="{{ $icon }}"></i>
  @endif
  {{ strtoupper($slot) }}
</a>
