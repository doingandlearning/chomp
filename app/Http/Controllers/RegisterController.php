<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Session;
use App\Models\Family;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    function index($id)
    {
        $session = Session::findOrFail($id);

        $families = [];
        foreach ($session->families()->get() as $family) {
            $families[] = [
                'id' => $family->id,
                'contact_name' => $family->contact_name,
                'contact_number' => $family->contact_number,
                'children' => $family->children_with_ages_array(),
                'attending' => $family->attending_session($id),
                'primary_adult' => $family->primary_adult(),
                'additional' => $family->additional_adults(),
                ];
        };
        $venue = $session->venue->first();
        $date = $session->date;
        $leader = $session->leader()->first();
        return view('register', compact('id','date','venue', 'families', 'leader'));
    }

    function register(Request $request)
    {
        Family::find($request['family'])
            ->update_attendance($request['session']);
        return Response::json(['Success' => 'Success']);
    }

}
