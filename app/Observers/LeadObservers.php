<?php

namespace App\Observers;

use App\Events\NewLeadNotification;
use App\Models\Lead;
use App\Models\TransactionNotification;
use App\Models\User;

class LeadObservers
{
    public function created(Lead $lead)
    {
        if (!\Auth::id()) return;

        $underwriters = User::role('Андеррайтер')->get();
        foreach ($underwriters as $underwriter) {
            $leadNotification = $underwriter->leadNotification()->create([
                'lead_id' => $lead->id,
            ]);
        }
    }
}
