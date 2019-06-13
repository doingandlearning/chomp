<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class Adult extends Model
{
  use CrudTrait;

  /*
  |--------------------------------------------------------------------------
  | GLOBAL VARIABLES
  |--------------------------------------------------------------------------
  */

  protected $table = 'adults';
  // protected $primaryKey = 'id';
  // public $timestamps = false;
  // protected $guarded = ['id'];
  protected $fillable = ['name', 'primary', 'family_id'];
  // protected $hidden = [];
  // protected $dates = [];

  /*
  |--------------------------------------------------------------------------
  | FUNCTIONS
  |--------------------------------------------------------------------------
  */
  function toggle_attendance($id) {
    if ($this->attending_session($id)) {
      $this->sessions()->updateExistingPivot(Session::find($id), ['attended' => false]);
      return;
    }
    $this->sessions()->updateExistingPivot(Session::find($id), ['attended' => true]);
    return;
  }
  /*
  |--------------------------------------------------------------------------
  | RELATIONS
  |--------------------------------------------------------------------------
  */
  public function family() {
    return $this->belongsTo('App\Models\Family');
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
