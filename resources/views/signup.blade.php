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
			<p class="text-center font-weight-bolder pb-3 text-capitalize">CONSENT – please read carefully</p>
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
	<div class="block mx-auto pt-4 pl-3">
		<div class="inline-flex items-center pb-3">
			<input type="checkbox" value="true" class="form-checkbox text-green-800" id="consent"  name="consent">
			<label class="ml-2" for="consent">I agree to the terms above.</label>
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

<script type="text/javascript">

	$(document).ready(function(){
		var postURL = "<?php echo url('addmore'); ?>";
		var i=1;
		var j=1;

		function childHTML(i) {
			return '<div id="divchild' + i +'"class="bg-grey-lighter shadow-md rounded px-8 pt-6 pb-8 mb-4">\n' +
					'          <div class="mb-4">\n' +
					'          <label class="text-gray-700" for="child[' + i + '][name]">Child name</label>\n' +
					'      <input class="form-input mt-1 block w-full" type="text" value="" class="form-control" id="child[' + i + '][name]" name="child[' + i + '][name]">\n' +
					'          </div>\n' +
					'          <div class="mb-4">\n' +
					'          <label class="text-gray-700" for="child[' + i + '][birthyear]">Year of birth</label>\n' +
					'      <input class="form-input mt-1 block w-full" type="text" value="" class="form-control" id="child[' + i + '][birthyear]" name="child[' + i + '][birthyear]">\n' +
					'          </div>\n' +
					'          <div class="mb-4">\n' +
					'          <label class="text-gray-700" for="child[' + i + '][special_requirements]">Additional Information (food, health, anything you think is important)</label>\n' +
					'      <textarea class="form-textarea mt-1 block w-full" rows="3" value="" class="form-control" id="child[' + i + '][special_requirements]" name="child[' + i + '][special_requirements]"></textarea>' +
					'          </div>\n' +
					'  <button type="button" class="text-red-400 btn_remove" id="child'+ i + '">Remove Child</button>' +
					'          </div>';
		}

		function adultHTML (j) {
			return '<div id="divadult' + j +'" class="bg-grey-lighter shadow-md rounded px-8 pt-6 pb-8 mb-4">\n' +
					'          <div class="mb-4">\n' +
					'          <label class="text-gray-700" for="adult[' + j + '][name]">Adult name</label>\n' +
					'      <input class="form-input mt-1 block w-full" type="text" value="" class="form-control" id="adult[' + j + '][name]" name="adult[' + j + '][name]">\n' +
					'          </div>\n' +
					'  <button type="button" class="text-red-400 btn_remove" id="adult'+ j + '">Remove Adult</button>' +
					'          </div>';
		}

		$('#addchild').click(function(){
			$('#children').append(childHTML(i));
			i++;
		});

		$('#addadult').click(function(){
			$('#extraadult').append(adultHTML(j));
			j++;
		});

		$(document).on('click', '.btn_remove', function(){
			var button_id = $(this).attr("id");
			$('#div'+button_id+'').remove();
		});


	});

</script>

@endsection