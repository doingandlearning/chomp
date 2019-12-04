@extends('layout.layout', ['title' => 'Signup for Chomp'])

@section('content')
<form class="w-full bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" action="/signup" method="POST">
	<h1 class="text-center text-3xl py-3">Sign up</h1>
	@csrf
	@if ($errors->any())
		<div class="w-2/3 mx-auto mb-4 bg-yellow-light shadow-lg p-5">
			Uh-oh a few mistakes!
			<ul>
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif
	<div class="bg-grey-light rounded border shadow-sm py-3">
		<div class="p-4">
			<p class="text-center font-weight-bolder pb-3 text-capitalize">Privacy Notice</p>
			<p class="pb-3">By completing this form you agree to the following:</p>
			<p class="pb-3">We are collecting this information to enable Chomp to keep in touch with you, to let you know what is happening, any activities that you might be interested in and to provide our funders with anonymous statistics.</p>
			<p class="pb-3"> Your information will be held on our online database in accordance with our Data Protection Policy, our Privacy Statement, our Confidentiality Policy and our Data Retention Policy all of which can be found on our <a class="underline text-blue-700" href="http://www.onechurchbrighton.org/what-we-do/policies">web page</a>.</p>
			<p class="pb-3">  If you would like to see a paper copy please call the office on 01273 694746.</p>
			<p class="pb-3">If you are concerned about the way your information is being handled or you wish to notify us of a change to your information please contact Claire, our Data Protection Lead on 01273 694746 or email <a href="mailto:info@onechurchbrighton.org" class="underline text-blue-700">info@onechurchbrighton.org</a>.</p>
			<p class="pb-3">We will make every effort to ensure that your concerns are addressed, however, you have the right to complain to the Information Commissioners Office.
			</p>
		</div>
	</div>
	<div class="block mx-auto pt-4 pl-3">
		<div class="inline-flex items-center pb-3">
			<input type="checkbox" value="true" class="form-checkbox text-green-800" id="consent"  name="consent">
			<label class="ml-2" for="consent">I understand that the personal information I have provided will be handled by One Church Brighton in accordance with the Privacy Notice above.</label>
		</div>
		<div class="mb-4 flex pb-3">
			<input type="checkbox" value="true" class="form-checkbox text-green-800" id="picture_authority"  name="picture_authority">
			<label class="ml-2" for="picture_authority">I give consent for images of me and my child to be used.</label>
		</div>

	</div>
	<div class="mb-4 block">
		<label class="text-gray-700">Name</label>
		<input class="form-input mt-1 block w-full" type="text" value="{{ old('contact_name') }}" class="form-control" id="contact_name"  name="contact_name">
	</div>
	<div class="mb-4 block">
		<label class="text-gray-700" for="postcode">Post Code</label>
		<input class="form-input mt-1 block w-full" type="text" value="{{ old('postcode') }}" class="form-control" id="postcode"  name="postcode">
	</div>
	<div class="mb-4 block">
		<label class="text-gray-700" for="contact_number">Contact Phone Number</label>
		<input class="form-input mt-1 block w-full" type="text" value="{{ old('contact_number') }}" class="form-control" id="contact_number"  name="contact_number">
	</div>
	<div class="mx-auto w-64 pb-4">
		<button type="button" name="addadult" id="addadult" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center">
			<img class="pr-4" src="svg/person.svg">
			Add Additional Adult
		</button>
	</div>
	<div id="extraadult"></div>
	<div id="children"></div>
	<div class="mx-auto w-48 pb-4">
		<button type="button" name="addchild" id="addchild" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center">
			<img class="pr-4" src="svg/person.svg">
			Add Child
		</button>
	</div>




	<div class="mx-auto w-32">
		<button type="submit" class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded">Sign up</button>
	</div>
</form>



@endsection