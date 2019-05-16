<?php

namespace App\Models;



use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $guarded = ['id'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function status()
    {
        return $this->belongsTo(TransactionStatus::class);
    }
    public function depositType()
    {
        return $this->belongsTo(DepositType::class);
    }

    public function payment()
    {
        return $this->hasMany(Payment::class);
    }
    public function waiver()
    {
        return $this->belongsTo(TransactionWaiver::class);
    }

    public function description()
    {
        return $this->hasMany(TransactionDescription::class);
    }

    public function notification()
    {
        return $this->hasOne(TransactionNotification::class);
    }

}
