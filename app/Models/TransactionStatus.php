<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionStatus extends Model
{
  public function lead()
  {
      return $this->belongsTo(Lead::class);

  }
}
