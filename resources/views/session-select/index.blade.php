  @extends('layout.layout', ['title' => 'Select Sessions'])

  @section('content')
  <div class="max-w-sm w-full lg:max-w-full lg:flex">
  <div class="h-48 lg:h-auto lg:w-48 flex-none bg-cover rounded-t lg:rounded-t-none lg:rounded-l text-center overflow-hidden" style="background-image: url('/img/card-left.jpg')" title="Woman holding a mug">
  </div>
  <div class="border border-gray-400 lg:border-l lg:border-t lg:border-gray-400 bg-white rounded-b lg:rounded-b-none lg:rounded-r p-4 flex flex-col justify-between leading-normal">
    <div class="mb-8">
      <p class="text-sm text-gray-600 flex items-center">
      Great! Here are the details, click the button if you need to change them.
      </p>
      <div class="text-gray-900 font-bold text-xl mb-2">Main contact: {{ $adult }} ({{ $family->contact_number }})</div>
      @if (!empty($additional_adults))
          <div>
         <p class="text-gray-700 text-base">Additional adults:
            @foreach ($additional_adults as $adult)
              @if($loop->last)
              {{ $adult }}  
              @else
              {{ $adult }},
              @endif
            @endforeach
          </p>
          
          <p class="text-gray-800 text-base border-t border-gray-500">Kids:
          @foreach($children as $child)
            @if($loop->last)
              <div class="text-gray-700 text-base">
              {{ $child->name }} ({{$child->age()}}) {{ $child->special_requirements }}
              </div>
            @else
              <div class="text-gray-700 text-base">
              {{ $child->name }} ({{ $child->age() }}) {{ $child->special_requirements }},
              </div>
            @endif
          @endforeach
        </p>
          </div>
        @endif
        <a href="{{ route('signup.edit',$family->id)}}">
        <button
            class="mt-8 bg-orange-400 hover:bg-orange-dark text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline text-decoration-none"
            >
          Update details
        </button>
        </a>
    </div>
    <div class="flex items-center">
      <div class="text-sm">

      </div>
    </div>
  </div>
</div>
    
    <div>
      <h2 class="text-2xl my-4">Which sessions would you like to attend?</h2>

      @forelse ($sessions as $venue=>$sessions)
        @if($loop->first)
          <form action="/select-session" method="POST">
            <input type="hidden" name="family" value="{{$family->id}}">
            @endif
            @csrf
            <div class="p-8 bg-blue-200 my-4">
              <h3 class="px-4 pb-4 text-lg">Venue name: {{ $venue }}</h3>
              <div class="flex-wrap sm:flex">
                @foreach ($sessions as $session)

                  <div class="py-2 flex w-1/3 px-5">

                    <input type="checkbox"
                           class="px-2"
                           id="{{$session->id}}"
                           name="{{$session->id}}"
                    @isset($attendance)
                      {{ $attendance[$session->id] === false ? "" : "checked" }}
                        @endisset
                    >
                    <label for="{{$session->id}}" class="px-2 self-center">{{ date('l jS F', strtotime($session->date))}}</label>
                  </div>
                @endforeach
              </div>

            </div>
            @if($loop->last)
              <div class="mx-auto w-32">
                <button type="submit" class="bg-blue-900 mt-8 hover:bg-blue-dark text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Select</button>
              </div>
          </form>
        @endif
      @empty
        <div>
          <p>We don't have any open sessions at the moment.</p>
        </div>

      @endforelse
    </div>
  @endsection