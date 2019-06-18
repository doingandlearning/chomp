<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;
use App\Models\Family;

class Session extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'sessions';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    // protected $guarded = ['id'];
    protected $fillable = ['date', 'session_id', 'leader_id', 'venue_id'];
    // protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    function open() {
      $open = $this->season()->first()->open;
      return $open === "1" ? 'Open' : 'Closed';
    }

    function number_of_adults() {
        $result = 0;
        foreach ($this->families()->get() as $family) {
            $result += $family->number_of_adults();
        }
        return $result;
    }

    function number_of_adults_attending() {
        $result = 0;
        foreach ($this->families()->get() as $family) {
            $result += $family->number_of_adults_attending($this->id);
        }
        return $result;
    }

    function number_of_children() {
        $result = 0;
        foreach ($this->families()->get() as $family) {
            $result += $family->number_of_children();
        }
        return $result;
    }

    function number_of_children_attending() {
        $result = 0;
        foreach ($this->families()->get() as $family) {
            $result += $family->number_of_children_attending($this->id);
        }
        return $result;
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    function season() {
        return $this->belongsTo(Season::class);
    }

    function leader() {
        return $this->belongsTo(Leader::class);
    }

    function venue() {
        return $this->belongsTo(Venue::class);
    }

    function families() {
      return $this->belongsToMany(Family::class, 'familysession')->withPivot('attended');
    }

    function adults() {
      return $this->belongsToMany(Adult::class, 'adultsession')->withPivot('attended');
    }

    function children() {
      return $this->belongsToMany(Child::class, 'childsession')->withPivot('attended');
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
