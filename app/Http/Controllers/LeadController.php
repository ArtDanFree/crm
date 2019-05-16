<?php

namespace App\Http\Controllers;

use App\Charts\LeadPyramid;
use App\Events\LeadTakeOnCheckNotification;
use App\Events\NewLeadNotification;
use App\Helpers;
use App\Models\Lead;
use App\Models\User_City;
use App\Models\ReworkStatistic;
use App\Http\Requests\LeadStoreRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Service\LeadService;


class LeadController extends Controller
{
    public $leadService;

    public function __construct()
    {
        $this->leadService = new LeadService();
        $this->middleware(['existLead'])->only('show');
    }

    public function store(LeadStoreRequest $request)
    {

        if (\Request::user()->hasPermissionTo('Добавить лида')) {
            $lead = Lead::create($request->except('files'));
            if ($request->file('files')) {
                Helpers::newDocuments($request, $lead->id);
            }
        }
        event(new NewLeadNotification($lead->chin_id));


        return response()->json(['message' => 'Лид добавлен']);
    }

    public function showLeadInfo(Request $request)
    {
        $lead = Lead::with([
            'status', 'leadImage', 'city', 'source', 'underwriter',
            'notification',
        ])->where('id', $request->id)->first();
        $lead->deleteNotification();

        return response()->json(['lead' => $lead,]);
    }

    public function leads()
    {
        if (\Request::user()->hasRole('Андеррайтер')) {
            $leadsAll = Lead::with(['status', 'depositType', 'chin'])
                ->orderByDesc('created_at')->get();
            $checkLeads = $this->leadService->filterCheckLeads($leadsAll);

            return view('leads.index', compact(['checkLeads', 'leadsAll']));

        } elseif (\Request::user()->hasRole('Частный инвестор')
            || \Request::user()->hasRole('Администратор')
        ) {

            $chart = (new LeadPyramid())->create();

            return view('leads.index', compact(['chart']));
        }

    }

    public function show($id)
    {
        $lead = Lead::with(['LeadImage'])->find($id);

        if (\Request::user()->hasRole('Андеррайтер')) {
            $notification = $lead->notification()->where('user_id', \Auth::id())
                ->first();
            if ($notification) {
                $notification->delete();
            }
        }

        return view('card', compact(['lead']));
    }

    public function takeOnCheck(Request $request)
    {
        if (\Request::user()->hasRole('Андеррайтер')) {
            $lead = Lead::with('status', 'underwriter')->find($request->id);
            $lead->checkRework();
            $lead->takeOnCheck();
            $lead->deleteAllNotification();
            broadcast(new LeadTakeOnCheckNotification($lead));

            if ($lead->deposit_type_id == 1) {
                return response()->json([
                    'type' => 'realty',
                    'underwriter' => Helpers::getUserName(),
                ]);
            } else {
                return response()->json([
                    'type' => 'auto',
                    'underwriter' => Helpers::getUserName(),
                ]);
            }
        }
    }

    public function leadDecline(Request $request)
    {
        if (\Request::user()->hasRole('Андеррайтер')) {
            $lead = Lead::find($request->id);
            $lead->underwriter_id = null;
            $lead->status_id = '1';
            $lead->taken_at = null;
            $lead->comment = $request->comment;
            $lead->save();
            $reworks = ReworkStatistic::where('lead_id', $lead->id);
            $reworks->delete();

            return response()->json([
                'status' => 'success',
            ]);
        }
    }


    public function leadRemake(Request $request)
    {
        if (\Request::user()->hasRole('Андеррайтер')) {
            $lead = Lead::find($request->id);
            $lead->status_id = '5';
            $lead->comment = $request->comment;
            $lead->save();

            ReworkStatistic::create([
                'label' => 0,
                'lead_id' => $lead->id,
            ]);

            return response()->json([
                'underwriter' => Helpers::getUserName(),
            ]);
        }
    }

    public function leadWaiver(Request $request)
    {
        if (\Request::user()->hasRole('Андеррайтер')) {
            $lead = Lead::find($request->id);
            $lead->status_id = '4';
            $lead->completed_at = Carbon::now()->format('Y-m-d H:i:s');
            $lead->comment = $request->comment;
            $lead->save();

            return response()->json([
                'underwriter' => Helpers::getUserName(),
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        $lead = Lead::find($id);
        $lead->update($request->all());

        return back();
    }
}
