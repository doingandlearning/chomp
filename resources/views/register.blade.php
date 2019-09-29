@extends('layout.layout', ['title' => 'Registration'])

@section('content')
  <div class="flex justify-between">
    <div>
      <h2 class="text-2xl">Venue Details</h2>
      <p>{{ $venue->name }}</p>
      <p>{{ $venue->contact_name }}</p>
      <p>{{ $venue->contact_number }}</p>
      @if(! $venue->risk_assessment == null)
      <p class="pt-4"><a class="text-green-800" href="{{ url($venue->risk_assessment) }}" download>Risk Assessment</a></p>
        @endif
    </div>
    <div>
      <h2 class="text-2xl">Session Details</h2>
      <p>{{ date('l d F @ H:i A', strtotime($date))}}</p>
      @if (! $leader == null)
      <p class="font-weight-bold pt-4">Leader: {{ $leader['contact_name'] }}</p>
      <p>({{ $leader['contact_number'] }})</p>
        @endif
    </div>
  </div>
  <div class="mt-8 flex  justify-between ">
  <table class="table w-full">
    <tr class="table-row">
      <th class="table-cell border border-2 bg-gray-200">Who?</th>
      <th class="table-cell border border-2 bg-gray-200">Signed Up</th>
      <th class="table-cell border border-2 bg-gray-200">Attending</th>
    </tr>
    <tr class="table-row">
      <th class="table-cell border border-2 bg-gray-200">Children</th>
      <th class="table-cell border border-2">{{ $session['number_of_children'] }}</th>
      <th class="table-cell border border-2">{{ $session['number_of_children_attending'] }}</th>
    </tr>
    <tr class="table-row">
      <th class="table-cell border border-2 bg-gray-200">Adults</th>
      <th class="table-cell border border-2">{{ $session['number_of_adults'] }}</th>
      <th class="table-cell border border-2">{{ $session['number_of_adults_attending'] }}</th>
    </tr>
    <tr class="table-row">
      <th class="table-cell border border-2 bg-gray-200">Total</th>
      <th class="table-cell border border-2">{{ $session['number_of_adults'] + $session['number_of_children'] }}</th>
      <th class="table-cell border border-2">{{ $session['number_of_adults_attending'] + $session['number_of_children_attending']}}</th>
    </tr>
  </table>
  </div>
  <form class="flex flex-col my-8" action="/sessionnotes" method="post">
    @csrf
    <textarea name="notes" value="" id="" rows="10" class="border border-black-400 mb-3">{{$session['notes']}}</textarea>
    <input type="hidden" name="id" value="{{$id}}">
    <button type="submit" class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded">Update notes</button>
  </form>

  <div class="mt-8">
    <fieldset>
    @foreach ($families as $family)
      <div class="flex bg-green-200 rounded my-4 py-3 justify-between bg-green-light" method="POST" action="/register">
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


@endsection