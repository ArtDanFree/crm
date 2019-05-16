<?php

namespace App\Http\Controllers\ajax;

use App\Models\Lead;
use App\Transformers\MakeAppointmentTableTransformer;
use App\Transformers\TakeOnCheckTableTransformer;
use App\Http\Controllers\Controller;

class leadTableController extends Controller
{
    public function takeOnCheck()
    {
        $lead = Lead::with(['depositType', 'chin', 'notification'])->whereHas('status', function ($q) {
            return $q->where('name', 'На проверку');
        })
            ->get();

        return datatables($lead)
            ->setTransformer(new TakeOnCheckTableTransformer)
            ->make(true);
    }

    public function makeAppointment()
    {
        $leads = Lead::with(['status'])
            ->whereHas('status', function ($s) {$s->where('name', 'Одобрен');})
            ->where('chin_id', \Auth::id())
            ->get();

        return datatables($leads)
            ->setTransformer(new MakeAppointmentTableTransformer())
            ->make(true);
    }

}
