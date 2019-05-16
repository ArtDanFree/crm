<?php

namespace App\Http\Service;


class LeadService
{
    /**
     * @param $leads
     * @return Лидов которых проверяет Андеррайтер
     */
    public function filterCheckLeads($leads)
    {
        return $leads->filter(function ($value) {
            return ($value->underwriter_id == \Auth::id() and $value->status->name == 'Проверяется') or
                ($value->underwriter_id == \Auth::id() and $value->status->name == 'На доработку');
        });
    }

}