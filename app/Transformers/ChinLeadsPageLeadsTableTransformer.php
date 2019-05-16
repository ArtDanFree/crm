<?php

namespace App\Transformers;

use App\Models\Lead;
use Auth;
use League\Fractal\TransformerAbstract;

class ChinLeadsPageLeadsTableTransformer extends TransformerAbstract
{
    public function transform(Lead $lead)
    {
        return [
            'DT_RowClass' => $this->rowClass($lead),
            $lead->created_at->format('d.m.Y'),
            '<a href="' . Route('lead.show', $lead->id) . '">' .
            $lead->last_name . ' ' . $lead->first_name . ' ' . $lead->surname .
            '</a>'
            ,
            $lead->phone,
            $lead->money,
            '-',
            $lead->status->name,
        ];
    }

    public function rowClass($lead)
    {
        if (!$lead->notification->where('user_id', Auth::id())->isEmpty()) {
            return 'info';
        }
        switch ($lead->status->name) {
            case 'На проверку':
                return 'table-info';
                break;
            case 'Проверяется':
                return 'table-primary';
                break;
            case 'Одобрен':
                return 'table-success';
                break;
            case 'Отказ':
                return 'bg-danger';
                break;
            case 'На доработку':
                return 'table-warning';
                break;
            case 'Клиент':
                return 'bg-success';
                break;

        }
    }
}