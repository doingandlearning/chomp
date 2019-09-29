@extends('backpack::layout')

@section('header')
  <section class="content-header">
    <h1>
      {{ trans('backpack::base.dashboard') }}<small></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ backpack_url() }}">{{ config('backpack.base.project_name') }}</a></li>
      <li class="active">{{ trans('backpack::base.dashboard') }}</li>
    </ol>
  </section>
@endsection


@section('content')
<div class="box-body">{{ trans('backpack::base.logged_in') }}</div>

<div class="w-2/3 mx-auto">
	<div class="container">
		<table class="w-full flex flex-row flex-no-wrap sm:bg-white rounded-lg overflow-hidden sm:shadow-lg my-5">
			<thead class="text-white">
				<tr class="bg-teal-400 flex flex-col flex-no wrap sm:table-row rounded-l-lg sm:rounded-none mb-2 sm:mb-0">
					<th class="p-3 text-left">Venue</th>
					<th class="p-3 text-left">Date</th>
					<th class="p-3 text-left" width="110px">Number attending</th>
				</tr>
				<tr class="bg-teal-400 flex flex-col flex-no wrap sm:table-row rounded-l-lg sm:rounded-none mb-2 sm:mb-0">
					<th class="p-3 text-left">Venue</th>
					<th class="p-3 text-left">Date</th>
					<th class="p-3 text-left" width="110px">Number attending</th>
				</tr>
                <tr class="bg-teal-400 flex flex-col flex-no wrap sm:table-row rounded-l-lg sm:rounded-none mb-2 sm:mb-0">
                  <th class="p-3 text-left">Venue</th>
                  <th class="p-3 text-left">Date</th>
                  <th class="p-3 text-left" width="110px">Number attending</th>
              </tr>
                <tr class="bg-teal-400 flex flex-col flex-no wrap sm:table-row rounded-l-lg sm:rounded-none mb-2 sm:mb-0">
                  <th class="p-3 text-left">Venue</th>
                  <th class="p-3 text-left">Date</th>
                  <th class="p-3 text-left" width="110px">Number attending</th>
              </tr>
			</thead>
			<tbody class="flex-1 sm:flex-none">
      @foreach ($sessions as $session)
				<tr class="flex flex-col flex-no wrap sm:table-row mb-2 sm:mb-0">
					<td class="border-grey-light border hover:bg-gray-100 p-3">{{$session['venue']['name']}}</td>
					<td class="border-grey-light border hover:bg-gray-100 p-3 truncate"><a href="/register/{{$session->id}}">{{date('l jS F', strtotime($session->date))}}</a></td>
					<td class="border-grey-light border hover:bg-gray-100 p-3 text-red-400 hover:text-red-600 hover:font-medium cursor-pointer">{{$session['TotalAttending']}}</td>
				</tr>
        @endforeach
			</tbody>
		</table>
	</div>
  </div>

<style>
  html,
  body {
    height: 100%;
  }

  @media (min-width: 640px) {
    table {
      display: inline-table !important;
    }

    thead tr:not(:first-child) {
      display: none;
    }
  }

  td:not(:last-child) {
    border-bottom: 0;
  }

  th:not(:last-child) {
    border-bottom: 2px solid rgba(0, 0, 0, .1);
  }
</style>
@endsection
