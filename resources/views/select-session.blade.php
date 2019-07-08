  @extends('layout.layout', ['title' => 'Select Sessions'])

  @section('content')
    <div class="p-4 mb- text-lg">
    <heading>
      Great! Here are the details, click the button if you need to change them.
    </heading>
    </div>
    <div class="md:flex justify-center mx-auto pb-6">
      <div class="mr-12 flex flex-row flex-wrap p-4 bg-blue-200 shadow-md rounded">
        <p>Main contact: {{ $adult }} ({{ $family->contact_number }})</p>
        @if (!empty($additional_adults))
         <p>Additional adults:
            @foreach ($additional_adults as $adult)
              @if($loop->last)
                {{ $adult }}
              @else
                {{ $adult }},
              @endif
            @endforeach
          </p>

        @endif

        <p>Kids:
          @foreach($children as $child)
            @if($loop->last)
              {{ $child->name }} ({{$child->age()}})
            @else
              {{ $child->name }} ({{ $child->age() }}),
            @endif
          @endforeach
        </p>
        <a href="{{ route('signup.edit',$family->id)}}">
        <button
            class="mt-8 bg-orange-400 hover:bg-orange-dark text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline text-decoration-none"
            >
          Update details
        </button>
        </a>
      </div>
    </div>
    <div>
      <h2 class="text-2xl">Which sessions would you like to attend?</h2>

      @forelse ($sessions as $venue=>$sessions)
        @if($loop->first)
          <form action="/select-session" method="POST">
            <input type="hidden" name="family" value="{{$family->id}}">
            @endif
            @csrf
            <div class="pt-5 bg-blue-200 my-4">
              <h3 class="px-4 text-lg">Venue name: {{ $venue }}</h3>
              <div class="flex-wrap sm:flex">
                @foreach ($sessions as $session)

                  <div class="py-2 flex w-1/3">

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