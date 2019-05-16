<?php

namespace App\Transformers;

use App\Models\Lead;
use Auth;
use League\Fractal\TransformerAbstract;

class TakeOnCheckTableTransformer extends TransformerAbstract
{


    public function transform(Lead $lead)
    {
        $fullName = $lead->last_name . ' ' . $lead->first_name . ' ' . $lead->surname;

        return [
            'DT_RowClass' => $this->rowClass($lead),
            '<span hidden>'. $lead->created_at .'</span>' .
            \Carbon\Carbon::parse($lead->created_at)->diffForHumans(),
            '<a href="' . Route('lead.show', $lead->id) . '">' . $fullName . '</a>',

            $lead->depositType->name,
            $lead->chin->first_name
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