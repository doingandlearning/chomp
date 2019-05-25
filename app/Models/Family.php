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
    protected $fillable = ['contact_name', 'contact_number', 'consent', 'picture_authority', 'postcode'];
    // protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    function children() {
        return $this->hasMany(Child::class);
    }

    function sessions() {
        return $this->belongsToMany(Session::class, 'familysession')->withPivot('attended');
    }

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
            array_push($children, [
                'name' =>$child->name,
                'age' => $child->age()]);
        }

        return $children;
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
        return;
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
