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

  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-body">{{ trans('backpack::base.logged_in') }}</div>
      </div>

    </div>
  </div>
@endsection