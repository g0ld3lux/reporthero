<?php

namespace Reporthero\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    private function getNewCustomer() {
        $placeOrder = 'vFvk9B';
        $placeOrderContext = [
        'measurement' => 'count',
        'where' => '[["$attributed_flow","=","wpkpxU"]]'
        ];
        $placeOrder = app('\Reporthero\Http\Controllers\Api\MetricsController')->exportMetricData($placeOrder,true,$placeOrderContext);
        $data = json_decode(collect($placeOrder),true);
        $placeOrderTotal = 0;
        foreach ( $data['results'] as $dataOuter)
        {   
        foreach($dataOuter['data'] as $dataInner)
        {
        $placeOrderTotal +=  $dataInner['values'][0];
        }
        }
        return $placeOrderTotal;
    }

    private function getPlaceOrderCount() {
        $placeOrder = 'vFvk9B';
        $placeOrderContext = [
        'measurement' => 'count',
        ];
        $placeOrder = app('\Reporthero\Http\Controllers\Api\MetricsController')->exportMetricData($placeOrder,true,$placeOrderContext);
        $data = json_decode(collect($placeOrder),true);
        $placeOrderTotal = 0;
        foreach ( $data['results'] as $dataOuter)
        {   
        foreach($dataOuter['data'] as $dataInner)
        {
        $placeOrderTotal +=  $dataInner['values'][0];
        }
        }
        return $placeOrderTotal;
    }

    public function rateOfNewCustomer()
    {
        return  $this->getNewCustomer() / $this-> getPlaceOrderCount() * 100;
    }

    private function getReturningCustomer()
    {
         $placeOrder = 'vFvk9B';
        $placeOrderContext = [
        'measurement' => 'count',
        'where' => '[["$new_vs_returning","=","Returning"]]'
        ];
        $placeOrder = app('\Reporthero\Http\Controllers\Api\MetricsController')->exportMetricData($placeOrder,true,$placeOrderContext);
        $data = json_decode(collect($placeOrder),true);
        $placeOrderTotal = 0;
        foreach ( $data['results'] as $dataOuter)
        {   
        foreach($dataOuter['data'] as $dataInner)
        {
        $placeOrderTotal +=  $dataInner['values'][0];
        }
        }
        return $placeOrderTotal;
    }

    public function rateOfReturningCUstomer()
    {
        return  $this->getReturningCustomer() / $this-> getPlaceOrderCount() * 100;
    }

    // Conversion Rate = Total Number of Sales / Number of Leads * 100

    public function conversionRate()
    {
        return $this-> getPlaceOrderCount() / $this->getTotalNoOfLeads() * 100;
    }

    private function getTotalNoOfLeads() {
        // we need to get all campaigns
        // itterate over campaign object , then get no of recipients; then add all the  value...
        $campaignsContext = [
        'page' => 0,
        'count' => 100
        ];
        $campaigns = app('\Reporthero\Http\Controllers\Api\CampaignsController')->getAllCampaign(true,$campaignsContext);
        $data = json_decode(collect($campaigns),true);
        $start =  $data['start'];
        $total = $data['total'];
        $pagesize = $data['page_size'];
        $data = $data['data'];
        $recipient = 0;
        foreach($data as $campaign){
            $recipient += $campaign['num_recipients'];
        }
        return $recipient;


    }
}
