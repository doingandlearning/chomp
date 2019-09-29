<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\SeasonRequest as StoreRequest;
use App\Http\Requests\SeasonRequest as UpdateRequest;
use Backpack\CRUD\CrudPanel;

/**
 * Class SeasonCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class SeasonCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Season');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/season');
        $this->crud->setEntityNameStrings('season', 'seasons');

        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */

        $this->crud->addColumns(['name']);

        $this->crud->addColumn([
          'name' => 'open',
          'label' => 'Open',
          'type' => 'boolean',
          'options' => [0 => '❌', 1 => '✓']
        ]);

        $this->crud->addField([
            'name'  => 'name',
            'label' => 'Name',
            'type'  => 'text',
        ]);  
        $this->crud->addField([
            'name'  => 'open',
            'label' => 'Open',
            'type'  => 'checkbox',
        ]);


        // add asterisk for fields that are required in SeasonRequest
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
