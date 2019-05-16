<?php

namespace App\Observers;

use App\Events\NewTransactionNotification;
use App\Models\Client;
use App\Models\Lead;
use App\Models\Transaction;
use App\Models\TransactionNotification;

class ClientObservers
{
    public function created(Client $client)
    {
        //
    }

    public function updated(Client $client)
    {
        //
    }

    public function deleted(Client $client)
    {
        //
    }

    public function restored(Client $client)
    {
        //
    }

    public function forceDeleted(Client $client)
    {
        //
    }
}
