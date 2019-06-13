@extends('layout.layout', ['title' => 'Registration'])

@section('content')
  <div class="flex justify-between">
    <div>
      <h2 class="text-2xl">Venue Details</h2>
      <p>{{ $venue->name }}</p>
      @if(! $venue->risk_assessment == null)
      <p class="pt-4"><a class="text-green-800" href="{{ url($venue->risk_assessment) }}" download>Risk Assessment</a></p>
        @endif
    </div>
    <div>
      <h2 class="text-2xl">Session Details</h2>
      <p>{{ date('l d F', strtotime($date))}}</p>
      @if (! $leader == null)
      <p class="font-weight-bold pt-4">Leader: {{ $leader['contact_name'] }}</p>
      <p>({{ $leader['contact_number'] }})</p>
        @endif
    </div>
  </div>
  <div class="mt-8">
    @foreach ($families as $family)
      <div class="flex rounded my-4 py-3 justify-between bg-green-light" method="POST" action="/register">
        <div class="sm:px-4">
          <input type="hidden" value="{{ $family['id'] }}" />
          <input type="hidden" value="{{ $id }}" />
          <h3 class="pb-4">{{ $family['primary_adult']['name'] }} ({{$family['contact_number']}})</h3>
          <p>
            @foreach ($family['children'] as $child)
              {{ $child['name'] }} ({{ $child['age'] }})
            @endforeach
          </p>
        </div>
        <div class="flex md:pr-8">
          <input type="checkbox"
                 session_id="{{ $id }}"
                 family_id="{{ $family['id'] }}"
                 class="family_click align-self"
              {{ $family['attending'] ? "checked" : "" }}>
        </div>
      </div>
    @endforeach
  </div>

@include('layout.partials.footer-scripts')

  <script>
    $(document).ready(function() {
      $('.family_click').click(function(){
        let checkbox = $(this);
        checkbox.css('display', 'none');
        const session_id = $(this).attr("session_id");
        const family_id = $(this).attr("family_id");
        $.ajax({
          url: '/register',
          type: 'POST',
          dataType: 'json', // type of response data
          timeout: 500,     // timeout milliseconds
          data: {session: session_id, family: family_id, _token: "{{ csrf_token() }}"},
          success: function (data, status, xhr) {// success callback function
            checkbox.css('display', 'unset');
          },
          error: function (jqXhr, textStatus, errorMessage) { // error callback
            alert('Error: ' + errorMessage);
          }
        });
      });
    });
  </script>
@endsection