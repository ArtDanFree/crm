<?php

namespace App\Http\Controllers\ajax;

use App\Models\Lead;
use App\Transformers\AllLeadsTransformer;
use App\Http\Controllers\Controller;

class AllLeadsTableController extends Controller
{
    public function __invoke()
    {
        if (\Request::user()->hasRole('Андеррайтер')) {
            return $this->underwriter();
        }
        elseif (\Request::user()->hasRole('Частный инвестор')) {
            return $this->chin();
        }

    }

    public function underwriter()
    {
        $leads = Lead::where('underwriter_id', \Auth::id())->orWhere('status_id', 1)->get();
        return datatables($leads)->setTransformer(new AllLeadsTransformer())->make(true);
    }

    public function chin()
    {
        $leads = Lead::where('chin_id', \Auth::id())->get();
        return datatables($leads)->setTransformer(new AllLeadsTransformer())->make(true);
    }
}
