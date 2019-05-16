<?php

namespace App\Charts;

use App\Models\Lead;
use ConsoleTVs\Charts\Classes\Echarts\Chart;

class LeadPyramid extends Chart
{
    protected $chart;

    public function __construct()
    {
        parent::__construct();
        $this->chart = new Chart();
    }

    public function create()
    {
        $url = url('pyramid/leads');
        $this->chart->load($url);

        return $this->chart;
    }

    public function get()
    {
        $data = $this->getData();
        $this->chart->dataset('', 'funnel', $data);

        return $this->chart->api();
    }

    protected function getData()
    {
        $dataName = $this->getDataName();
        return $this->getDataValue($dataName);
    }

    protected function getDataName()
    {
        $leads = Lead::with('status')->where('chin_id', \Auth::id())->get();

        $data = [];
        $data['count'] = $leads->count();
        foreach ($leads as $lead) {
            if ($lead->status->name == 'Ожидание документов') {
                $data['pyramid']['Дозвониться до клиента'][] = $lead;
            }
            if ($lead->status->name == 'На проверку' or $lead->status->name == 'Проверяется') {
                $data['pyramid']['Получить документы на залог'][] = $lead;
            }
            if ($lead->status->name == 'Одобрен') {
                $data['pyramid']['Получить одобрение у андеррайтеров'][] = $lead;
            }
            if ($lead->status->name == 'Встреча назначена') {
                $data['pyramid']['Договориться с клиентом на встречу'][] = $lead;
            }
        }

        return $data;
    }

    protected function getDataValue($data)
    {
        $result = [];
        $count = 0;
        foreach ($data['pyramid'] as $key => $value) {
            $result[$count]['name'] = $key;
            $result[$count]['value'] = (int)((100 / $data['count']) * count($value));
            $count++;
        }
        return $result;
    }

}
