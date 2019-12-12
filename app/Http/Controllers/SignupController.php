<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Family;
use App\Models\Child;
use App\Models\Adult;
use Validator;

class SignupController extends Controller
{

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return view('signup.index');
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {


  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $rules = [
      'consent' => 'required|accepted',
      'contact_name' => 'required',
      'contact_number' => 'required|numeric',
      'postcode' => 'required',
    ];

    if(!empty($request->input('child'))) {
        foreach ($request->input('child') as $key => $value) {
            $rules["child.{$key}.name"] = 'required';
            $rules["child.{$key}.birthyear"] = 'required|numeric|min:1990';
        }
    }

    $request->validate($rules);

    $family = Family::create([
      'postcode' => request('postcode'),
      'contact_number' => request('contact_number'),
      'consent' => request('consent'),
      'picture_authority' => $request->has('picture_authority') ? (bool)request('picture_authority') : false,
    ]);

    $primary = Adult::create([
      'name' => $request['contact_name'],
      'primary' => '1',
    ]);

    $primary->family()->associate($family);
    $primary->save();

    if(isset($request['adult'])) {
        foreach ($request['adult'] as $key => $adult) {
            $adult = Adult::create([
                'name' => $adult['name'],
                'primary' => '0',
            ]);


            $adult->family()->associate($family);
            $adult->save();
        }
    }

    foreach ($request['child'] as $child) {
      if ($child['name'] !== null) {
        $child = Child::create([
          'name' => $child['name'],
          'birth_year' => $child['birthyear'],
          'special_requirements' => $child['special_requirements'] !== null ? $child['special_requirements'] : "None",
        ]);

        $child->family()->associate($family);
        $child->save();
      }
    };

    session(['family_id' => $family->id]);
    return redirect('/select-session');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $family = Family::findOrFail($id);
    $children = $family->children()->get();
    $adults = $family->additional_adults();
    return view('signup.edit', compact('family', 'children', 'adults'));
  }
  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    $rules = [
        'consent' => 'required|accepted',
        'contact_name' => 'required',
        'contact_number' => 'required|numeric',
        'postcode' => 'required',
    ];

    foreach($request->input('child') as $key => $value) {
      $rules["child.{$key}.name"] = 'required';
      $rules["child.{$key}.birthyear"] = 'required|numeric|min:1990';
    }

    $request->validate($rules);

    $family = Family::findOrFail($id);

    $family->postcode = request('postcode');
    $family->contact_number = request('contact_number');
    $family->consent =request('consent');
    $family->picture_authority = $request->has('picture_authority') ? (bool)request('picture_authority') : false;
    $family->save();

    $primary = $family->primary_adult();
    $primary->name = $request['contact_name'];
    $primary->family()->associate($family);
    $primary->save();

    $additional_adults = $family->additional_adults();
    foreach($additional_adults as $adult) {
      $adult->delete();
    }
    foreach($request['adult'] as $key=>$adult) {
      $adult = Adult::create([
          'name' => $adult['name'],
          'primary' => '0',
      ]);

      $adult->family()->associate($family);
      $adult->save();
    }
    $children = $family->children()->get();
    foreach ($children as $child) {
      $child->delete();
    }
    foreach ($request['child'] as $child) {
      if ($child['name'] !== null) {
        $child = Child::create([
            'name' => $child['name'],
            'birth_year' => $child['birthyear'],
            'special_requirements' => $child['special_requirements'] !== null ? $child['special_requirements'] : "None",
        ]);

        $child->family()->associate($family);
        $child->save();
      }
    };

    session(['family_id' => $family->id]);
    return redirect('/select-session');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    //
  }

  public function messages() {
    return [
      'child.*.birth_year' => "To help with planning, we need a birth year for each child"
    ];
  }
}
