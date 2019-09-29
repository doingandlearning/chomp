@php
  $value = data_get($entry, $column['name']);
@endphp

@isset ($value)
  <a href="{{ url($value) }}" download>
    {{ $column['label'] }}
  </a>
@else
  <span>No risk assessment</span>

@endisset
