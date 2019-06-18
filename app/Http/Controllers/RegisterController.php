<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Session;
use App\Models\Adult;
use App\Models\Child;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    function index($id)
    {
        $session = Session::findOrFail($id);
        $session['number_of_adults'] = $session->number_of_adults();
        $session['number_of_children'] = $session->number_of_children();
        $session['number_of_adults_attending'] = $session->number_of_adults_attending();
        $session['number_of_children_attending'] = $session->number_of_children_attending();

        $families = [];
        foreach ($session->families()->get() as $family) {
            $primary = $family->primary_adult();
            $families[] = [
                'id' => $family->id,
                'contact_name' => $family->contact_name,
                'contact_number' => $family->contact_number,
                'children' => $family->children_array_with_attendance($id),
                'attending' => $family->attending_session($id),
                'additional' => $family->additional_adults_array($id),
                'primary_adult' => [
                  'id' => $primary->id,
                  'name' => $primary->name,
                  'attending' => $primary->attending_session($id)
               ],
                ];
        };

        $venue = $session->venue->first();
        $date = $session->date;
        $leader = $session->leader()->first();
        return view('register', compact('id','date','venue', 'families', 'leader', 'session'));
    }

    function register(Request $request)
    {
      if($request['adult'] === 'true') {
        Adult::findOrFail($request['person_id'])
          ->toggle_attendance($request['session_id']);
        return Response::json(['Success' => 'Success - Adult registered']);
      }
      if($request['child'] === 'true') {
        Child::findOrFail($request['person_id'])
          ->toggle_attendance($request['session_id']);
        return Response::json(['Success' => 'Success - Child registered']);
      }
      return Response::json(['Failure' => 'Neither child nor adult']);
    }

}
