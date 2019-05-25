<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;
use Carbon\Carbon;


class Article extends Model
{
  use CrudTrait;

  /*
  |--------------------------------------------------------------------------
  | GLOBAL VARIABLES
  |--------------------------------------------------------------------------
  */

  protected $table = 'articles';
  protected $primaryKey = 'id';
  public $timestamps = true;
  // protected $guarded = ['id'];
  protected $fillable = ['slug', 'title', 'content', 'image', 'status', 'category_id', 'featured', 'date'];
  // protected $hidden = [];
  // protected $dates = [];
  protected $casts = [
    'featured'  => 'boolean',
    'date'      => 'date',
  ];

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


  /*
  |--------------------------------------------------------------------------
  | SCOPES
  |--------------------------------------------------------------------------
  */

  public function scopePublished($query)
  {
    return $query->where('status', 'PUBLISHED')
      ->where('date', '<=', date('Y-m-d'))
      ->orderBy('date', 'DESC');
  }

  /*
  |--------------------------------------------------------------------------
  | ACCESORS
  |--------------------------------------------------------------------------
  */

  // The slug is created automatically from the "title" field if no slug exists.

  /*
  |--------------------------------------------------------------------------
  | MUTATORS
  |--------------------------------------------------------------------------
  */
}
