<!DOCTYPE html>
<html>
<head>
  <title>Chomp Sign-up</title>
  <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body>
<div class="w-full sm:w-2/3  mx-auto bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 mt-6">
<h2 class="pb-3">That's great!</h2>
  <p class="pb-2">We're looking forward to seeing you, {{ $family->contact_name }}.</p>

  <p class="pb-2">The sessions you have signed up for are:</p>
  <ul>
    @foreach ($sessions as $venue => $dates)
      @foreach ($dates as $date)
      <li class="pb-2">{{ date('d M', strtotime($date))}} at {{ $venue }}</li>
        @endforeach
    @endforeach
  </ul>

  <p>If you have any questions, feel free to get in touch at chomp@onechurchbrighton.org</p>
</div>
</body>
</html>