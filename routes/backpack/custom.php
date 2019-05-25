<?php

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => ['web', config('backpack.base.middleware_key', 'admin')],
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    // CRUD resources and other admin routes
  CRUD::resource('venue', 'VenueCrudController');
  CRUD::resource('family', 'FamilyCrudController');
  CRUD::resource('child', 'ChildCrudController');
  CRUD::resource('leader', 'LeaderCrudController');
  CRUD::resource('season', 'SeasonCrudController');
  CRUD::resource('session', 'SessionCrudController');
}); // this should be the absolute last line of this file
