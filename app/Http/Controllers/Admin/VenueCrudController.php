<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\VenueRequest as StoreRequest;
use App\Http\Requests\VenueRequest as UpdateRequest;
use Backpack\CRUD\CrudPanel;

/**
 * Class VenueCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class VenueCrudController extends CrudController
{
  public function setup()
  {
    /*
    |--------------------------------------------------------------------------
    | CrudPanel Basic Information
    |--------------------------------------------------------------------------
    */
    $this->crud->setModel('App\Models\Venue');
    $this->crud->setRoute(config('backpack.base.route_prefix') . '/venue');
    $this->crud->setEntityNameStrings('venue', 'venues');

    /*
    |--------------------------------------------------------------------------
    | CrudPanel Configuration
    |--------------------------------------------------------------------------
    */

      $this->crud->addColumn([
          'name' => 'risk_assessment',
          'label' => 'Risk Assessment',
          'type' => 'labelled_link',
          'text' => 'View Assessment',
      ]);
      $this->crud->setColumns(['name', 'address', 'capacity']);

      $this->crud->addColumn([
       'name' => 'contact_name',
       'label' => 'Contact Name'
     ]);

      $this->crud->addColumn([
       'name' => 'contact_number',
       'label' => 'Contact Number'
     ]);



      $this->crud->addField([
      'name' => 'name',
      'label' => "Venue name"
    ]);

    $this->crud->addField([
      'name' => 'address',
      'label' => "Venue address"
    ]);

    $this->crud->addField([
      'name' => 'capacity',
      'label' => "Venue capacity"
    ]);

    $this->crud->addField([
      'name' => 'contact_name',
      'label' => "Contact Person"
    ]);

    $this->crud->addField([
      'name' => 'contact_number',
      'label' => "Contact Number"
    ]);

    $this->crud->addField([
      'label' => 'Risk Assessment',
      'name' => 'risk_assessment',
      'type' => 'browse'
    ]);
    // add asterisk for fields that are required in VenueRequest
    $this->crud->setRequiredFields(StoreRequest::class, 'create');
    $this->crud->setRequiredFields(UpdateRequest::class, 'edit');
    $this->crud->enableExportButtons();
  }

  public function store(StoreRequest $request)
  {
    // your additional operations before save here
    $redirect_location = parent::storeCrud($request);
    // your additional operations after save here
    // use $this->data['entry'] or $this->crud->entry
    return $redirect_location;
  }

  public function update(UpdateRequest $request)
  {
    // your additional operations before save here
    $redirect_location = parent::updateCrud($request);
    // your additional operations after save here
    // use $this->data['entry'] or $this->crud->entry
    return $redirect_location;
  }
}
