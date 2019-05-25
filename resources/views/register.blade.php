@extends('layout.layout')

@section('content')
  <div class="flex justify-between">
    <div>
      <h2>Venue Details</h2>
      <p>{{ $venue->name }}</p>
    </div>
    <div>
      <h2>Session Details</h2>
      <p>{{ $date }}</p>

    </div>
  </div>
  <div class="mt-8">
    @foreach ($families as $family)
      <div class="flex rounded my-4 py-3 justify-between bg-green-light" method="POST" action="/register">
        <div class="sm:px-4">
          <input type="hidden" value="{{ $family['id'] }}" />
          <input type="hidden" value="{{ $id }}" />
          <h3 class="pb-4">{{ $family['contact_name'] }} ({{$family['contact_number']}})</h3>
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
                 class="checkbox_click align-self"
              {{ $family['attending'] ? "checked" : "" }}>
        </div>
      </div>
    @endforeach
  </div>

@include('layout.partials.footer-scripts')

  <script>
    $(document).ready(function() {
      $('.checkbox_click').click(function(){
        let checkbox = $(this);
        const session_id = $(this).attr("session_id");
        const family_id = $(this).attr("family_id");
        $.ajax({
          url: '/register',
          type: 'POST',
          dataType: 'json', // type of response data
          timeout: 500,     // timeout milliseconds
          data: {session: session_id, family: family_id, _token: "{{ csrf_token() }}"},
          success: function (data, status, xhr) {// success callback function
          },
          error: function (jqXhr, textStatus, errorMessage) { // error callback
            alert('Error: ' + errorMessage);
          }
        });
      });
    });
  </script>
@endsection