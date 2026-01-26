@props(['type' => 'info'])

@php
  $classes = match ($type) {
    'success' => 'alert alert-success',
    'error' => 'alert alert-error',
    'warning' => 'alert alert-warning',
    default => 'alert alert-info',
  };
@endphp

<div {{ $attributes->merge(['class' => $classes . ' fade-in']) }}>
    {{ $slot }}
</div>
