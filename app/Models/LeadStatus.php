<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeadStatus extends Model
{
    public function lead()
    {
        return $this->hasMany(Lead::class);
    }
}
