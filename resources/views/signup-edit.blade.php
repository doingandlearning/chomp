<!DOCTYPE html>
<html>
<head>
	<title>Chomp Sign-up</title>
	<link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body>
<form class="w-full bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" action="{{action('SignupController@update', $family->id)}}" method="POST">
	<h1 class="text-center py-3">Sign up</h1>
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
	<div class="bg-grey-light rounded shadow-sm py-3">
		<div class="p-4">
			<p class="text-center font-weight-bold pb-3 text-capitalize">CONSENT – please read carefully</p>
		<p class="pb-3">By completing this form you agree to the following…</p>
		<ul>
			<li class="pb-2">I agree to my child/ren taking part in the activities of Chomp.</li>
			<li class="pb-2">I understand I am fully responsible for my child at all times whilst at Chomp.</li>
			<li class="pb-2">I understand that whilst every caution is taken to keep exits closed, the building is in constant use and I am responsible for keeping my child within my sight.</li>
			<li class="pb-2">I confirm to the best of my knowledge that my son/daughter does not suffer from any medical condition or food allergies other than those listed on this form.</li>
			<li class="pb-2">I understand that the Church accepts no responsibility for loss, damage or injury caused by or during attendance on any of the clubs organised activities except where such loss, damage or injury can be shown to result directly from the negligence of the Church.</li>
			<li class="pb-2">I understand that the personal information I have provided will be handled by Chomp in accordance with the Data Protection Act 1998, and it will be used for the purpose of providing services and collating statistics.  My information will be treated as confidential and will only be shared with other statutory organisations according to legal obligation.</li>
			<li class="pb-2">We may take photographs for fundraising or promotional purposes that may be used online or for local and/or national press. If you do not want pictures of you or your child to be used, please indicate on the form below.</li>
		</ul>
		</div>
	</div>
	<div class="pt-6 mb-4 flex">
		<input type="checkbox" value="true" checked="{{$family->consent}}" class="checked mr-4 self-center" id="consent"  name="consent">
		<label class="self-center block text-grey-darker text-sm font-bold mb-2" for="consent">I agree to the terms above.</label>
	</div>
	<div class="mb-4 flex">
		<input type="checkbox" checked="{{$family->picture_authority}}" value="{{$family->picture_authority}}" class="mr-4 self-center" id="picture_authority"  name="picture_authority">
		<label class="self-center block text-grey-darker text-sm font-bold mb-2" for="picture_authority">I give consent for images of me and my child to be used.</label>
	</div>
	<div class="mb-4">
		<label class="block text-grey-darker text-sm font-bold mb-2" for="contact_name" >Name</label>
		<input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline" type="text"" value="{{ $family->contact_name }}" class="form-control" id="contact_name"  name="contact_name">
	</div>
	<div class="mb-4">
		<label class="block text-grey-darker text-sm font-bold mb-2" for="postcode">Post Code</label>
		<input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline" type="text"" value="{{ $family->postcode }}" class="form-control" id="postcode"  name="postcode">
	</div>
	<div class="mb-4">
		<label class="block text-grey-darker text-sm font-bold mb-2" for="contact_number">Contact Phone Number</label>
		<input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline" type="text"" value="{{ $family->contact_number }}" class="form-control" id="contact_number"  name="contact_number">
	</div>
	@foreach ($children as $child)
	<div class="bg-grey-lighter shadow-md rounded px-8 pt-6 pb-8 mb-4">
		<div class="mb-4">
			<label class="block text-grey-darker text-sm font-bold mb-2" for="child[0][name]">Child name</label>
			<input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline" type="text"" value="{{ $child->name }}" class="form-control" id="child[{{$loop->index}}][name]" name="child[{{$loop->index}}][name]">
		</div>
		<div class="mb-4">
			<label class="block text-grey-darker text-sm font-bold mb-2" for="child[0][birth_year]">Year of birth</label>
			<input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline" type="text"" value="{{ $child->birth_year }}" class="form-control" id="child[{{$loop->index}}][birth_year]" name="child[{{$loop->index}}][birth_year]">
		</div>
		<div class="mb-4">
			<label class="block text-grey-darker text-sm font-bold mb-2" for="child[0][special_requirements]">Special food requirements</label>
			<input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline" type="text"" value="{{ $child->special_requirements }}" class="form-control" id="child[{{$loop->index}}][special_requirements]" name="child[{{$loop->index}}][special_requirements]">
		</div>
	</div>
	@endforeach


<div class="mx-auto w-32">
	<button type="submit" class="bg-blue hover:bg-blue-dark text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Update</button>
</div>
</form>

</body>
</html>