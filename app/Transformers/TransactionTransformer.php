<?php

namespace App\Transformers;

use App\Models\Transaction;
use League\Fractal\TransformerAbstract;

class TransactionTransformer extends TransformerAbstract
{

    public function transform(Transaction $transaction)
    {
        $fullName = $transaction->client->last_name . ' ' . $transaction->client->first_name . ' ' . $transaction->client->surname;

        return [
            'DT_RowClass' => $this->rowClass($transaction),
            $transaction->created_at->format('d.m.Y'),
            '<a href="' . Route('transaction.show', $transaction->id) . '">' . $fullName . '</a>',
            $transaction->client->phone,
            $transaction->money,
            $transaction->percent,
            $transaction->status->name
        ];
    }

    public function rowClass($transaction)
    {
        if ($transaction->notification) return 'info';
        elseif ($transaction->status_id == 3) return 'success';
        elseif ($transaction->status_id == 4) return 'danger';
        elseif ($transaction->status_id == 5) return 'active';
    }

}