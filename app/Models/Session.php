<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;
use App\Models\Family;
use Carbon\Carbon;

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
    protected $casts = [
        'date' => 'dateTime',
    ];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    public function setDateAttribute($value) {
        $this->attributes['date'] = Carbon::parse($value);
    }

    function open() {
      $open = $this->season()->first()->open;
      return $open === 1 ? 'Open' : 'Closed';
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

    public function openText($crud = false)
    {
        return '<a class="btn btn-xs btn-default" href="http://google.com?q='.urlencode($this->text).'" data-toggle="tooltip" title="Just a demo custom button."><i class="fa fa-phone"></i> Text</a>';
    }

    public function add_attending(int $number) {
        $this->signed_up = $this->signed_up + $number;
        $this->save();
    }

    public function remove_attending(int $number) {
        $this->signed_up = $this->signed_up - $number;
        $this->save();
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

    public function getTotalAttendingAttribute() {
        return $this->number_of_adults() + $this->number_of_children();
    }

    public function getTotalAttendedAttribute() {
        return true;
    }

    public function getOpenAttribute() {
        return $this->open();
    }

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
