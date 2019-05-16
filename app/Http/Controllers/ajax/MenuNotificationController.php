<?php

namespace App\Http\Controllers\ajax;

use App\Models\LeadNotification;
use App\Models\TransactionNotification;
use App\Http\Controllers\Controller;

class MenuNotificationController extends Controller
{
    public function lead()
    {
        return LeadNotification::where('user_id', \Auth::id())->count();
    }

    public function transaction()
    {
        return TransactionNotification::where('chin_id', \Auth::id())->count();
    }
}
