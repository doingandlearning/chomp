<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\FamilyRequest as StoreRequest;
use App\Http\Requests\FamilyRequest as UpdateRequest;
use Backpack\CRUD\CrudPanel;
use App\Models\Family;

/**
 * Class FamilyCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class FamilyCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Family');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/family');
        $this->crud->setEntityNameStrings('family', 'families');

        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */

        $this->crud->addColumn([
          'name' => 'contact_name',
          'label' => 'Contact Name',
          'type' => 'text_link',
          'href' => 'family',
        ]);

        $this->crud->addColumn([
          'name' => 'contact_number',
          'label' => 'Contact Number',
        ]);

        $this->crud->addColumn([
          'name' => 'postcode',
          'label' => 'Postcode',
        ]);

        $this->crud->addColumn([
          'name' => 'children',
          'label' => 'Children',
          'type' => 'model_function',
          'function_name' => 'children_with_ages',
          'limit' => 200,
        ]);

        $this->crud->addColumn([
            'name' => 'picture_authority',
            'label' => 'Picture authority',
            'type' => 'boolean'
        ]);

      $this->crud->addFields(['contact_name', 'contact_number', 'postcode']);

      $this->crud->addField([
        'name' => 'picture_authority',
        'label' => 'Picture Authority',
        'type' => 'checkbox'
      ]);

      // add asterisk for fields that are required in FamilyRequest
        $this->crud->setRequiredFields(StoreRequest::class, 'create');
        $this->crud->setRequiredFields(UpdateRequest::class, 'edit');
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
