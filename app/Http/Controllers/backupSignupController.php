<?php

namespace App\Http\Controllers;

use App\Models\Family;
use App\Models\Child;
use Illuminate\Http\Request;

class backupSignupController extends Controller
{
	/**
     * Show the step 1 Form for creating a new signup.
     *
     * @return \Illuminate\Http\Response
     */
	public function form(Request $request)
	{
		$family = $request->session()->get('family');
		return view('signup.step1', compact('family', $family));
	}

    /**
     * Post Request to store step1 info in session
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postCreateStep1(Request $request)
    {
    	$validatedData = $request->validate([
    		'consent' => 'required',
    		'contact_name' => 'required',
    		'contact_number' => 'required|numeric',
    	]);

    	if(empty($request->session()->get('product'))){
    		$family = new Family();
    		$family->fill($validatedData);
    		$request->session()->put('family', $family);
    	}else{
    		$family = $request->session()->get('family');
    		$family->fill($validatedData);
    		$request->session()->put('family', $family);
    	}

    	return redirect('/signup/step2');
    }

  /**
     * Show the step 2 Form for creating a new family.
     *
     * @return \Illuminate\Http\Response
     */
  public function createStep2(Request $request)
  {
  	$family = $request->session()->get('family');
  	return view('signup.step2',compact('family', $family));
  }
    /**
     * Post Request to store step1 info in session
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postCreateStep2(Request $request)
    {
    	$family = $request->session()->get('family');

    	$request->validate([
    		'child1_name' => 'required',
    		'child1_birth_year' => 'required',
    	]);

    	$family = $request->session()->get('family');
    	$family->child1 = [
    		$request->child1_name,
    		$request->child1_birth_year,
    		$request->child1_special_requirements
    	];

    	if(isset($request->child2_name)) {
    		$request->validate([
    			'child2_name' => 'required',
    			'child2_birth_year' => 'required',
    		]);
    		$family->child2 = [
    			$request->child2_name,
    			$request->child2_birth_year,
    			$request->child2_special_requirements
    		];
    	};

    	if(isset($request->child3_name)) {
    		$request->validate([
    			'child3_name' => 'required',
    			'child3_birth_year' => 'required',
    		]);
    		$family->child3 = [
    			$request->child3_name,
    			$request->child3_birth_year,
    			$request->child3_special_requirements
    		];
    	};

    	if(isset($request->child4_name)) {
    		$request->validate([
    			'child4_name' => 'required',
    			'child4_birth_year' => 'required',
    		]);
    		$family->child4 = [
    			$request->child4_name,
    			$request->child4_birth_year,
    			$request->child4_special_requirements
    		];
    	};

    	$request->session()->put('family', $family);

    	return redirect('/signup/step3');
    }


    /**
     * Show the Family Review page
     *
     * @return \Illuminate\Http\Response
     */
    public function createStep3(Request $request)
    {
    	$product = $request->session()->get('family');
    	return view('family.step3',compact('family',$family));
    }
    /**
     * Store product
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	$family = $request->session()->get('family');

    	$family->save();
    	return redirect('/thank-you');
    }

}