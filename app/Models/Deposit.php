<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    protected $guarded = ['id'];

    public function type()
    {
        return $this->belongsTo(DepositType::class, 'deposit_type_id');

    }
}
