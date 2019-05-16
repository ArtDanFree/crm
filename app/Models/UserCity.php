<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserCity extends Model
{
  protected $table = 'user_cities';
  protected $fillable = ['user_id', 'city_id'];

  public function User ()
  {
    return $this->hasOne(User::class);
  }

  public function city ()
  {
    return $this->belongsTo(City::class);
  }
}
