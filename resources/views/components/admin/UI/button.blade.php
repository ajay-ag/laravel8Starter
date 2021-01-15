<button {{ $attributes->merge(['type' => 'button', 'class' => 'btn rounded btn-sm']) }}>
  {{ strtoupper($slot) }}
</button>
