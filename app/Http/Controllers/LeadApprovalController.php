<?php

namespace App\Http\Controllers;

use App\Events\LeadApprovalNotification;
use App\Events\NewTransactionNotification;
use App\Helpers;
use App\Models\Client;
use App\Models\Lead;
use App\Models\Transaction;
use App\Models\TransactionNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LeadApprovalController extends Controller
{

    public function __invoke(Request $request)
    {
        if (auth()->user()->hasRole('Андеррайтер')) {

            $lead = Lead::find($request->id);
            $this->updateLead($lead);
            $client = $this->clientCreate($lead);
            $transaction =  $this->transactionCreate($lead, $client);

            return response()->json(['url' => route('transaction.show', $transaction->id)]);
        }
    }

    public function updateLead(Lead $lead)
    {
        $lead->status_id = '6';
        $lead->completed_at = Carbon::now()->format('Y-m-d H:i:s');
        return $lead->save();
    }

    public function clientCreate(Lead $lead)
    {
        $client = Client::create([
            'first_name' => $lead->first_name,
            'last_name' => $lead->last_name,
            'surname' => $lead->surname,
            'phone' => $lead->phone,
            'lead_id' => $lead->id,
        ]);

        return $client;
    }

    public function transactionCreate(Lead $lead, Client $client)
    {
        $transaction = Transaction::create([
            'chin_id' => $lead->chin_id,
            'underwriter_id' => $lead->underwriter_id,
            'money' => $lead->money,
            'client_id' => $client->id,
            'deposit_type_id' => $lead->deposit_type_id,
            'reception_time' => $lead->reception_time,
        ]);

        TransactionNotification::create([
            'client_id' => $client->id,
            'chin_id' => $lead->chin_id,
            'transaction_id' => $transaction->id,
        ]);

        event(new NewTransactionNotification($transaction));

        return $transaction;
    }

}
