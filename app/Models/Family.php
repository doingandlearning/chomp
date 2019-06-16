<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;
use Illuminate\Support\Facades\DB;

class Family extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'families';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    // protected $guarded = ['id'];
    protected $fillable = ['contact_number', 'consent', 'picture_authority', 'postcode'];
    // protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    function children_with_ages() {
        $children = $this->children()->get();
        $string = '<ul>';

        foreach ($children as $child) {
            $string .= '<li>' . $child->name_and_age() . '</li>';
        }

        $string .= '</ul>';
        return $string;
    }

    function children_with_ages_array() {
        $children_db = $this->children()->get();

        $children = [];
        foreach ($children_db as $child) {
            $children[] = [
                'name' =>$child->name,
                'age' => $child->age()
            ];
        }

        return $children;
    }

    function children_array_with_attendance($id) {
        $children_db = $this->children()->get();

        $children = [];
        foreach ($children_db as $child) {
            $children[] = [
                'id' => $child->id,
                'attending' => $child->attending_session($id),
                'name' =>$child->name,
                'age' => $child->age()
            ];
        }

        return $children;
    }

    function primary_adult() {
        return $this->adults()->where('primary', '=', '1')->first();
    }

    function additional_adults() {
        return $this->adults()->where('primary', '=', '0')->get();
    }

    function attending_session($id) {
        return $this->sessions()->findOrFail($id)->pivot->attended;
    }

    function update_attendance($id) {
        if ($this->attending_session($id)) {
            $this->sessions()->updateExistingPivot(Session::find($id), ['attended' => false]);
            return;
        }
        $this->sessions()->updateExistingPivot(Session::find($id), ['attended' => true]);
    }
    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    function children() {
        return $this->hasMany(Child::class);
    }

    function adults() {
        return $this->hasMany(Adult::class);
    }

    function sessions() {
        return $this->belongsToMany(Session::class, 'familysession')->withPivot('attended');
    }



    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
