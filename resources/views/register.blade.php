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
    <fieldset>
    @foreach ($families as $family)
      <div class="flex rounded my-4 py-3 justify-between bg-green-light" method="POST" action="/register">
        <div class="sm:px-4">
          <div class="flex md:pr-8">
            <input type="checkbox" class="adult_click align-self"
                   session_id="{{ $id }}"
                   person_id="{{ $family['primary_adult']['id'] }}"
                {{ $family['primary_adult']['attending']  ?  "checked='checked'" : "" }}
            ><label><span class="pb-4 font-weight-bolder text-lg underline">{{ $family['primary_adult']['name'] }} ({{$family['contact_number']}})</span></label>
          </div>

          <p>
            @foreach ($family['children'] as $child)
            <div class="flex md:pr-8">
              <input type="checkbox" class="child_click align-self"
                     session_id="{{ $id }}"
                 person_id="{{ $child['id'] }}"
                  {{ $child['attending']  ?  "checked='checked'" : "" }}
              ><label>{{ $child['name'] }} ({{ $child['age'] }})</label>
            </div>
            @endforeach
          </p>
        </div>
        <div class="flex md:pr-8">
          <input type="checkbox"
                 class="family_click align-self hidden"
              {{ $family['attending']  ?  "checked='checked'" : "" }}
          >
        </div>
      </div>
    @endforeach
    </fieldset>
  </div>

@include('layout.partials.footer-scripts')

  <script>
    function trigger_attendance_update(element) {
      if (element[0].classList.contains("family_click")) {
       return
      }

      let checkbox = $(this);
      checkbox.css('display', 'none');
      const session_id = element.attr("session_id");
      const person_id = element.attr("person_id");
      let child = false;
      let adult = false;

      if (element[0].classList.contains("adult_click")) {
        adult = true;
      }

      else {
        child = true;
      }

      $.ajax({
        url: '/register',
        type: 'POST',
        dataType: 'json', // type of response data
        timeout: 1500,     // timeout milliseconds
        data: {
          session_id: session_id,
          person_id: person_id,
          child: child,
          adult: adult,
          _token: "{{ csrf_token() }}"},
        success: function (data, status, xhr) {// success callback function
          checkbox.css('display', 'unset');
        },
        error: function (jqXhr, textStatus, errorMessage) { // error callback
          alert('Error: ' + errorMessage);
        }
      });

    }

    function update_adult_attendance(element) {

      const family_id = $(this).attr("family_id");

    }

    $(document).ready(function() {
      $('.family_click').click(function(){
        $(this).css('visibility', 'hidden');
        if($(this).prop('checked')) {
          $(this).closest('fieldset').find('input').prop('checked',true).each(function(e) {
            trigger_attendance_update($(this));
          });
        }
        else {
          $(this).closest('fieldset').find('input').prop('checked',false).each(function(e) {
            trigger_attendance_update($(this));
          });
        }
      });



      $('.adult_click').change(function(){
        $(this).closest('fieldset').find('.family_click').css('visibility','hidden');
        trigger_attendance_update($(this));
      });


      $('.child_click').click(function() {
        $(this).closest('fieldset').find('.family_click').css('visibility','hidden');
        trigger_attendance_update($(this));
      });
    });
  </script>
@endsection