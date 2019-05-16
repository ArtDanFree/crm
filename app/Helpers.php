<?php

namespace App;


use App\Events\LeadTakeOnCheckNotification;
use App\Models\User;
use Intervention\Image\Facades\Image;
use Spatie\Permission\Models\Role;
use Storage;
use App\Models\LeadImage;
use App\Models\Transaction;
use App\Models\ReworkStatistic;
use App\Models\Payment;
use App\Models\Lead;
use Carbon\Carbon;

class Helpers
{
    public static function updateAvatar($file)
    {
        Helpers::destroyOldAvatar();
        $img = Image::make($file)->resize(220, 220)->encode('jpg', 75);
        $path = 'avatars/' . str_random(50) . '.jpg';
        Storage::disk('public')->put($path, $img);
        return $path;
    }

    public static function destroyOldAvatar()
    {
        if (empty(\Request::user()->avatar)) {
            return false;
        }
        return Storage::disk('public')->delete(\Request::user()->avatar);
    }



    public static function newDocuments($request, $id)
    {
        foreach ($request->files as $file) {
            for ($i = 0; $i < count($file); $i++) {
                $img = Image::make($file[$i])->encode('jpg', 75);
                $path = 'documents/' . $id . '/' . str_random(50) . '.jpg';
                Storage::disk('public')->put($path, $img);
                LeadImage::create([
                    'name' => $file[$i]->getClientOriginalName(),
                    'lead_id' => $id,
                    'img' => $path,
                ]);
            }
        }
    }

    public static function transactionPyramidAuto($transactions)
    {
        $data = [];
        $data['count'] = $transactions->count();
        foreach ($transactions as $transaction) {
            $data['pyramid']['Встретиться с клиентом'][] = $transaction;

            if ($transaction->status->name == 'Выдан') {
                $data['pyramid']['Успех'][] = $transaction;
            }
        }
        return $data;
    }

    public static function transactionsPyramidRealEstate($transactions)
    {
        $data = [];
        $data['count'] = $transactions->count();
        foreach ($transactions as $transaction) {
            $data['pyramid']['Встретиться с клиентом'][] = $transaction;

            if ($transaction->signed) {
                $data['pyramid']['Подписать документы'][] = $transaction;
            }
            if ($transaction->status->name == 'Выдан') {
                $data['pyramid']['Успех'][] = $transaction;
            }
        }
        return $data;
    }

    public static function dealsDays($transactions)
    {
        $result = [];
        foreach ($transactions as $transaction) {
            $date1 = $transaction->created_at->format('Y-m-d');
            $date2 = date('Y-m-d', strtotime('+' . $transaction->period . ' month', strtotime($date1)));
            $date1_date_unix = strtotime($date1);
            $date2_date_unix = strtotime($date2);
            $result[$transaction->id] = ($date2_date_unix - $date1_date_unix) / (60 * 60 * 24);
        }
        return $result;
    }

    public static function getChinStatistics()
    {
        $statistic = [];
        $transactions = Transaction::where('status_id', '3')->where('chin_id', \Request::user()->id)->get();
        $sum = 0;
        $total = 0;
        $monthly_payment = 0;
        $plan = 0;
        $statistic['bag'] = 0;
        $all_payments = Payment::get();
        $pays = [];
        foreach ($transactions as $transaction) {
            $monthly_payment = $monthly_payment + ($transaction->money * $transaction->percent / 100);
            foreach ($all_payments as $key) {
                if ($key->transaction_id == $transaction->id) {
                    $sum = $sum + $key->body_payment;
                }
            }
            $total = $total + $sum;
            $statistic['bag'] = $statistic['bag'] + ($transaction->money - $sum);
            $sum = 0;
        }
        if (!empty($statistic['bag'])) {
            $statistic['effective_rate'] = round($monthly_payment / $statistic['bag'] * 100 * 12, 2);//
        } else {
            $statistic['effective_rate'] = 0;
        }
        $statistic['plan'] = $monthly_payment;
        $statistic['leads_count'] = Lead::where('chin_id', \Request::user()->id)->get()->count();
        $statistic['transactions_count'] = Transaction::where('status_id', '3')->where('chin_id', \Request::user()->id)->get()->count();
        if (!empty($statistic['leads_count'])) {
            $statistic['conversion'] = round($statistic['transactions_count'] / $statistic['leads_count'] * 100, 2);
        } else {
            $statistic['conversion'] = 0;
        }
        return $statistic;
    }

    public static function getUnderwriterStatistics()
    {
        $statistic = [];
        $current_month = Carbon::now()->format('m');
        $current_day = Carbon::now()->format('d');
        $leadsRaw = Lead::whereMonth('created_at', $current_month)->get();
        $leads = $leadsRaw->filter(function ($value) {
                    return ($value->underwriter_id == \Request::user()->id  and $value->status_id == 3) or
                           ($value->underwriter_id == \Request::user()->id  and $value->status_id == 4);
                 });
        $statistic['lead_count'] = $leads->Count();
        $transactions = Transaction::where('underwriter_id', \Request::user()->id)->whereMonth('created_at', $current_month)->get();
        $statistic['transactions_count'] = $transactions->count();
        $average = [];
        for ($i = 1; $i <= $current_day; $i++) {
            $average[$i] = 0;
        }
        foreach ($leads as $lead) {
            for ($i = 1; $i <= $current_day; $i++) {
                if ($lead->completed_at->format('d') == $i) {
                    $average[$i] = $average[$i] + 1;
                }
            }
        }
        $sum = 0;
        for ($i = 1; $i <= count($average); $i++) {
            $sum = $sum + $average[$i];
        }

        $statistic['leads_in_day'] = round($sum / count($average), 2);
        $i = 0;
        $averageTime = [];
        $reworks = ReworkStatistic::get();
        $mas_reworks = [];
        $dMin = 0;
        foreach ($leads as $lead) {
            $date1 = $lead->taken_at;
            $date2 = $lead->completed_at;
            $s = 0;
            foreach ($reworks as $key) {
                if($key->lead_id == $lead->id){
                    $mas_reworks[$s] = $key->created_at;
                    $s++;
                }
            }
            $k=count($mas_reworks)-1;
            if(count($mas_reworks) != 0){
            while($k>=0){
              $dat1 = $mas_reworks[$k--];
              $dat2 = $mas_reworks[$k];
              $dMin = $dMin + $dat2->diffInMinutes($dat1);
              $k--;
              }
            }
            $averageTime[$i] = $date2->diffInMinutes($date1);
            $i++;
            $mas_reworks = [];
        }
        $sum = 0;
        for ($i = 0; $i < count($averageTime); $i++) {
          if (array_key_exists($i, $averageTime) == true){
           $sum = $sum + $averageTime[$i];
         }else{
           $sum=0;
         }
        }
        if($sum!=0){
        $statistic['time_per_lead'] = round(($sum-$dMin) / count($averageTime), 2);
          }else {
        $statistic['time_per_lead'] = 0;
        }
        return $statistic;
    }

    public static function getLeadNotification()
    {
        return \Request::user()->leadNotification;
    }

    //TODO УДАЛИТЬ
    public static function getUserName()
    {
        return \Request::user()->last_name . " " . \Request::user()->first_name . " " . \Request::user()->surname;
    }

    public static function getTransactionNotification()
    {
        return \Request::user()->transactionNotification;
    }
}
