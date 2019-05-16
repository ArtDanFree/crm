<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = [
        'birthday'
    ];



    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function transactionNotification()
    {
        return $this->hasMany(TransactionNotification::class, 'chin_id');
    }

    public function leadNotification()
    {
        return $this->hasMany(LeadNotification::class);
    }

    public function workingTime()
    {
        return $this->hasOne(WorkingTime::class);
    }
}
