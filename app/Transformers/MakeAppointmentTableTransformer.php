<?php

namespace App\Transformers;

use Auth;
use League\Fractal\TransformerAbstract;
use App\MakeAppointmentTable;

class MakeAppointmentTableTransformer extends TransformerAbstract
{
    /**
     * @param \App\MakeAppointmentTable $makeAppointmentTable
     * @return array
     */
    public function transform($lead)
    {

        return [
            'DT_RowClass' => $this->rowClass($lead),
            '<span hidden>'. $lead->updated_at .'</span><a id="table-responsive-lead-a" data-id="' . $lead->id . '" href="#clientModal" onclick="showInfo(' . $lead->id . ', 1);"data-toggle="modal"><span id="send-last-name">' . $lead->last_name . '</span><span id="send-first-name">' . $lead->first_name . '</span> <span id="send-surname">' . $lead->surname . '</span> </a>',
            '<span id="send-phone">' . $lead->phone . '</span>',
            $lead->approved . '<i class="fa fa-rub"></i>',
            '<a href="#set-reception" onclick="showInput(' . $lead->id . ')"
                                    id="open-set-date-' . $lead->id . '" data-toggle="modal">Назначить</a>
                                    <input class="show-input" id="show-input-' . $lead->id . '" type="text"
                                    onclick="selectId(' . $lead->id . ')" name="datetimes"
                                    style="display: none;" value=""/>'
        ];
    }

    public function rowClass($lead)
    {
        if (!$lead->notification->where('user_id', Auth::id())->isEmpty()) {
            return 'info';
        }
        return '';
    }
}
