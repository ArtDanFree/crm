<?php

namespace App\Http\Controllers\ajax;

use App\Models\Transaction;
use App\Transformers\TransactionTransformer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TransactionTableController extends Controller
{
    public function main(Request $request)
    {
        $transactions = Transaction::with(['client', 'status', 'depositType', 'payment', 'waiver', 'notification'])
            ->where($request->all())
            ->orderByDesc('created_at')
            ->get();

        return \datatables($transactions)->setTransformer(new TransactionTransformer)
            ->make(true);
    }
}
