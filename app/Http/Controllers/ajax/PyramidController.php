<?php

namespace App\Http\Controllers\ajax;

use App\Charts\LeadPyramid;
use App\Helpers;
use App\Http\Controllers\Controller;
use App\Models\Lead;
use App\Models\Transaction;

class PyramidController extends Controller
{
    public function __construct()
    {
        \Debugbar::disable();

    }
    public function leadsPyramid()
    {
        $result = new LeadPyramid();
        return $result->get();

    }

    public function transactionsPyramidAuto()
    {
        $transactions = Transaction::with(['status', 'depositType'])->whereHas('depositType', function ($query) {
            $query->where('name', 'Автомобиль');
        })->get();

        $data = Helpers::transactionPyramidAuto($transactions);
        $pyramid = Helpers::pyramidGetData($data);

        return response()->json($pyramid);
    }

    public function transactionsPyramidRealEstate()
    {
        $transactions = Transaction::with(['status', 'depositType'])->whereHas('depositType', function ($query) {
            $query->where('name', 'Недвижимость');
        })->get();

        $data = Helpers::transactionsPyramidRealEstate($transactions);
        $pyramid = Helpers::pyramidGetData($data);

        return response()->json($pyramid);
    }
}