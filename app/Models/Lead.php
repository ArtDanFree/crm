<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $guarded = ['id'];
    protected $dates = ['taken_at', 'completed_at' ];

    public function status()
    {
        return $this->belongsTo(LeadStatus::class);
    }

    public function leadImage()
    {
        return $this->hasMany(LeadImage::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function source()
    {
        return $this->belongsTo(Source::class);
    }

    public function underwriter()
    {
        return $this->belongsTo(User::class);
    }

    public function chin()
    {
        return $this->belongsTo(User::class);
    }

    public function depositType()
    {
        return $this->belongsTo(DepositType::class);
    }

    public function notification()
    {
        return $this->hasMany(LeadNotification::class);
    }

    public function deleteNotification()
    {
        if ($this->notification->where('user_id', \Auth::id())->first()) {
            $this->notification->where('user_id', \Auth::id())->first()->delete();
        };
    }

    /**
     *Удаляет уведомления об это лиде у всех пользователей
     */
    public function deleteAllNotification()
    {
        return LeadNotification::where('lead_id', $this->id)->delete();
    }

    public function getCheckLeads()
    {
        $this::with(['status', 'depositType', 'chin'])->orderByDesc('created_at')->get();
        $checkLeads = $this->filter(function ($value) {
            return ($value->underwriter_id == \Request::user()->id and $value->status->name == 'Проверяется') or
                ($value->underwriter_id == \Request::user()->id and $value->status->name == 'На доработку');
        });
    }

    public function takeOnCheck()
    {
        return true;
    }

    public function checkRework()
    {
        $this->underwriter_id = auth()->id();
        $this->comment = null;
        if($this->status_id == 1)
        {
            $this->taken_at = now()->format('Y-m-d H:i:s');
            $this->status_id = '2';
        }
        if($this->status_id == 5){
            ReworkStatistic::create([
                'label' => 1,
                'lead_id' => $this->id
            ]);
            $this->status_id = '2';
        }
        $this->save();
    }

}
