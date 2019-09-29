<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Session;
use Illuminate\Support\Facades\Response;

class SessionController extends Controller
{
    public function save(Request $request)
    {
        $request->only('notes', 'id');
        $session = Session::find($request['id']);
        $session->notes = $request['notes'];
        $session->save();
        return back();
    }
}
