{{-- localized date using nesbot carbon --}}
@php
  $value = data_get($entry, $column['name']);
@endphp

<span data-order="{{ $value }}">
    @if (!empty($value))
    <a href="{{url($column['href']) . '/' . $entry['id']}}">
    {{
      \Carbon\Carbon::parse($value)
      ->locale(App::getLocale())
      ->isoFormat($column['format'] ?? config('backpack.base.default_date_format'))
    }}
    </a>
  @endif
</span>