<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;
use App\Models\Family;
use Carbon\Carbon;

class Child extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'children';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    // protected $guarded = ['id'];
    protected $fillable = ['name', 'birth_year', 'special_requirements'];
    // protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    public function age() {
        $now = Carbon::now()->format('Y');
        return $now - $this->birth_year;
    }

    public function name_and_age() {
        return $this->name . " (" . $this->age() . ')';
    }

    function toggle_attendance($id) {
        if ($this->attending_session($id)) {
            $this->sessions()->detach(Session::find($id));
            return;
        }
        $this->sessions()->attach(Session::find($id), ['attended' => true]);
    }

    function attending_session($id) {
        if ($this->sessions()->where('id', $id)->exists()) {
            return $this->sessions()->findOrFail($id)->pivot->attended === "1" ? true : false;
        }
        return false;
    }
    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function family() {
        return $this->belongsTo('App\Models\Family');
    }
    function sessions() {
        return $this->belongsToMany(Session::class, 'childsession')->withPivot('attended');
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
