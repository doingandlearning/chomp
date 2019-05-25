<!DOCTYPE html>
<html>
<head>
  <title>Chomp Sign-up</title>
  <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body>
<div class="w-full sm:w-2/3  mx-auto bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 mt-6w-full sm:w-2/3  mx-auto bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 mt-6">
  <div class="flex justify-center mx-auto pb-6">
    <div class="mr-12 p-4 bg-aqua-lightest shadow-md rounded">
      <p>{{ $family->contact_name }} ({{ $family->contact_number }})</p>
      <p>Kids:
        @foreach($children as $child)
          @if($loop->last)
            {{ $child->name }}
          @else
            {{ $child->name }},
          @endif
        @endforeach
      </p>
    </div>
  </div>
  <div>
    <h2>Which sessions?</h2>

    @forelse ($sessions as $venue=>$sessions)
      @if($loop->first)
        <form action="/select-session" method="POST">
          <input type="hidden" name="family" value="{{$family->id}}">
          @endif
          @csrf
          <div class="pt-5">
            <h3>Venue name: {{ $venue }}</h3>
            @foreach ($sessions as $session)
              <div class="py-2 flex">
                <input type="checkbox" style="px-2" id="{{$session->id}}" name="{{$session->id}}">
                <label for="{{$session->id}}" class="px-2 self-center">{{ date('d M', strtotime($session->date))}}</label>
              </div>
            @endforeach
          </div>
          @if($loop->last)
            <div class="mx-auto w-32">
              <button type="submit" class="bg-blue hover:bg-blue-dark text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Select</button>
            </div>
        </form>
      @endif
    @empty
      <div>
        <p>We don't have any open sessions at the moment.</p>
      </div>

    @endforelse
  </div>
</div>
</body>
</html>