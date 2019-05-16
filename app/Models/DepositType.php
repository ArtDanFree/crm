<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DepositType extends Model
{
    public function deposit()
    {
        return $this->hasMany(Deposit::class);
    }
}
