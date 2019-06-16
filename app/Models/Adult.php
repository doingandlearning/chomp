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
        return $this->belongsToMany(Session::class, 'adultsession')->withPivot('attended');
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
