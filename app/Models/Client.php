<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $guarded = ['id'];
    protected $dates = ['birthday'];

    public function transaction()
    {
        $this->hasMany(Transaction::class);
    }

    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }
}