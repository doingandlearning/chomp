<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\SessionRequest as StoreRequest;
use App\Http\Requests\SessionRequest as UpdateRequest;
use Backpack\CRUD\CrudPanel;

/**
 * Class SessionCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class SessionCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Session');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/session');
        $this->crud->setEntityNameStrings('session', 'sessions');

        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */

        $this->crud->addColumn([
          'name' => 'open',
          'label' => 'Open',
          'type' => 'model_function',
          'function_name' => 'open'
        ]);

        $this->crud->addColumn([
            'name' => 'date',
            'label' => 'Date',
            'type' => 'date_link',
            'format' => 'dddd Do MMMM @ HH:mm A',
            'href' => 'register'
        ]);

        $this->crud->addColumn([
            'label' => 'Venue',
            'type' => 'select',
            'name' => 'venue_id',
            'entity' => 'venue',
            'attribute' => 'name',
            'model' => 'App\Models\Venue',
        ]);

        $this->crud->addColumn([
            'label' => 'Leader',
            'type' => 'select',
            'name' => 'leader_id',
            'entity' => 'leader',
            'attribute' => 'contact_name',
            'model' => 'App\Models\Leader',
        ]);


        $this->crud->addField([   // DateTime
            'name' => 'date',
            'label' => 'Date',
            'type' => 'datetime_picker',
            // optional:
            'datetime_picker_options' => [
                'format' => 'DD/MM/YYYY HH:mm',
                'language' => 'en'
            ],
            'allows_null' => false,
             'default' => '2019-05-12 10:00:00',
        ]);

        $this->crud->addField([
            'label' => 'Season',
            'type' => 'select',
            'name' => 'season_id',
            'entity' => 'season',
            'attribute' => 'name',
            'model' => 'App\Models\Season',
        ]);

        $this->crud->addField([
            'label' => 'Venue',
            'type' => 'select2',
            'name' => 'venue_id',
            'entity' => 'venue',
            'attribute' => 'name',
            'model' => 'App\Models\Venue',
        ]);

        $this->crud->addField([
            'label' => 'Leader',
            'type' => 'select2',
            'name' => 'leader_id',
            'entity' => 'leader',
            'attribute' => 'contact_name',
            'model' => 'App\Models\Leader',
        ]);

        // add asterisk for fields that are required in SessionRequest
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
