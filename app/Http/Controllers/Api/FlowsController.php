<?php

namespace Reporthero\Http\Controllers\Api;

use Illuminate\Http\Request;
use Reporthero\Http\Controllers\Controller;
use Reporthero\Klaviyo;
use Reporthero\Http\Requests\FlowsFilter;

class FlowsController extends Controller
{
    protected $api;

    protected $filter;

    public function __construct(Klaviyo $klaviyo, FlowsFilter $filter) {
        $this->api = $klaviyo;
        $this->filter = $filter;
    }

    protected function getAllFlowArgs()
    {
        return [
           'page' => $this->filter->byPage(), 
           'count' => $this->filter->byCount()
           ]; 
    }

    /**
     * Display All The Data For Metrics
     *
     * @return  data property that contains an array of all the metrics
     */
    public function getAllFlows($endpoint = false, $params = [])
    {
        if($endpoint === true){
        
        $url = 'campaigns';
        // api/v1/ is appended in setEndPoint
        $this->api->setEndPoint($url);

        }
        if(!empty($params))
        {
        $this->api->setCustomProps($params);
        }


        $filters = $this->api->setFilters($this->getAllFlowArgs());
        return $data = $this->api->makeCall($this->api->getMethod(), $this->api->getEndPoint(), $this->api->buildArgs());
    }

    public function showFlow()
    {
        $data = $this->api->makeCall($this->api->getMethod(), $this->api->getEndPoint(), $this->api->buildArgs());

        return $data;
    }

   
}
