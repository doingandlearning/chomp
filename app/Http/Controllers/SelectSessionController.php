<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Family;
use App\Models\Session;
use App\Models\Season;
use App\Models\Venue;
use Illuminate\Support\Facades\DB;

class SelectSessionController extends Controller
{
    public function index(Request $request){
      // Getting family details to check and confirm
      $family_id = $request->session()->get('family_id');
      $family = Family::findOrFail($family_id);
      $children = $family->children;
      $adult = $family->adults()->where('primary', '=', '1')->pluck('name')[0];
      $additional_adults = $family->adults()->where('primary', '=', '0')->pluck('name');

      $sessions = DB::table('sessions')
          ->join('venues', 'sessions.venue_id', '=', 'venues.id')
          ->join('seasons', 'seasons.id', '=', 'sessions.season_id')
          ->select( 'sessions.date', 'venues.name', 'sessions.id')
          ->where('seasons.open', '=', 1)
          ->get()
          ->groupBy('name');

      return view('select-session', compact('family', 'sessions', 'children', 'adult', 'additional_adults'));
    }

    public function store(Request $request) {
      $ids = $request->except(['_token', 'family']);
      $family = Family::findOrFail($request->family);
      $current_sessions = $family->sessions()->pluck('id')->toArray();

      foreach ($ids as $id => $_) {
        $session = Session::findOrFail($id);

        if (!isset($sessions[$session->venue->name])){
            $sessions[$session->venue->name] = [];
        }
        array_push($sessions[$session->venue->name], $session->date);
//        $sessions[$session->venue->name] = $session->date;

        if (($key = array_search($id, $current_sessions)) !== false) {
              unset($current_sessions[$key]);
        }

        if (!$family->sessions()->where('id', $id)->exists()) {
            $family->sessions()->attach($session);
        }

      }

      foreach ($current_sessions as $session) {
        $family->sessions()->detach($session);
      }
      return view('thank-you', compact('sessions', 'family'));
    }

    public function update($id){
        // Getting family details to check and confirm
        $family = Family::findOrFail($id);
        $children = $family->children;

        $sessions = DB::table('sessions')
            ->join('venues', 'sessions.venue_id', '=', 'venues.id')
            ->join('seasons', 'seasons.id', '=', 'sessions.season_id')
                ->select( 'sessions.date', 'venues.name', 'sessions.id')
            ->where('seasons.open', '=', 1)
            ->get();


        $attendance = [];

        foreach ($sessions as $session) {
            $attendance[$session->id] = Session::find($session->id)->families()->where('id', $family->id)->exists();
        }

        $sessions = $sessions->groupBy('name');

        return view('select-session', compact('family', 'sessions', 'children', 'attendance'));
    }

}
