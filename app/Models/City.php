<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
  protected $table = 'cities';
  protected $fillable = ['name'];
  public function lead()
  {
      return $this->hasOne(Lead::class);
  }

  public function user()
  {
      return $this->belongsToMany(User::class);
  }
}
