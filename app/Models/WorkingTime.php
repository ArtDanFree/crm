<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkingTime extends Model
{
    protected $table = 'working_time';
    protected $fillable = ['from', 'to'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
