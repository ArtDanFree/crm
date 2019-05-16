<?php

namespace App\Http\Controllers;

use App\Models\TransactionWaiver;
use App\Transformers\TransactionTransformer;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Helpers;
use Yajra\DataTables\DataTables;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with(['client', 'status', 'depositType', 'payment', 'waiver', 'notification'])->orderByDesc('created_at')->get();
        $transactionIssueOrSign = $transactions->filter(function ($value) {
            return $value->status->name == 'Встреча назначена' or $value->status->name == 'Подписан';
        });
        $daysCount = Helpers::dealsDays($transactions);
        $waivers = TransactionWaiver::all();
        return view('transactions.transactions', compact(['transactions', 'transactionIssueOrSign', 'daysCount', 'waivers']));
    }

    public function show(Request $request, $id)
    {
        $transaction = Transaction::with(['client', 'notification'])->where('id', $id)->first();
        $notification = $transaction->notification;
        if ($notification) $notification->delete();

        return view('show_deals', compact(['transaction']));
    }

    public function changeReception(Request $request)
    {
        Transaction::find($request->id)->update([
            'reception' => $request->time,
        ]);
        return response()->json([
            'id' => $request->id,
            'time' => $request->time,
        ]);
    }

    public function updateStatus(Request $request, $id)
    {
        $transaction = Transaction::find($id);
        $transaction->update($request->all());

        return response()->json([
            'id' => $transaction->id,
            'message' => 'Статус успешно обновлен',
        ]);
    }

    public function update(Request $request, $id)
    {

        $transaction = Transaction::with('client')->find($id);
        $transaction->client()->update($request->only('passport_series', 'passport_id', 'birthday', 'issued_by', 'when_issued', 'division_code', 'registration_address'));
        $transaction->update($request->only(['money', 'percent']));
        dd(
            $transaction->client,
            $id,
            $request->all()
        );
    }
}
