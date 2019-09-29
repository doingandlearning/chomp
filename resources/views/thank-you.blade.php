<!DOCTYPE html>
<html>
<head>
  <title>Chomp Sign-up</title>
  <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body>

<div class="flex my-10">
    <div class="bg-white w-1/2 m-auto border-1  border-dashed border-gray-100 shadow-md rounded-lg overflow-hidden">
      
      <div class="p-4">
        <p class="mb-1 text-gray-900 font-semibold">That's great!</p>

        <span class="text-gray-700">We're looking forward to seeing you, {{ $family->contact_name }}.</span>
        <p class="pb-2">The sessions you have signed up for are:</p>
  <ul>
    @foreach ($sessions as $venue => $dates)
      @foreach ($dates as $date)
      <li class="pb-2">{{ date('d M', strtotime($date))}} at {{ $venue }}</li>
        @endforeach
    @endforeach
  </ul>
  <p>If you have any questions, feel free to get in touch at <a href="mailto:chomp@onechurchbrighton.org">chomp@onechurchbrighton.org</a></p>

      </div>
    </div>
  </div>

</body>
</html>