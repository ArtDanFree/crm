<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeadNotification extends Model
{
    protected $guarded = ['id',];

    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }
}
